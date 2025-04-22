<?php

namespace system\core;

/**
 * Helper class providing various utility methods for common tasks within the application.
 *
 * This class includes methods that are frequently used across the application, such as:
 * - Checking if the environment is local or production.
 * - Constructing a full URL based on the current environment.
 * - Redirecting to specific URLs.
 * - Sending JSON responses with status codes.
 *
 * These methods are designed to simplify common tasks and improve code readability and maintainability.
 */
class Helpers
{
    /**
     * Checks if the environment is local (localhost).
     *
     * This method inspects the `SERVER_NAME` to determine if the application is running on a local server
     * (e.g., localhost) or on a production environment. It returns true if the environment is localhost,
     * and false otherwise.
     *
     * @return bool True if the environment is localhost, false otherwise.
     */
    public static function localhost(): bool
    {
        $server = filter_input(INPUT_SERVER, 'SERVER_NAME');
        return $server == 'localhost';
    }

    /**
     * Constructs a full URL based on the current environment (development or production).
     *
     * This method checks the value of `SERVER_NAME` to determine whether the environment is local (localhost)
     * or production. It then appends the provided URL to the base URL of the appropriate environment.
     * If no URL is provided, it defaults to the base URL of the environment.
     *
     * @param string|null $url The relative URL to append to the base URL.
     * @return string The complete URL for the current environment.
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
     * Redirects the user to a new URL based on the provided slug.
     *
     * This method performs a URL redirection using the provided slug (or URL). If no slug is provided,
     * it defaults to redirecting the user to the home page. The redirection is performed with a 302 HTTP status code.
     *
     * @param string|null $url The slug (or URL) to redirect to. If not provided, the user is redirected to the home page.
     * @return void
     */
    public static function redirectUrl(string $url = null): void
    {
        header('HTTP/1.1 302 found');

        $local = ($url ? self::url($url) : self::url());

        header("location: {$local}");
        exit();
    }

    /**
     * Sends a JSON response with a given status code.
     *
     * This method sends a JSON response back to the client. It allows specifying a custom HTTP status code
     * for the response. By default, the status code is 200 (OK). The response is sent with the appropriate
     * `Content-Type` header for JSON responses.
     *
     * @param array $data The data to send in the JSON response.
     * @param int $statusCode The HTTP status code to use for the response. Defaults to 200 (OK).
     * @return void
     */
    public static function sendResponse(array $data, int $statusCode = 200): void
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);

    }
}
