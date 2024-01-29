<?php
    /**
     * Zalman Izak
     * 01/17/24
     * Controller for the Job Application app:
     * https://thezalmanian.greenriverdev.com/328/Winter2024-SDEV328-Application/
     */

    // require Fat-Free Framework autoload file
    require_once("vendor/autoload.php");

    // instantiate Fat-Free Framework (f3) class
    $f3 = Base::instance();

    // define a default route for the project
    $f3->route("GET /", function() {
        // create a new view object
        $view = new Template();

        // display file at following path
        echo $view->render("views/home.html");
    });

    // define routes for the application process

    // define a personal info route
    $f3->route("GET /application-personal-info", function() {
        // create a new view object
        $view = new Template();

        // display file at following path
        echo $view->render("views/personal-info.html");
    });

    // define a prior experience route
    $f3->route("GET /application-experience", function() {
        // create a new view object
        $view = new Template();

        // display file at following path
        echo $view->render("views/experience.html");
    });

    // define a mailing list subscription route
    $f3->route("GET /application-mailing-lists", function() {
        // create a new view object
        $view = new Template();

        // display file at following path
        echo $view->render("views/mailing-lists.html");
    });

    // define a summary route
    $f3->route("GET /application-summary", function() {
        // create a new view object
        $view = new Template();

        // display file at following path
        echo $view->render("views/summary.html");
    });

    // run Fat-Free Framework
    $f3->run()
?>