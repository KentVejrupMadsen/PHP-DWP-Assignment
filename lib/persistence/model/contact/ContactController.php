<?php 
    /**
     *  title:
     *  Author:
     *  Type: PHP Script
     */

    /**
     * Class ContactController
     */
    class ContactController
        extends BaseController
    {
        /**
         * @param $model
         * @throws Exception
         */
        public function __constructor( $model )
        {
            $this->setModel( $model );
        }


        /**
         * @param $model
         * @return bool
         */
        public function validateModel( $model ): bool
        {
            // TODO: Implement validateModel() method.
            return false;
        }


        /**
         * @param $var
         */
        public function controllerSubject( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerMessage( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerHasBeenSend( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerToMail( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerFrom( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerCreatedOn( $var ): void
        {

        }
    }
?>