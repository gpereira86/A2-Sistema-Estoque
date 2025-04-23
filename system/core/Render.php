<?php

namespace System\Core;

class Render
{


    /**
     * Renders an HTML file and outputs its content to the browser.
     *
     * This method is responsible for loading the specified HTML file, extracting any data passed
     * as an associative array, and rendering the content. If the HTML file does not exist, it throws
     * an exception with an error message.
     *
     * It utilizes output buffering to capture the content of the HTML file and pass any variables
     * extracted from the data array.
     *
     * @param string $file The path to the HTML file to be rendered.
     * @param array $data Optional associative array of data to be passed to the HTML file.
     * @throws \Exception If the specified HTML file is not found.
     */
    public static function renderHTML($contentFile, $data = [], $layoutFile = 'master')
    {
        $layoutPath = './template/' . $layoutFile . '.php';

        if (!file_exists($layoutPath)) {
            echo "Erro: Layout não encontrado!";
            return;
        }

        $contentPath = './template/contents/' . $contentFile . '.php';

        if (!file_exists($contentPath)) {
            echo "Erro: Página não encontrada!";
            return;
        }

        ob_start();
        extract($data);
        include($contentPath);
        $content = ob_get_clean();

        include($layoutPath);
    }
}