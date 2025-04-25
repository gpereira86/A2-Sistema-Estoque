<?php

/**
 * Configurações gerais da aplicação.
 *
 * Define o fuso horário, constantes de URL para ambientes de desenvolvimento e produção,
 * bem como parâmetros de conexão com o banco de dados.
 *
 * @package Config
 */

// Fuso horário padrão para a aplicação
date_default_timezone_set('America/Sao_Paulo');

// Nome do site e título funcional exibido no layout
define('SITENAME',           'A2 - Glauco Pereira');
define('SITEFUNCTIONNAME',   'Estoque');

// URLs base para ambientes de produção e desenvolvimento
define('PRODUCTION_URL',     'https://estoque.glaucopereira.com');
define('DEVELOPMENT_URL',    'http://localhost/cadastro-clientes');

// Paths relativos (se necessário) para inclusão de assets ou roteamento
define('URL_PRODUCTION',     '/');
define('URL_DEVELOPMENT',    '/cadastro-clientes/');

// Parâmetros de conexão com o banco de dados MySQL
define('DB_HOST',            'localhost');
define('DB_PORT',            '3306');
define('DB_NAME',            'cadclientes');
define('DB_USERNAME',        'root');
define('DB_PASSCODE',        '');


