<?php
    /**
     *  Title:
     *  Author:
     *  Type: PHP Script
     */

    /**
     * Interface MysqlConnectorTemplate
     */
    interface MysqlConnectorTemplate
        extends ConnectorTemplate
    {
        /**
         * @return mixed
         */
        public function undo_state();


        /**
         * @return mixed
         */
        public function finish();


        /**
         * @return mixed
         */
        public function finish_insert( $stmt );


        /**
         * @return mixed
         */
        public function is_open();
    }
?>