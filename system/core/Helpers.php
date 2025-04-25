<?php

namespace System\Core;

use System\Core\Render;

/**
 * Class Helpers
 *
 * Contém métodos utilitários para ajudar em diversas funções comuns na aplicação, como renderização de views,
 * geração de URLs e redirecionamentos.
 *
 * @package System\Core
 */
class Helpers
{
    /**
     * Verifica se o ambiente é o localhost.
     *
     * Este método verifica o nome do servidor e retorna true se estiver rodando no ambiente de desenvolvimento (localhost).
     *
     * @return bool Retorna true se o servidor for localhost, caso contrário, false.
     */
    public static function localhost(): bool
    {
        $server = filter_input(INPUT_SERVER, 'SERVER_NAME');
        return $server == 'localhost';
    }

    /**
     * Renderiza uma view HTML.
     *
     * Este método usa o `Render` para renderizar a view desejada com os dados passados.
     *
     * @param string $view Nome da view a ser renderizada.
     * @param array $data Dados a serem passados para a view.
     * @return null|string Retorna o HTML renderizado da view.
     */
    public static function view(string $view, array $data = []): null|string
    {
        return Render::renderHTML($view, $data);
    }

    /**
     * Gera a URL completa com base no ambiente de desenvolvimento ou produção.
     *
     * Este método gera uma URL completa, levando em consideração o ambiente em que a aplicação
     * está sendo executada (localhost ou produção).
     *
     * @param string|null $url URL relativa a ser concatenada à URL base do ambiente.
     * @return string A URL completa gerada.
     */
    public static function url(string $url = null): string
    {
        $server = filter_input(INPUT_SERVER, 'SERVER_NAME');
        $environmentInUse = ($server == 'localhost' ? DEVELOPMENT_URL : PRODUCTION_URL);

        if (strpos($url, '/') === 0) {
            return $environmentInUse . $url;
        }

        return $environmentInUse . '/' . $url;
    }

    /**
     * Realiza um redirecionamento para uma URL.
     *
     * Este método envia um cabeçalho HTTP 302 para redirecionar o usuário para uma URL específica ou para a URL base.
     *
     * @param string|null $url URL para redirecionamento. Se não fornecida, redireciona para a URL base.
     * @return void
     */
    public static function redirectToUrl(string $url = null): void
    {
        header('HTTP/1.1 302 found');

        $local = ($url ? self::url($url) : self::url());

        header("location: {$local}");
        exit();
    }
}
