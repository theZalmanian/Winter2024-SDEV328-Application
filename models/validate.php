<?php
    /**
     * Contains all validation functions and helpers for project
     */
    Class Validation {
        /**
         * Gets and returns an associative array containing all required form fields, and their corresponding error messages
         * @return string[] an associative array containing all required form fields, and their corresponding error messages
         */
        static function getErrorMessages() {
            return array(
                "firstName" => "must be one word containing only letters.",
                "lastName" => "must be one word containing only letters.",
                "email" => "must be a valid email address.",
                "phone" => "must be all numbers, may contain dashes.",
                "portfolioLink" => "must be a valid url.",
                "yearsExperience" => "must be an option from below."
            );
        }

        /**
         * Runs through POST, and checks if each field in $requiredFields contains a value which is valid according to
         * it's corresponding validation method.
         * <br><br>
         * If the field is not considered valid, a corresponding error message is set to be displayed on the current form
         * @param Base $f3 Connection to the Fat Free Framework, used to set errors if field invalid
         * @param string[] $requiredFields Array of all fields required on form, and their corresponding validation methods
         */
        static function validateAllRequiredFields($f3, $requiredFields) {
            // run through all given fields
            foreach ($requiredFields as $field => $validationMethod) {
                // check if current field is valid using the given method name
                $fieldValid = Validation::$validationMethod( $_POST[$field] );

                // if the field is not valid
                if(!$fieldValid) {
                    // set corresponding error to be displayed
                    $f3->set("errors['" . $field . "']", Validation::getErrorMessages()[$field]);
                }
            }
        }

        /**
         * Checks if the given name is valid, and returns true/false accordingly
         * @param string $name The name being checked
         * @return boolean True if the given name is valid; otherwise False
         */
        static function validName($name) {
            // check and return whether the string contains only letters
            return ctype_alpha(trim($name));
        }

        /**
         * Checks if the given email address is valid, and returns true/false accordingly
         * @param string $email The email address being checked
         * @return boolean True if the given email address is valid; otherwise False
         */
        static function validEmail($email) {
            return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        }

        /**
         * Checks if the given phone number is valid, and returns true/false accordingly
         * @param string $phone The phone number being checked
         * @return boolean True if the given phone number is valid; otherwise False
         */
        static function validPhone($phone) {
            // allows the following formats:
            // 123 456 7890 or 123456 7890 or 123 4567890 or 1234567890
            $withSpacesOptional = '/^(\d{3}\s?)(\d{3}\s?)(\d{4})$/';

            // allows the following format: 123-456-7890
            $withDashes = '/^(\d{3})-(\d{3})-(\d{4})$/';

            // check and return whether given number follows
            // at least one of the above defined formats
            return preg_match($withSpacesOptional, trim($phone))
                || preg_match($withDashes, trim($phone));
        }

        /**
         * Checks if the given link is valid, and returns true/false accordingly
         * @param string $link The link being checked
         * @return boolean True if the given link is valid; otherwise False
         */
        static function validLink($link) {
            // if a link was given to validate
            if(!empty($link)) {
                // check if it is a valid url
                return filter_var(trim($link), FILTER_VALIDATE_URL);
            }

            // if no link was given, it is not a required field
            return true;
        }

        /**
         * Checks if the given experience value is expected on form, and returns true/false accordingly
         * @param string $experienceValue The value being checked
         * @return boolean True if the given experience value is expected on form; otherwise False
         */
        static function validExperience($experienceValue)
        {
            return $experienceValue == "0-2"
                || $experienceValue == "2-4"
                || $experienceValue == "4+";
        }
    }
?>