<?php 
    /**
     *  title:
     *  Author:
     *  Type: PHP Script
     */

    /**
     * Class ImageController
     */
    class ImageController
        extends BaseMVCController
    {
        /**
         * @param ImageModel|null $model
         * @throws Exception
         */
        public function __construct( ?ImageModel $model )
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
        public function controllerImageSrc($var): void
        {

        }


        /**
         * @param $var
         */
        public function controllerImageType($var): void
        {

        }


        /**
         * @param $var
         */
        public function controllerTitle($var): void
        {

        }


        /**
         * @param $var
         * @return mixed
         */
        public function controllerAlt($var): void
        {

        }


        /**
         * @param $var
         */
        public function controllerParent($var): void
        {

        }


        /**
         * @param $var
         */
        public function controllerRegistered($var): void
        {

        }


        /**
         * @param $var
         */
        public function controllerLastUpdated($var): void
        {

        }

        public function getImageSrc()
        {

        }

        public function getImageType()
        {

        }

        public function getTitle()
        {

        }

        public function getAlt()
        {

        }

        public function getParent()
        {

        }

        public function getRegistered()
        {

        }

        public function getLastUpdated()
        {

        }

    }
?>