<?php
    /**
     *  Title:
     *  Author:
     *  Type: PHP Script
     */

    require_once 'router.php';

    /**
     * Class RouterSingleton
     */
    class RouterSingleton
    {
        /**
         * RouterSingleton constructor.
         * @throws Exception
         */
        function __construct()
        {
            if( is_null( self::$instance ) )
            {
                self::setInstance( new Router() );
            }
        }

        //
        private static $instance = null;


        /**
         * @return Router|null
         * @throws Exception
         */
        public static function getInstance(): ?Router
        {
            if( is_null( self::$instance ) )
            {
                return null;
            }

            return self::$instance;
        }


        /**
         * @param $var
         * @return Router|null
         * @throws Exception
         */
        public static function setInstance( $var ): ?Router
        {
            if( is_null( $var ) )
            {
                self::$instance = null;
                return self::getInstance();
            }

            if( !( $var instanceof Router ) )
            {
                throw new Exception('Error, Router set instance');
            }

            self::$instance = $var;

            return self::getInstance();
        }
    }

?>