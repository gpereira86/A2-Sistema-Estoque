<?php

namespace System\Core;

use PDO;
use PDOException;

/**
 * Classe de Conexão com o Banco de Dados
 *
 * Esta classe gerencia a conexão com o banco de dados MySQL usando a extensão PDO (PHP Data Objects).
 * Ela fornece uma instância singleton da conexão PDO para garantir que apenas uma conexão seja feita
 * ao longo do ciclo de vida da aplicação.
 */
class DbConnection
{

    private static $instance;

    /**
     * Retorna uma instância PDO (singleton).
     *
     * Este método cria uma nova conexão PDO com o banco de dados MySQL usando as constantes de configuração
     * do arquivo de configuração do sistema. Se uma instância já existir, ele retorna a instância existente
     * para garantir que apenas uma conexão seja usada ao longo da aplicação.
     *
     * @return PDO A instância PDO que representa a conexão com o banco de dados.
     * @throws PDOException Se a conexão não puder ser estabelecida, uma exceção será lançada.
     */
    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {

            try {
                self::$instance = new PDO(
                    'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME,
                    DB_USERNAME,
                    DB_PASSCODE,
                    [
                        PDO::MYSQL_ATTR_INIT_COMMAND => "set NAMES utf8",
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_CASE => PDO::CASE_NATURAL
                    ]
                );
            } catch (PDOException $ex) {
                die("Erro de conexão >>> " . $ex->getMessage());
            }
        }
        return self::$instance;
    }

    /**
     * Construtor (protegido).
     *
     * O construtor é protegido para impedir a criação de instâncias diretamente via o construtor.
     * A classe segue o padrão de projeto Singleton, portanto, a única forma de obter uma instância é
     * através do método `getInstance()`.
     */
    protected function __construct()
    {
    }

    /**
     * Clonagem (privada).
     *
     * O método de clonagem é privado para impedir a clonagem da instância.
     * Como esta classe segue o padrão Singleton, a clonagem violaria o padrão.
     */
    private function __clone()
    {
    }
}
