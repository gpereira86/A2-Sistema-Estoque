<?php

/**
 * Arquivo de autoload PSR-4 simples.
 *
 * Registra um autoloader que converte o nome da classe (incluindo namespace)
 * em um caminho de arquivo relativo e faz require_once se o arquivo existir.
 * Caso contrário, registra um erro no log e lança exceção.
 *
 * @see https://www.php-fig.org/psr/psr-4/
 */

spl_autoload_register(
/**
 * Função anônima de autoload.
 *
 * @param  string $class Nome totalmente qualificado da classe (namespace + nome da classe).
 * @return void
 * @throws \Exception Se o arquivo correspondente à classe não for encontrado.
 */
    function (string $class): void {
        $baseDir = dirname(__DIR__) . '/';

        $file = $baseDir . str_replace('\\', '/', $class) . '.php';

        if (file_exists($file)) {
            require_once $file;
        } else {
            error_log("Error loading class {$class}: File {$file} not found.");
            throw new \Exception("Class file '{$class}' not found: {$file}");
        }
    }
);

