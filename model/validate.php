<?php
    /**
     * Checks if the given name is valid, and returns true/false accordingly
     * @param string $name The name being checked
     * @return boolean True if the given name is valid; otherwise False
     */
    function validName($name) {
        // check and return whether the string contains only letters
        return ctype_alpha($name);
    }

    /**
     * Checks if the given link is valid, and returns true/false accordingly
     * @param string $link The link being checked
     * @return boolean True if the given link is valid; otherwise False
     */
    function validLink($link) {
        return filter_var($link, FILTER_VALIDATE_URL);
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
     * @return void
     */
    function validPhone() {

    }

    /**
     * @return void
     */
    function validEmail() {

    }
?>