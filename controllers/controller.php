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
                        "yearsExperience" => "validExperience"
                    ]
                );

                // If there are no errors
                if (empty($this->_f3->get('errors'))) {
                    // get the current applicant from session
                    $currentApplicant = $this->_f3->get("SESSION.currentApplicant");

                    // update the applicant w/ latest submission data
                    $currentApplicant->setBiography($_POST["biography"]);
                    $currentApplicant->setPortfolioLink(!empty($_POST["portfolioLink"]) ? $_POST["portfolioLink"] : "N/A");
                    $currentApplicant->setYearsExperience($_POST["yearsExperience"]);
                    $currentApplicant->setWillingToRelocate(!empty($_POST["willingToRelocate"]) ? $_POST["willingToRelocate"] : "N/A");

                    // replace applicant in session w/ now updated version
                    $this->_f3->set("SESSION.currentApplicant", $currentApplicant);

                    // if the current applicant opted into subscribing for mailing lists
                    if($this->_f3->get("SESSION.currentApplicant") instanceof Applicant_SubscribedToLists) {
                        // send user over to next application page
                        $this->_f3->reroute("application-mailing-lists");
                    }

                    // otherwise, send them to the summary view
                    $this->_f3->reroute("application-summary");
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
            // jf mailing lists were selected
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // create array to store each type of mailing list
                $jobMailingLists = [];
                $verticalMailingLists = [];

                // run through all selected checkboxes in post
                foreach ($_POST as $currCheckbox => $value) {
                    // if the current checkbox is a job mailing list
                    if (array_key_exists($currCheckbox, ProjectData::getJobMailingLists())) {
                        // add its value to the corresponding array
                        $jobMailingLists[] = $value;
                    }

                    // if the current checkbox is a vertical mailing list
                    else if (array_key_exists($currCheckbox, ProjectData::getVerticalMailingLists())) {
                        // add its value to the corresponding array
                        $verticalMailingLists[] = $value;
                    }
                }

                // update the applicant object w/ the subscribed mailing lists
                $this->_f3->get("SESSION.currentApplicant")->setSelectedJobLists($jobMailingLists);
                $this->_f3->get("SESSION.currentApplicant")->setSelectedVerticalLists($verticalMailingLists);

                // send applicant over to the summary view
                $this->_f3->reroute("application-summary");
            }

            // create a new view object
            $view = new Template();

            // display mailing lists view
            echo $view->render("views/mailing-lists.html");
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