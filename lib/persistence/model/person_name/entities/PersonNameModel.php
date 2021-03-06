<?php

    /**
     * Class PersonNameModel
     */
    class PersonNameModel
        extends DatabaseModelEntity
    {
        // Constructors
        /**
         * PersonNameModel constructor.
         * @param $factory
         * @throws Exception
         */
        public function __construct( ?PersonNameFactory $factory )
        {
            $this->setFactory( $factory );
        }


        /**
         * @return bool
         */
        final public function requiredFieldsValidated(): bool
        {
            $fn_has_input = !is_null($this->first_name);
            $ln_has_input = !is_null($this->last_name);
            $mn_has_input = !is_null($this->middle_name);

            $retVal = ($fn_has_input && $ln_has_input && $mn_has_input);
            return $retVal;
        }


        // Variables
        private $first_name     = null;
        private $last_name      = null;
        private $middle_name    = null;

        // implementation of factory classes
        /**
         * @param $factory
         * @return bool|mixed
         */
        final protected function validateFactory( $factory )
        {
            if( $factory instanceof PersonNameFactory )
            {
                return true;
            }

            return false;
        }


        // accessors
            // getters
        /**
         * @return string|null
         */
        final public function getFirstName()
        {
            if( is_null( $this->first_name ) )
            {
                return null;
            }

            return strval( $this->first_name );
        }


        /**
         * @return string|null
         */
        final public function getLastName()
        {
            if( is_null( $this->last_name ) )
            {
                return null;
            }

            return strval( $this->last_name );
        }


        /**
         * @return string|null
         */
        final public function getMiddleName()
        {
            if( is_null( $this->middle_name ) )
            {
                return null;
            }

            return strval( $this->middle_name );
        }


            // Setters
        /**
         * @param $var
         */
        final public function setFirstName( $var )
        {
            $this->first_name = $var;
        }


        /**
         * @param $var
         */
        final public function setMiddleName( $var )
        {
            $this->middle_name = $var;
        }


        /**
         * @param $var
         */
        final public function setLastName( $var )
        {
            $this->last_name = $var;
        }

    }


?>