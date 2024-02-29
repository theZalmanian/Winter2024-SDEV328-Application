<?php
    class Applicant
    {
        /**
         * @var string Applicant's legal first name
         */
        private $_firstName;

        /**
         * @var string Applicant's legal last name
         */
        private $_lastName;

        /**
         * @var string Applicant's email address
         */
        private $_email;

        /**
         * @var string U.S. state applicant resides in
         */
        private $_state;

        /**
         * @var string Applicant's phone number
         */
        private $_phone;

        /**
         * @var string Link leading to applicant's selected portfolio
         */
        private $_portfolioLink;

        /**
         * @var string Range of years experience applicant has in field
         */
        private $_yearsExperience;

        /**
         * @var boolean True if applicant is willing to relocate for position; otherwise False
         */
        private $_willingToRelocate;

        /**
         * @var string Applicant's submitted biography, if any
         */
        private $_biography;
    }
?>