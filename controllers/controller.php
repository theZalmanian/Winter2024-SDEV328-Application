<?php
    /**
     * Main controller for Application project
     */
    class Controller
    {
        /**
         * Connection to the F3 framework for routing
         */
        private $_f3;

        /**
         * Constructs a controller object with the given connection to F3 for routing
         * @param Base $f3 connection to the F3 framework for routing
         */
        function __construct($f3)
        {
            $this->_f3 = $f3;
        }

        /**
         * Routes to the Application's Home page
         */
        function home()
        {
            // create a new view object
            $view = new Template();

            // display file at following path
            echo $view->render("views/home.html");
        }

        /**
         * Routes to the Application: Personal Info page
         */
        function applicationPersonalInfo()
        {
            // jf personal information was submitted
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $requiredFields = [
                    "firstName" => "validName",
                    "lastName" => "validName",
                    "email" => "validEmail",
                    "phone" => "validPhone"
                ];

                // validate all fields on personal info form
                Validation::validateAllRequiredFields($this->_f3, $requiredFields);

                // If there are no errors
                if (empty($this->_f3->get('errors'))) {
                    // if user opted into receiving job mailing lists
                    if($_POST["get-mailing-lists"]) {
                        // create applicant subscribed to lists object using given data
                        $this->_f3->set("SESSION.currentApplicant",
                            new Applicant_SubscribedToLists(
                                $_POST["firstName"],
                                $_POST["lastName"],
                                $_POST["email"],
                                $_POST["state"],
                                $_POST["phone"]
                            )
                        );
                    }

                    else {
                        // otherwise create basic applicant object using given data
                        $this->_f3->set("SESSION.currentApplicant",
                            new Applicant(
                                $_POST["firstName"],
                                $_POST["lastName"],
                                $_POST["email"],
                                $_POST["state"],
                                $_POST["phone"]
                            )
                        );
                    }

                    // send user over to next application page
                    $this->_f3->reroute("application-experience");
                }
            }

            // create a new view object
            $view = new Template();

            // display file at following path
            echo $view->render("views/personal-info.html");
        }

        /**
         * Routes to Application: Experience page
         */
        function applicationExperience()
        {
            // jf prior experience was submitted
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // if a portfolio was submitted
                $portfolioLink = $_POST["portfolio-link"];
                if(!empty($portfolioLink)) {
                    // if the given url vas valid
                    if(Validation::validLink($portfolioLink)) {
                        // store it within session
                        $this->_f3->set("SESSION.portfolioLink", $portfolioLink);
                    }

                    // otherwise set error to be displayed
                    else {
                        $this->_f3->set("errors['portfolioLink']", "must be a valid url.");
                    }
                }

                // if the given # of years experience was a valid radio value
                if(Validation::validExperience($_POST["years-experience"])) {
                    // store it in session
                    $this->_f3->set("SESSION.yearsExperience", $_POST["years-experience"]);
                }

                // otherwise, set error to be displayed
                else {
                    $this->_f3->set("errors['yearsExperience']", "must be an option from below.");
                }

                // grab the given data and save to session
                $this->_f3->set("SESSION.biography", $_POST["biography"]);
                $this->_f3->set("SESSION.willingToRelocate", $_POST["willing-to-relocate"]);

                // If there are no errors
                if (empty($this->_f3->get('errors'))) {
                    // send user over to next application page
                    $this->_f3->reroute("application-mailing-lists");
                }
            }

            // create a new view object
            $view = new Template();

            // display file at following path
            echo $view->render("views/experience.html");

            echo "<pre>";
            var_dump($_SESSION);
            echo "</pre>";
        }

        /**
         * Routes to the Application: Mailing Lists page
         */
        function applicationMailingLists()
        {
            // create a new view object
            $view = new Template();

            // display mailing lists view
            echo $view->render("views/mailing-lists.html");

            // if the user did not opt into signing up for mailing lists
            if($_SESSION["getMailingLists"] != "true") {
                // send them off to the summary view
                $this->_f3->reroute("application-summary");
            }

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
                $this->_f3->set("SESSION.mailingLists", $mailingLists);

                // send them off to the summary view
                $this->_f3->reroute("application-summary");
            }
        }

        /**
         * Routes to the Application: Summary page
         */
        function applicationSummary() {
            // create a new view object
            $view = new Template();

            // display application summary view
            echo $view->render("views/summary.html");
        }
    }
?>