<?php
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
     * Checks if the given email address is valid, and returns true/false accordingly
     * @param string $email The email address being checked
     * @return boolean True if the given email address is valid; otherwise False
     */
    function validEmail($email) {
        return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    }
?>