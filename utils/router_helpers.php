<?php

/**
 * Get URI path.
 * @return string $uri  Sanitized URI
 */
function getUri(): string
{
    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    return $uri;
}

/**
 * Loads a view file
 * @param  string $view Example: 'index', 'about', 'contact'
 * @param  array  $data Passing vars to the view
 * @return void
 */
function view(string $view, array $data = []): void
{
    $file = APPROOT . '/src/views/' . $view . '.php';
    // Check for view file
    if (is_readable($file)) {
        require_once $file;
    } else {
        // View does not exist
        die('<h1> 404 Page not found </h1>');
    }
}

function sanitize($input)
{
    if (is_array($input)) {
        return sanitizeArray($input);
    } elseif (is_object($input)) {
        return sanitizeObject($input);
    } else {
        // If the input is not an array or an object, return it as is
        return $input;
    }
}


function sanitizeArray($array)
{
    $sanitizedArray = [];
    foreach ($array as $key => $object) {
        $sanitizedArray[$key] = sanitizeObject($object);
    }
    return $sanitizedArray;
}

function sanitizeObject($object)
{
    $sanitizedObject = new stdClass();
    foreach ($object as $key => $value) {
        $sanitizedObject->$key = htmlspecialchars($value);
    }
    return $sanitizedObject;
}
