<?php

namespace App\Controllers;


abstract class AbstractController {

    protected function render($view, $params) {      
        extract($params);
    
        ob_start();

        require __DIR__ . "/../views/components/" . $view . ".php";
        $contents = ob_get_clean();

            
        require __DIR__ . '/../views/layout/main.view.php';
    }
}