<?php

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}


function component_path(string $name, array $params = []): string {
    extract($params); 
    ob_start();

    require __DIR__ . "/../../components/{$name}.view.php"; 
    return ob_get_clean(); 
}


function sanitize($dirty)
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}



