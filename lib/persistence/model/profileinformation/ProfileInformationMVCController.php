<?php 
    /**
     *  title:
     *  Author:
     *  Type: PHP Script
     */

    /**
     * Class ProfileInformationController
     */
    class ProfileInformationMVCController
        extends BaseMVCController
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
        public function controllerProfile( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerPersonName( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerPersonAddress( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerPersonEmail( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerPersonPhone( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerBirthday( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerRegistered( $var ): void
        {

        }
    }
?>