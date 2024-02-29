<?php
    /**
     * Zalman Izak
     * 01/17/24
     * Controller for the Job Application app:
     * https://thezalmanian.greenriverdev.com/328/Winter2024-SDEV328-Application/
     */

    // display errors (when needed)
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // require Fat-Free Framework autoload file
    require_once("vendor/autoload.php");

    // instantiate Fat-Free Framework (f3) class and set up controller
    $f3 = Base::instance();
    $controller = new Controller($f3);

    // define a default route for the project
    $f3->route("GET /", function() {
        global $controller;

        // process and display the home page
        $controller->home();
    });

    // define routes for the application process

    // define a personal info route
    $f3->route("GET|POST /application-personal-info", function() {
        global $controller;

        // process and display the application's personal info page
        $controller->applicationPersonalInfo();
    });

    // define a prior experience route
    $f3->route("GET|POST /application-experience", function() {
        global $controller;

        // process and display the application's experience page
        $controller->applicationExperience();
    });

    // define a mailing list subscription route
    $f3->route("GET|POST /application-mailing-lists", function() {
        global $controller;

        // process and display the application's mailing lists page
        $controller->applicationMailingLists();
    });

    // define a summary route
    $f3->route("GET /application-summary", function() {
        global $controller;

        // process and display the application's summary page
        $controller->applicationSummary();
    });

    // run Fat-Free Framework
    $f3->run();
?>