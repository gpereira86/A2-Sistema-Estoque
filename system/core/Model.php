<?php

namespace System\Core;

use System\Core\Connection;
use System\Core\Message;


/**
 * Classe Model
 *
 * Classe abstrata para interação com o banco de dados.
 * Fornece métodos para operações CRUD e manipulação de dados.
 * Implementa padrões comuns para filtragem, consulta e gerenciamento de dados no banco de dados.
 */
abstract class Model
{

    protected $dataSet;
    protected $query;
    protected $error;
    protected $params;
    protected $table;
    protected $order;
    protected $limit;
    protected $offset;
    protected $message;

    /**
     * Construtor do Model.
     *
     * Inicializa o nome da tabela e o objeto de mensagem.
     *
     * @param string $table Nome da tabela.
     */
    public function __construct(string $table)
    {
        $this->table = $table;
        $this->message = new Message();
    }

    /**
     * Define a cláusula ORDER BY da SQL para a consulta.
     *
     * @param string $order A cláusula ORDER BY.
     * @return $this A instância atual da classe.
     */
    public function order(string $order)
    {
        $this->order = " ORDER BY {$order}";
        return $this;
    }

    /**
     * Define a cláusula LIMIT da SQL para a consulta.
     *
     * @param string $limit A cláusula LIMIT.
     * @return $this A instância atual da classe.
     */
    public function limit(string $limit)
    {
        $this->limit = " LIMIT {$limit}";
        return $this;
    }

    /**
     * Define a cláusula OFFSET da SQL para a consulta.
     *
     * @param string $offset A cláusula OFFSET.
     * @return $this A instância atual da classe.
     */
    public function offset(string $offset)
    {
        $this->offset = " OFFSET {$offset}";
        return $this;
    }

    /**
     * Recupera o código de erro da última operação.
     *
     * @return string|int O código de erro.
     */
    public function error()
    {
        return $this->error;
    }

    /**
     * Recupera o objeto de mensagens que contém as mensagens de erro ou sucesso.
     *
     * @return Message O objeto de mensagens.
     */
    public function message()
    {
        return $this->message;
    }

    /**
     * Recupera o conjunto de dados armazenados no objeto.
     *
     * @return \stdClass O conjunto de dados.
     */
    public function data()
    {
        return $this->dataSet;
    }

    /**
     * Define uma propriedade no conjunto de dados.
     *
     * @param string $name O nome da propriedade.
     * @param mixed $value O valor a ser definido.
     */
    public function __set($name, $value)
    {
        if (empty($this->dataSet)) {
            $this->dataSet = new \stdClass();
        }

        $this->dataSet->$name = $value;
    }

    /**
     * Verifica se uma propriedade existe no conjunto de dados.
     *
     * @param string $name O nome da propriedade.
     * @return bool Retorna true se a propriedade existir.
     */
    public function __isset($name)
    {
        return isset($this->dataSet->$name);
    }

    /**
     * Recupera uma propriedade do conjunto de dados.
     *
     * @param string $name O nome da propriedade.
     * @return mixed O valor da propriedade, ou null se não existir.
     */
    public function __get($name)
    {
        return ($this->dataSet->$name ?? null);
    }

    /**
     * Realiza uma busca no banco de dados, com filtragem opcional.
     *
     * @param string|null $terms Termos de filtragem.
     * @param string|null $params Parâmetros da consulta.
     * @param string $columns As colunas a serem selecionadas.
     * @return $this A instância atual da classe.
     */
    public function search(?string $terms = null, ?string $params = null, string $columns = '*')
    {
        if ($terms) {
            $this->query = "SELECT {$columns} FROM " . $this->table . " WHERE {$terms}";
            parse_str($params, $this->params);
            return $this;
        }

        $this->query = "SELECT {$columns} FROM " . $this->table;
        return $this;
    }

    /**
     * Recupera os resultados da consulta.
     *
     * @param bool $all Se for true, retorna todos os resultados.
     * @return mixed Retorna os resultados ou null se não houver resultados.
     */
    public function result(bool $all = false)
    {
        try {
            $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
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
     * Registra um novo registro no banco de dados.
     *
     * @param array $dataSet Dados a serem inseridos no banco de dados.
     * @return int|null O ID do novo registro, ou null se ocorreu um erro.
     */
    protected function register(array $dataSet)
    {
        try {
            $colunas = implode(',', array_keys($dataSet));
            $valores = ':' . implode(',:', array_keys($dataSet));
            $query = "INSERT INTO " . $this->table . "({$colunas}) VALUES ({$valores})";

            $stmt = Connection::getInstance()->prepare($query);
            $stmt->execute($this->dataFilter($dataSet));

            return Connection::getInstance()->lastInsertId();
        } catch (\PDOException $ex) {
            $this->error = $ex->getCode();
            return null;
        }
    }

    /**
     * Atualiza um registro no banco de dados.
     *
     * @param array $dataSet Dados a serem atualizados no banco de dados.
     * @param string $terms Termos de filtragem para a atualização.
     * @return int|null O número de linhas afetadas, ou null se ocorreu um erro.
     */
    protected function update(array $dataSet, string $terms)
    {
        try {
            $set = [];

            foreach ($dataSet as $key => $value) {
                $set[] = "{$key} =:{$key}";
            }

            $set = implode(', ', $set);

            $query = "UPDATE " . $this->table . " SET {$set} WHERE {$terms}";

            $stmt = Connection::getInstance()->prepare($query);
            $stmt->execute($this->dataFilter($dataSet));

            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $ex) {
            $this->error = $ex->getCode();
            return null;
        }
    }

    /**
     * Filtra os dados para evitar valores inválidos.
     *
     * @param array $dataSet Dados a serem filtrados.
     * @return array Os dados filtrados.
     */
    private function dataFilter(array $dataSet)
    {
        $filtered = [];

        foreach ($dataSet as $key => $value) {
            $filtered[$key] = (is_null($value) ? null : filter_var($value, FILTER_DEFAULT));
        }

        return $filtered;
    }

    /**
     * Retorna os dados armazenados no objeto como um array.
     *
     * @return array Os dados do objeto.
     */
    protected function storage()
    {
        $dataSet = (array) $this->dataSet;
        return $dataSet;
    }

    /**
     * Busca um registro pelo seu ID.
     *
     * @param int $id O ID do registro a ser buscado.
     * @return $this A instância atual da classe.
     */
    public function searchById(int $id)
    {
        $search = $this->search("id = {$id}");
        return $search->result();
    }

    /**
     * Deleta um registro do banco de dados.
     *
     * @param string $termos Termos de filtragem para a exclusão.
     * @return bool|null Retorna true se a exclusão foi bem-sucedida, ou null se ocorreu um erro.
     */
    public function delete(string $termos)
    {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE {$termos}";

            $stmt = Connection::getInstance()->prepare($query);
            $stmt->execute();

            return true;
        } catch (\PDOException $ex) {
            $this->error = $ex->getCode();
            return null;
        }
    }

    /**
     * Retorna o número de registros encontrados pela consulta.
     *
     * @return int O número de registros encontrados.
     */
    public function amount(): int
    {

        $stmt = Connection::getInstance()->prepare($this->query);
        $stmt->execute($this->params);

        return $stmt->rowCount();
    }

    /**
     * Salva o registro no banco de dados. Realiza inserção ou atualização dependendo da presença de um ID.
     *
     * @return bool Retorna true se a operação foi bem-sucedida, ou false se ocorreu um erro.
     */
    public function save(): bool
    {
        if (empty($this->id)) {
            $id = $this->register($this->storage());
            if ($this->error) {
                $this->message->messageError('Erro no sistema ao tentar registrar os dados');
                return false;
            }
        }

        if (!empty($this->id)) {
            $id = $this->id;
            $this->update($this->storage(), "id = {$id}");
            if ($this->error) {
                $this->message->messageError('Erro no sistema ao tentar atualizar os dados');
                return false;
            }
        }

        $this->dataSet = $this->searchById($id)->data();
        return true;
    }

    /**
     * Retorna o próximo ID disponível para inserção.
     *
     * @return int O próximo ID disponível.
     */
    private function lastId(): int
    {
        return Connection::getInstance()->query("SELECT MAX(id) FROM " . $this->table)->fetchColumn() + 1;
    }
}
