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
    require_once("model/validate.php");

    // access business data
    require_once("model/data.php");

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
            $requiredField = [
                "firstName" => "validName",
                "lastName" => "validName",
                "email" => "validEmail",
                "phone" => "validPhone"
            ];

            $errorMessages = [
                "firstName" => "must be one word containing only letters.",
                "lastName" => "must be one word containing only letters.",
                "email" => "must be a valid email address.",
                "phone" => "must be all numbers, may contain dashes."
            ];

            // run through all fields that need validating
            foreach ($requiredField as $field => $validationMethod) {
                // if the current field is valid
                if($validationMethod( $_POST[$field] )) {
                    // store it within the session
                    $f3->set("SESSION.{$field}", $_POST[$field]);
                }

                // otherwise, set corresponding error to be displayed
                else {
                    $f3->set("errors['" . $field . "']", $errorMessages[$field]);
                }
            }

            // save state to session
            $f3->set("SESSION.state", $_POST["state"]);

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
            // if a portfolio was submitted
            $portfolioLink = $_POST["portfolio-link"];
            if(!empty($portfolioLink)) {
                // if the given url vas valid
                if(validLink($portfolioLink)) {
                    // store it within session
                    $f3->set("SESSION.portfolioLink", $portfolioLink);
                }

                // otherwise set error to be displayed
                else {
                    $f3->set("errors['portfolioLink']", "must be a valid url.");
                }
            }

            // if the given # of years experience was a valid radio value
            if(validExperience($_POST["years-experience"])) {
                // store it in session
                $f3->set("SESSION.yearsExperience", $_POST["years-experience"]);
            }

            // otherwise, set error to be displayed
            else {
                $f3->set("errors['yearsExperience']", "must be an option from below.");
            }

            // grab the given data and save to session
            $f3->set("SESSION.biography", $_POST["biography"]);
            $f3->set("SESSION.willingToRelocate", $_POST["willing-to-relocate"]);

            // If there are no errors
            if (empty($f3->get('errors'))) {
                // send user over to next application page
                $f3->reroute("application-mailing-lists");
            }
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