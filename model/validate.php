<?php
    /**
     * Gets and returns an associative array containing all required form fields, and their corresponding error messages
     * @return string[] an associative array containing all required form fields, and their corresponding error messages
     */
    function getErrorMessages() {
        return array(
            "firstName" => "must be one word containing only letters.",
            "lastName" => "must be one word containing only letters.",
            "email" => "must be a valid email address.",
            "phone" => "must be all numbers, may contain dashes."
        );
    }

    /**
     * Runs through $_POST, and checks if each field in $requiredFields is present, and has a value which is considered
     * valid according to that field's corresponding validation method
     * <br><br>
     * If the field's value in $_POST is valid, it is saved to session under the same key. Otherwise, an error message
     * corresponding to that field is set to be displayed on the current form
     * @param Base $f3 A connection to the Fat Free Framework, used to store values in $_SESSION and set errors
     * @param string[] $requiredFields An array containing the fields required on the current form, and their
     * corresponding validation methods
     */
    function validateAllRequiredFields($f3, $requiredFields) {
        // run through all fields that need validating
        foreach ($requiredFields as $field => $validationMethod) {
            // if the current field is valid
            if($validationMethod( $_POST[$field] )) {
                // store it within the session
                $f3->set("SESSION.{$field}", $_POST[$field]);
            }

            // otherwise, set corresponding error to be displayed
            else {
                $f3->set("errors['" . $field . "']", getErrorMessages()[$field]);
            }
        }
    }

    /**
     * Checks if the given name is valid, and returns true/false accordingly
     * @param string $name The name being checked
     * @return boolean True if the given name is valid; otherwise False
     */
    function validName($name) {
        // check and return whether the string contains only letters
        return ctype_alpha(trim($name));
    }

    /**
     * Checks if the given email address is valid, and returns true/false accordingly
     * @param string $email The email address being checked
     * @return boolean True if the given email address is valid; otherwise False
     */
    function validEmail($email) {
        return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    }

    /**
     * Checks if the given phone number is valid, and returns true/false accordingly
     * @param string $phone The phone number being checked
     * @return boolean True if the given phone number is valid; otherwise False
     */
    function validPhone($phone) {
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
    function validLink($link) {
        return filter_var(trim($link), FILTER_VALIDATE_URL);
    }

    /**
     * Checks if the given experience value is expected on form, and returns true/false accordingly
     * @param string $experienceValue The value being checked
     * @return boolean True if the given experience value is expected on form; otherwise False
     */
    function validExperience($experienceValue)
    {
        return $experienceValue == "0-2"
            || $experienceValue == "2-4"
            || $experienceValue == "4+";
    }
?>