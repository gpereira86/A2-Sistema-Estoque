<?php

/**
 * Set the default timezone to São Paulo.
 * This ensures that all date and time functions will use the specified timezone.
 */
date_default_timezone_set('America/Sao_Paulo');

define('SITENAME','A2 - Glauco Pereira');
define('SITEFUNCTIONNAME','Estoque');

/**
 * Base URLs for the production and development environments.
 * These constants define the base URLs for different environments to ensure proper routing.
 */
define('PRODUCTION_URL', 'https://cadclientes.glaucopereira.com');
define('DEVELOPMENT_URL', 'http://localhost/cadastro-clientes');

/**
 * URLs for the site in different environments.
 * These constants define the base URLs for site routing depending on the environment.
 */
define('URL_PRODUCTION', '/');
define('URL_DEVELOPMENT', '/cadastro-clientes/');

/**
 * Database connection settings.
 * These constants define the necessary credentials and configuration for connecting to the database.
 */
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'cadclientes');
define('DB_USERNAME', 'root');
define('DB_PASSCODE', '');


