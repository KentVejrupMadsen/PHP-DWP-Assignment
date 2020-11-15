<?php

    /**
     * Class ProductCategoryModel
     */
    class ProductCategoryModel 
        extends DatabaseModel
            implements ProductCategoryController,
                       ProductCategoryView
    {
        // Constructors
        /**
         * ProductCategoryModel constructor.
         * @param $factory
         * @throws Exception
         */
        public function __construct( $factory )
        {
            $this->setFactory( $factory );
        }


        // implement interfaces
        /**
         * @return int|mixed|null
         */
        final public function viewIdentity()
        {
            if( $this->viewIsIdentityNull() )
            {
                return null;
            }

            return $this->getIdentity();
        }


        /**
         * @return bool|mixed
         */
        final public function viewIsIdentityNull()
        {
            $retVal = false;

            if( is_null( $this->identity ) == true )
            {
                $retVal = true;
            }

            return $retVal;
        }


        /**
         * @return bool|mixed
         */
        final public function requiredFieldsValidated()
        {
            $retVal = false;

            return $retVal;
        }


        /**
         * @return mixed|void
         */
        final public function viewContent()
        {
            // TODO: Implement viewContent() method.
            return null;
        }


        /**
         * @param $var
         * @return mixed|null
         */
        final public function controllerContent($var)
        {
            // TODO: Implement controllerContent() method.
            return null;
        }


        // Variables
        private $identity = null;
        private $content  = null;


        // implementation of factory classes
        /**
         * @param $factory
         * @return bool|mixed
         */
        final protected function validateFactory( $factory )
        {
            if( $factory instanceof ProductCategoryFactory )
            {
                return true;
            }

            return false;
        }

        
        // accessors
            // getters
        /**
         * @return int|null
         */
        final public function getIdentity()
        {
            if( is_null( $this->identity ) )
            {
                return null;
            }

            return intval( $this->identity, self::base() );
        }


        /**
         * @return |null
         */
        final public function getContent()
        {
            return $this->content;
        }


            // setters
        /**
         * @param $var
         * @throws Exception
         */
        final public function setIdentity( $var )
        {
            $value = filter_var( $var, FILTER_VALIDATE_INT  );

            if( !$this->identityValidation( $value ) )
            {
                throw new Exception( 'ProductCategoryModel - setIdentity: null or numeric number is allowed' );
            }
            
            $this->identity = $value;
        }


        /**
         * @param $var
         */
        final public function setContent( $var )
        {
            $this->content = $var;
        }

    }

?>