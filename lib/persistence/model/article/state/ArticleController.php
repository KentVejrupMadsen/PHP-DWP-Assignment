<?php 
    /**
     *  title:
     *  Author:
     *  Type: PHP Script
     */

    /**
     * Class ArticleController
     */
    class ArticleController
        extends BaseMVCController
    {
        /**
         * @param ArticleModel|null $model
         * @throws Exception
         */
        public function __construct( ?ArticleModel $model )
        {
            $this->setModel( $model );

            if( $model->isControllerNull() )
            {
                $model->setController( $this );
            }
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
        public function controllerTitle( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerContent( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerCreatedOn( $var ): void
        {

        }


        /**
         * @param $var
         */
        public function controllerLastUpdated( $var ): void
        {

        }

        public function getTitle()
        {

        }

        public function getContent()
        {

        }

        public function getCreatedOn()
        {

        }

        public function getLastUpdated()
        {


        }

    }

?>