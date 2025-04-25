<?php

namespace System\Core;

/**
 * Class Render
 *
 * Responsável por renderizar templates de conteúdo dentro de layouts HTML.
 *
 * Faz o buffering da saída, extrai variáveis de dados para uso nas views
 * e inclui o conteúdo no layout especificado.
 *
 * @package System\Core
 */
class Render
{
    /**
     * Renderiza um template HTML dentro de um layout.
     *
     * Este método carrega o layout e o conteúdo a partir dos arquivos PHP correspondentes,
     * extrai as variáveis de dados para o escopo da view e captura a saída em buffer.
     * Caso o layout ou o conteúdo não existam, exibe mensagem de erro.
     *
     * @param string $contentFile Nome do arquivo de conteúdo (subpasta 'contents', sem a extensão '.php').
     * @param array  $data        Array associativo de dados a serem extraídos para a view.
     * @param string $layoutFile  Nome do arquivo de layout (padrão 'master', sem a extensão '.php').
     * @return void
     */
    public static function renderHTML(string $contentFile, array $data = [], string $layoutFile = 'master'): void
    {
        $layoutPath  = __DIR__ . '/../../template/' . $layoutFile . '.php';
        if (!file_exists($layoutPath)) {
            echo "Erro: Layout não encontrado!";
            return;
        }

        $contentPath = __DIR__ . '/../../template/contents/' . $contentFile . '.php';
        if (!file_exists($contentPath)) {
            echo "Erro: Página não encontrada!";
            return;
        }

        ob_start();
        extract($data);
        include $contentPath;
        $content = ob_get_clean();

        include $layoutPath;
    }
}
