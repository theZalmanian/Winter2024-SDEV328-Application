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
         * @var string Url leading to applicant's selected portfolio
         */
        private $_portfolioLink;

        /**
         * @var string Range of years experience applicant has in field
         */
        private $_yearsExperience;

        /**
         * @var boolean Whether applicant is willing to relocate for position (true/false)
         */
        private $_willingToRelocate;

        /**
         * @var string Applicant's submitted biography, if any
         */
        private $_biography;

        /**
         * Constructs an Applicant, using given required values
         * @param string $firstName Applicant's legal first name
         * @param string $lastName Applicant's legal last name
         * @param string $email Applicant's email address
         * @param string $state U.S. state applicant resides in
         * @param string $phone Applicant's phone number
         */
        function __construct(string $firstName, string $lastName, string $email, string $state, string $phone)
        {
            // populate all given values
            $this->_firstName = $firstName;
            $this->_lastName = $lastName;
            $this->_email = $email;
            $this->_state = $state;
            $this->_phone = $phone;
        }

        /**
         * Gets and returns applicant's legal first name
         * @return string applicant's legal first name
         */
        public function getFirstName(): string
        {
            return $this->_firstName;
        }

        /**
         * Sets applicant's legal first name to the given name
         * @param string $firstName applicant's legal first name
         */
        public function setFirstName(string $firstName)
        {
            $this->_firstName = $firstName;
        }

        /**
         * Gets and returns applicant's legal last name
         * @return string applicant's legal last name
         */
        public function getLastName(): string
        {
            return $this->_lastName;
        }

        /**
         * Sets applicant's legal last name to the given name
         * @param string $lastName applicant's legal last name
         */
        public function setLastName(string $lastName)
        {
            $this->_lastName = $lastName;
        }

        /**
         * Gets and returns applicant's email address
         * @return string applicant's email address
         */
        public function getEmail(): string
        {
            return $this->_email;
        }

        /**
         * Sets applicant's email address to the given email address
         * @param string $email applicant's email address
         */
        public function setEmail(string $email)
        {
            $this->_email = $email;
        }

        /**
         * Gets and returns U.S. state applicant resides in
         * @return string U.S. state applicant resides in
         */
        public function getState(): string
        {
            return $this->_state;
        }

        /**
         * Sets U.S. state applicant resides in to the given state
         * @param string $state U.S. state applicant resides in
         */
        public function setState(string $state)
        {
            $this->_state = $state;
        }

        /**
         * Gets and returns applicant's phone number
         * @return string
         */
        public function getPhone(): string
        {
            return $this->_phone;
        }

        /**
         * Sets applicant's phone number to the given phone number
         * @param string $phone applicant's phone number
         */
        public function setPhone(string $phone)
        {
            $this->_phone = $phone;
        }

        /**
         * Gets and returns url leading to applicant's selected portfolio
         * @return string url leading to applicant's selected portfolio
         */
        public function getPortfolioLink(): string
        {
            return $this->_portfolioLink;
        }

        /**
         * Sets url leading to applicant's selected portfolio to given url
         * @param string $portfolioLink rul leading to applicant's selected portfolio
         */
        public function setPortfolioLink(string $portfolioLink)
        {
            $this->_portfolioLink = $portfolioLink;
        }

        /**
         * Gets and returns range of years experience applicant has in field
         * @return string range of years experience applicant has in field
         */
        public function getYearsExperience(): string
        {
            return $this->_yearsExperience;
        }

        /**
         * Sets range of years experience applicant has in field to given range
         * @param string $yearsExperience range of years experience applicant has in field
         */
        public function setYearsExperience(string $yearsExperience)
        {
            $this->_yearsExperience = $yearsExperience;
        }

        /**
         * Gets and returns whether applicant is willing to relocate for position (true/false)
         * @return bool whether applicant is willing to relocate for position (true/false)
         */
        public function isWillingToRelocate(): bool
        {
            return $this->_willingToRelocate;
        }

        /**
         * Sets whether applicant is willing to relocate for position (true/false) to given value
         * @param bool $willingToRelocate whether applicant is willing to relocate for position (true/false)
         */
        public function setWillingToRelocate(bool $willingToRelocate)
        {
            $this->_willingToRelocate = $willingToRelocate;
        }

        /**
         * Gets and returns applicant's submitted biography
         * @return string applicant's submitted biography
         */
        public function getBiography(): string
        {
            return $this->_biography;
        }

        /**
         * Sets applicant's submitted biography to the given value
         * @param string $biography applicant's submitted biography
         */
        public function setBiography(string $biography)
        {
            $this->_biography = $biography;
        }
    }
?>