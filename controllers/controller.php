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
         * Routes to the Application's Home view
         */
        function home()
        {
            // create a new view object
            $view = new Template();

            // display home view
            echo $view->render("views/home.html");
        }

        /**
         * Routes to the Application: Personal Info view
         */
        function applicationPersonalInfo()
        {
            // jf personal information was submitted
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // validate all required fields on personal info form
                Validation::validateAllRequiredFields($this->_f3,
                    [
                        "firstName" => "validName",
                        "lastName" => "validName",
                        "email" => "validEmail",
                        "phone" => "validPhone"
                    ]
                );

                // If there are no errors/all fields are valid
                if (empty($this->_f3->get('errors'))) {
                    // check if applicant opted into receiving mailing lists
                    $applicantClass = $_POST["get-mailing-lists"] ? "Applicant_SubscribedToLists" : "Applicant";

                    // create applicant using corresponding class and submitted data, and store in session
                    $this->_f3->set("SESSION.currentApplicant",
                        new $applicantClass(
                            $_POST["firstName"],
                            $_POST["lastName"],
                            $_POST["email"],
                            $_POST["state"],
                            $_POST["phone"]
                        )
                    );

                    // send applicant over to next application page
                    $this->_f3->reroute("application-experience");
                }
            }

            // create a new view object
            $view = new Template();

            // display personal info view
            echo $view->render("views/personal-info.html");
        }

        /**
         * Routes to Application: Experience page
         */
        function applicationExperience()
        {
            // jf prior experience was submitted
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // validate all required fields on prior experience form
                Validation::validateAllRequiredFields($this->_f3,
                    [
                        "portfolioLink" => "validLink",
                        "yearsExperience" => "validExperience",
                    ]
                );

                // If there are no errors
                if (empty($this->_f3->get('errors'))) {
                    // update application object in session w/ the latest submission data
                    $this->_f3->get("SESSION.currentApplicant")->setBiography($_POST["biography"]);

                    if(!empty($_POST["portfolioLink"])) {
                        $this->_f3->get("SESSION.currentApplicant")->setPortfolioLink($_POST["portfolioLink"]);
                    }

                    $this->_f3->get("SESSION.currentApplicant")->setYearsExperience($_POST["yearsExperience"]);

                    if(!empty($_POST["willingToRelocate"])) {
                        $this->_f3->get("SESSION.currentApplicant")->setWillingToRelocate($_POST["willingToRelocate"]);
                    }

                    // send user over to next application page
                    $this->_f3->reroute("application-mailing-lists");
                }
            }

            // create a new view object
            $view = new Template();

            // display prior experience view
            echo $view->render("views/experience.html");
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

            echo "<pre>";
            var_dump($_SESSION);
            echo "</pre>";
        }
    }
?>