<?php

    /**
     * Class ProductAttributeModel
     */
    class ProductAttributeModelEntity
        extends DatabaseModelEntity
    {
        // Constructors
        /**
         * ProductAttributeModel constructor.
         * @param $factory
         * @throws Exception
         */
        public function __construct( $factory )
        {
            $this->setFactory( $factory );   
        }


        // Variables
        private $content  = null;


        // implementation of factory classes
        /**
         * @param $factory
         * @return bool|mixed
         */
        final protected function validateFactory( $factory )
        {
            $retVal = false;

            if( $factory instanceof ProductAttributeFactory )
            {
                $retVal = true;
            }

            return boolval( $retVal );
        }


        /**
         * @return bool|mixed
         */
        final public function requiredFieldsValidated()
        {
            $retVal = false;

            return boolval( $retVal );
        }


        // accessors
            // Getters
        /**
         * @return string|null
         */
        final public function getContent()
        {
            if( is_null( $this->content ) )
            {
                return null;
            }

            return strval( $this->content );
        }


            // setters
        /**
         * @param $var
         */
        final public function setContent( $var )
        {
            $this->content = $var;
        }

    }

?>