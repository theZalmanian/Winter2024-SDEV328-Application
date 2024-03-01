<?php
    class Applicant_SubscribedToLists extends Applicant
    {
        /**
         * @var array An array containing all Reality Architecture Job (Mailing Lists) applicant signed up for
         */
        private $_selectedJobLists;

        /**
         * @var array An array containing all Relativistic Verticals (Mailing Lists) applicant signed up for
         */
        private $_selectedVerticalLists;

        /**
         * Gets and returns all Reality Architecture Job (Mailing Lists) applicant signed up for
         * @return array all Reality Architecture Job (Mailing Lists) applicant signed up for
         */
        function getSelectedJobLists(): array
        {
            return $this->_selectedJobLists;
        }

        /**
         * Stores the given array of Reality Architecture Job (Mailing Lists) applicant signed up for
         * @param array $selectedJobLists the Reality Architecture Job (Mailing Lists) applicant signed up for
         */
        public function setSelectedJobLists(array $selectedJobLists)
        {
            $this->_selectedJobLists = $selectedJobLists;
        }

        /**
         * Gets and returns all Relativistic Verticals (Mailing Lists) applicant signed up for
         * @return array all Relativistic Verticals (Mailing Lists) applicant signed up for
         */
        public function getSelectedVerticalLists(): array
        {
            return $this->_selectedVerticalLists;
        }

        /**
         * Stores the given array of Relativistic Verticals (Mailing Lists) applicant signed up for
         * @param array $selectedVerticalLists the Relativistic Verticals (Mailing Lists) applicant signed up for
         */
        public function setSelectedVerticalLists(array $selectedVerticalLists)
        {
            $this->_selectedVerticalLists = $selectedVerticalLists;
        }
    }
?>