<?php

namespace App\Controllers;

class PageController extends AbstractController {

    public function showHomePage() {
        $this->render("home.view", []);
    }
}