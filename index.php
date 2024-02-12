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

    // access validation methods
    require_once ("model/validate.php");

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
    $f3->route("GET|POST /application-personal-info", function($f3) {
        // jf personal information was submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // if the given first name if valid
            if(validName($_POST["first-name"])) {
                // store it within session
                $f3->set("SESSION.firstName", $_POST["first-name"]);
            }

            // otherwise set error to be displayed
            else {
                $f3->set("errors['firstName']", "must be one word containing only letters.");
            }

            $lastName = $_POST["last-name"];
            $email = $_POST["email"];
            $state = $_POST["state"];
            $phone = $_POST["phone"];

            // save data to session
            $f3->set("SESSION.lastName", $lastName);
            $f3->set("SESSION.email", $email);
            $f3->set("SESSION.state", $state);
            $f3->set("SESSION.phone", $phone);

            // If there are no errors
            if (empty($f3->get('errors'))) {
                // send user over to next application page
                $f3->reroute("application-experience");
            }
        }

        // create a new view object
        $view = new Template();

        // display file at following path
        echo $view->render("views/personal-info.html");
    });

    // define a prior experience route
    $f3->route("GET|POST /application-experience", function($f3) {
        // jf prior experience was submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // grab the given data
            $biography = $_POST["biography"];
            $portfolioLink = $_POST["portfolio-link"];
            $yearsExperience = $_POST["years-experience"];
            $willingToRelocate = $_POST["willing-to-relocate"];

            // save data to session
            $f3->set("SESSION.biography", $biography);
            $f3->set("SESSION.portfolioLink", $portfolioLink);
            $f3->set("SESSION.yearsExperience", $yearsExperience);
            $f3->set("SESSION.willingToRelocate", $willingToRelocate);

            // send user over to next application page
            $f3->reroute("application-mailing-lists");
        }

        // create a new view object
        $view = new Template();

        // display file at following path
        echo $view->render("views/experience.html");
    });

    // define a mailing list subscription route
    $f3->route("GET|POST /application-mailing-lists", function($f3) {
        // jf prior experience was submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // create storage array
            $mailingLists = [];

            // run through the post array
            foreach ($_POST as $currCheckbox) {
                // add the current checkbox to storage array
                $mailingLists[] = $currCheckbox;
            }

            // save data to session
            $f3->set("SESSION.mailingLists", $mailingLists);

            // send user over to application summary page
            $f3->reroute("application-summary");
        }

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