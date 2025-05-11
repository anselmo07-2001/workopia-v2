<?php

namespace App\Controllers;

class PageController extends AbstractController {

    //create a constructor that will accept the Job Repository
    

    public function showHomePage() {
        //create a repo function that will get the first 6 of the job list

        $this->render("home.view", []);
    }
}