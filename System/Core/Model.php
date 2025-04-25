<?php

namespace System\Core;

use System\Core\DbConnection;

/**
 * Class Model
 *
 * Classe base para interações com o banco de dados, fornecendo métodos genéricos
 * para consulta, inserção, atualização, exclusão e manipulação de registros em uma tabela.
 *
 * @package System\Core
 */
abstract class Model
{
    /**
     * Conjunto de dados associado ao modelo.
     * Armazena propriedades dinâmicas definidas via __set.
     *
     * @var \stdClass|null
     */
    protected $dataSet;

    /**
     * Consulta SQL a ser executada.
     *
     * @var string|null
     */
    protected $query;

    /**
     * Erro ocorrido durante a execução da última operação.
     *
     * @var mixed
     */
    protected $error;

    /**
     * Parâmetros para query preparada.
     *
     * @var array|null
     */
    protected $params;

    /**
     * Nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table;

    /**
     * Cláusula ORDER BY para a consulta.
     *
     * @var string|null
     */
    protected $order;

    /**
     * Cláusula LIMIT para a consulta.
     *
     * @var string|null
     */
    protected $limit;

    /**
     * Cláusula OFFSET para a consulta.
     *
     * @var string|null
     */
    protected $offset;

    /**
     * Inicializa o modelo com a tabela especificada.
     *
     * @param string $table Nome da tabela no banco.
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Define a ordenação (ORDER BY) para a consulta.
     *
     * @param string $order Expressão de ordenação (ex.: 'created_at DESC').
     * @return $this
     */
    public function order(string $order)
    {
        $this->order = " ORDER BY {$order}";
        return $this;
    }

    /**
     * Define o limite de registros (LIMIT) para a consulta.
     *
     * @param string $limit Número máximo de registros.
     * @return $this
     */
    public function limit(string $limit)
    {
        $this->limit = " LIMIT {$limit}";
        return $this;
    }

    /**
     * Define o deslocamento (OFFSET) para a consulta.
     *
     * @param string $offset Quantidade de registros a pular.
     * @return $this
     */
    public function offset(string $offset)
    {
        $this->offset = " OFFSET {$offset}";
        return $this;
    }

    /**
     * Retorna o erro da última operação.
     *
     * @return mixed
     */
    public function error()
    {
        return $this->error;
    }

    /**
     * Retorna os dados carregados no modelo.
     *
     * @return object|null
     */
    public function data()
    {
        return $this->dataSet;
    }

    /**
     * Captura atribuição dinâmica de propriedades e armazena no dataSet.
     *
     * @param string $name Nome da propriedade.
     * @param mixed $value Valor da propriedade.
     */
    public function __set($name, $value)
    {
        if (empty($this->dataSet)) {
            $this->dataSet = new \stdClass();
        }

        $this->dataSet->$name = $value;
    }

    /**
     * Verifica se propriedade dinâmica está definida.
     *
     * @param string $name Nome da propriedade.
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->dataSet->$name);
    }

    /**
     * Retorna o valor de uma propriedade dinâmica.
     *
     * @param string $name Nome da propriedade.
     * @return mixed|null
     */
    public function __get($name)
    {
        return ($this->dataSet->$name ?? null);
    }

    /**
     * Inicia uma consulta SELECT.
     *
     * @param string|null $terms Condições WHERE sem a palavra-chave WHERE.
     * @param string|null $params Query string para parâmetros (ex.: 'id=1').
     * @param string $columns Colunas a selecionar (padrão '*').
     * @return $this
     */
    public function search(?string $terms = null, ?string $params = null, string $columns = '*')
    {
        if ($terms) {
            $this->query = "SELECT {$columns} FROM {$this->table} WHERE {$terms}";
            parse_str((string)$params, $this->params);
            return $this;
        }

        $this->query = "SELECT {$columns} FROM {$this->table}";
        return $this;
    }

    /**
     * Executa a consulta gerada e retorna resultados.
     *
     * @param bool $all Se true, retorna todos os registros, caso contrário apenas o primeiro.
     * @return array|object|null
     */
    public function result(bool $all = false)
    {
        try {
            $stmt = DbConnection::getInstance()
                ->prepare($this->query . $this->order . $this->limit . $this->offset);
            $stmt->execute($this->params);

            if (!$stmt->rowCount()) {
                return null;
            }

            if ($all) {
                return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
            }

            return $stmt->fetchObject(static::class);
        } catch (\PDOException $ex) {
            $this->error = $ex;
            return null;
        }
    }

    /**
     * Insere um novo registro na tabela.
     *
     * @param array $dataSet Dados a serem inseridos (chave => valor).
     * @return string|null ID do novo registro ou null em caso de falha.
     */
    protected function register(array $dataSet)
    {
        try {
            $colunas = implode(',', array_keys($dataSet));
            $valores = ':' . implode(',:', array_keys($dataSet));
            $query = "INSERT INTO {$this->table}({$colunas}) VALUES ({$valores})";

            $stmt = DbConnection::getInstance()->prepare($query);
            $stmt->execute($this->dataFilter($dataSet));

            return DbConnection::getInstance()->lastInsertId();
        } catch (\PDOException $ex) {
            $this->error = $ex->getCode();
            return null;
        }
    }

    /**
     * Atualiza registros na tabela com base em critérios.
     *
     * @param array $dataSet Dados a serem atualizados (chave => valor).
     * @param string $terms Termos da cláusula WHERE (ex.: 'id=1').
     * @return int|null Número de linhas afetadas ou null em caso de erro.
     */
    protected function update(array $dataSet, string $terms)
    {
        try {
            $set = [];
            foreach ($dataSet as $key => $value) {
                $set[] = "{$key} = :{$key}";
            }
            $set = implode(', ', $set);

            $query = "UPDATE {$this->table} SET {$set} WHERE {$terms}";

            $stmt = DbConnection::getInstance()->prepare($query);
            $stmt->execute($this->dataFilter($dataSet));

            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $ex) {
            $this->error = $ex->getCode();
            return null;
        }
    }

    /**
     * Filtra e sanitiza valores para uso em consultas.
     *
     * @param array $dataSet Dados brutos.
     * @return array Dados filtrados.
     */
    private function dataFilter(array $dataSet)
    {
        $filtered = [];
        foreach ($dataSet as $key => $value) {
            $filtered[$key] = is_null($value) ? null : filter_var($value, FILTER_DEFAULT);
        }
        return $filtered;
    }

    /**
     * Retorna os dados atuais como array.
     *
     * @return array
     */
    protected function storage()
    {
        return (array)$this->dataSet;
    }

    /**
     * Busca um registro pelo ID.
     *
     * @param int $id ID do registro.
     * @return object|null
     */
    public function searchById(int $id)
    {
        return $this->search("id = {$id}")->result();
    }

    /**
     * Busca um registro pelo e-mail.
     *
     * @param string $email E-mail a ser pesquisado.
     * @return object|null
     */
    public function searchByEmail(string $email)
    {
        return $this->search("email = '{$email}'")->result();
    }

    /**
     * Exclui registros com base em critérios.
     *
     * @param string $terms Critérios da cláusula WHERE.
     * @return bool|null True em caso de sucesso, null em caso de erro.
     */
    public function delete(string $terms)
    {
        try {
            $query = "DELETE FROM {$this->table} WHERE {$terms}";
            $stmt = DbConnection::getInstance()->prepare($query);
            $stmt->execute();
            return true;
        } catch (\PDOException $ex) {
            $this->error = $ex->getCode();
            return null;
        }
    }

    /**
     * Inicia consulta com junções para categoria e usuário.
     *
     * @param string|null $term Condição para compor o WHERE (ex.: 'id=1').
     * @return $this
     */
    public function searchWithCategory(string $term = null)
    {
        $params = $term !== null ? "WHERE {$term}" : '';
        $this->query = <<<SQL
            SELECT
                p.*,
                c.category AS categoryName,
                u.name AS userName
            FROM {$this->table} AS p
            JOIN categories AS c ON p.category_id = c.id
            JOIN users AS u ON p.user_id = u.id
            {$params}
            SQL;
        return $this;
    }

    /**
     * Salva o registro em banco: insere se não existir ID ou atualiza caso contrário.
     *
     * @return bool True em caso de sucesso, false em caso de falha.
     */
    public function save(): bool
    {
        if (empty($this->id)) {
            $id = $this->register($this->storage());
            if ($this->error) {
                return false;
            }
        }

        if (!empty($this->id)) {
            $id = $this->id;
            $this->update($this->storage(), "id = {$id}");
            if ($this->error) {
                return false;
            }
        }

        $this->dataSet = $this->searchById($id)->data();
        return true;
    }

}
