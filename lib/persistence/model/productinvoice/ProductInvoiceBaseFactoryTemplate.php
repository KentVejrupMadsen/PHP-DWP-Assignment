<?php
    /**
     *  Title: ProductInvoiceFactory
     *  Author: Kent vejrup Madsen
     *  Type: PHP Script, Class
     *  Project: DWP-Assignment
     */

    /**
     * Class ProductInvoiceFactory
     */
    class ProductInvoiceBaseFactoryTemplate
        extends BaseFactoryTemplate
    {
        /**
         * ProductInvoiceFactory constructor.
         * @param $mysql_connector
         * @throws Exception
         */
        public function __construct( $mysql_connector )
        {
            $this->setWrapper( $mysql_connector );
            $this->setPaginationAndLimit(CONSTANT_FIVE, CONSTANT_ZERO);

        }


        /**
         * @return string
         */
        final public static function getTableName()
        {
            return 'product_invoice';
        }


        /**
         * @return mixed|string
         */
        final public function getFactoryTableName(): string
        {
            return self::getTableName();
        }


        /**
         * @return string
         */
        final public static function getViewName()
        {
            return 'ProductInvoiceView';
        }


        /**
         * @return string
         */
        final public static function getControllerName()
        {
            return 'ProductInvoiceController';
        }


        /**
         * @return bool|mixed
         * @throws Exception
         */
        final public function exist(): bool
        {
            $status_factory = new StatusFactory( $this->getWrapper() );
            
            $database = $this->getWrapper()->getInformation()->getDatabase();
            $value = $status_factory->getStatusOnTable( $database, self::getTableName() );
            
            return boolval( $value );
        }


        /**
         * @param $var
         * @return bool
         */
        final protected function validateAsValidModel( $var ): bool
        {
            $retVal = false;

            if( $var instanceof ProductInvoiceModelEntity )
            {
                $retVal = true;
            }

            return boolval( $retVal );
        }


        /**
         * @return ProductInvoiceModelEntity
         * @throws Exception
         */
        final public function createModel(): ProductInvoiceModelEntity
        {
            $model = new ProductInvoiceModelEntity( $this );
            return $model;
        }


        /**
         * @return array|mixed
         * @throws Exception
         */
        final public function read()
        {
            $retVal = null;

            $sql = "SELECT * FROM product_invoice LIMIT ? OFFSET ?;";

            $stmt_limit  = null;
            $stmt_offset = null;

            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );

                $stmt->bind_param( "ii",
                                    $stmt_limit,
                                    $stmt_offset );

                $stmt_limit  = intval( $this->getLimit(), 10 );
                $stmt_offset = intval( $this->CalculateOffset(), 10 );

                // Executes the query
                $stmt->execute();

                $result = $stmt->get_result();

                if( $result->num_rows > CONSTANT_ZERO )
                {
                    $retVal = array();

                    while( $row = $result->fetch_assoc() )
                    {
                        $model = $this->createModel();

                        $model->setIdentity( intval( $row[ 'identity' ], 10 ) );
                        
                        $model->setTotalPrice( doubleval( $row[ 'total_price' ] ) );
                        $model->setRegistered( $row[ 'invoice_registered' ] );

                        array_push( $retVal, $model );
                    }
                }
            }
            catch( Exception $ex )
            {
                throw new Exception( 'Error:' . $ex );
            }
            finally
            {
                $this->getWrapper()->disconnect();
            }

            return $retVal;
        }


        /**
         * @param $model
         * @return bool
         * @throws Exception
         */
        final public function readModel( &$model ): bool
        {
            if( !$this->validateAsValidModel( $model ) )
            {
                throw new Exception( 'Not accepted model' );
            }

            $retVal = false;

            $sql = "SELECT * FROM product_invoice WHERE identity = ?;";

            $stmt_identity  = null;

            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );

                $stmt->bind_param( "i",
                    $stmt_identity );

                $stmt_identity  = $model->getIdentity();

                // Executes the query
                $stmt->execute();

                $result = $stmt->get_result();

                if( $result->num_rows > CONSTANT_ZERO )
                {

                    while( $row = $result->fetch_assoc() )
                    {
                        $model = $this->createModel();

                        $model->setIdentity( $row[ 'identity' ] );

                        $model->setTotalPrice( $row[ 'total_price' ] );
                        $model->setRegistered( $row[ 'invoice_registered' ] );

                        $retVal = true;
                    }
                }
            }
            catch( Exception $ex )
            {
                throw new Exception( 'Error:' . $ex );
            }
            finally
            {
                $this->getWrapper()->disconnect();
            }

            return boolval( $retVal );
        }


        /**
         * @param $model
         * @return bool
         * @throws Exception
         */
        final public function create( &$model ): bool
        {
            if( !$this->validateAsValidModel( $model ) )
            {
                throw new Exception( 'Not accepted model' );
            }

            $retVal = false;

            //
            $sql = "INSERT INTO product_invoice( total_price, address_id, mail_id, owner_name_id ) VALUES( ?, ?, ?, ? );";

            $stmt_total_price = null;

            $stmt_addr_id = null;
            $stmt_mail_id = null;
            $stmt_owner_id = null;

            //
            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );

                //
                $stmt->bind_param( "diii",
                    $stmt_total_price,
                    $stmt_addr_id,
                    $stmt_mail_id,
                    $stmt_owner_id );

                $stmt_total_price   = $model->getTotalPrice();

                $stmt_addr_id       = $model->getAddressId();
                $stmt_mail_id       = $model->getMailId();
                $stmt_owner_id      = $model->getOwnerNameId();

                // Executes the query
                $stmt->execute();

                // commits the statement
                $model->setIdentity( $this->getWrapper()->finishCommitAndRetrieveInsertId( $stmt ) );

                $retVal = true;
            }
            catch( Exception $ex )
            {
                throw new Exception( 'Error:' . $ex );
            }
            finally
            {
                $this->getWrapper()->disconnect();
            }

            return boolval( $retVal );
        }


        /**
         * @param $model
         * @return mixed|void
         * @throws Exception
         */
        final public function update( &$model ): bool
        {
            if( !$this->validateAsValidModel( $model ) )
            {
                throw new Exception( 'Not accepted model' );
            }


            return false;
        }


        /**
         * @param $model
         * @return mixed|void
         * @throws Exception
         */
        final public function delete( &$model ): bool
        {
            if( !$this->validateAsValidModel( $model ) )
            {
                throw new Exception( 'Not accepted model' );
            }

            $retVal = false;

            $sql = "DELETE FROM product_invoice WHERE identity = ?;";

            $stmt_identity = null;

            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );

                //
                $stmt->bind_param( "i",
                    $stmt_identity );

                // Sets Statement Variables
                $stmt_identity = $model->getIdentity();

                // Executes the query
                $stmt->execute();

                // commits the statement
                $this->getWrapper()->finish();
                $retVal = true;
            }
            catch( Exception $ex )
            {
                // Rolls back, the changes
                $this->getWrapper()->undoState();
                throw new Exception( 'Error:' . $ex );
            }
            finally
            {
                $this->getWrapper()->disconnect();
            }

            return boolval( $retVal );
        }


        /**
         * @return int|mixed
         * @throws Exception
         */
        final public function length(): int
        {
            $retVal = CONSTANT_ZERO;

            $table_name = self::getTableName();
            $sql = "SELECT count( * ) AS number_of_rows FROM {$table_name};";
            
            $connection = $this->getWrapper()->connect();

            try 
            {
                $stmt = $connection->prepare( $sql );
                
                $stmt->execute();
                $result = $stmt->get_result();

                if( $result->num_rows > CONSTANT_ZERO )
                {
                    while( $row = $result->fetch_assoc() )
                    {
                        $retVal = $row[ 'number_of_rows' ];
                    }
                }  
            }
            catch( Exception $ex )
            {
                throw new Exception( 'Error:' . $ex );
            }
            finally
            {
                $this->getWrapper()->disconnect();
            }

            return intval( $retVal );
        }


        /**
         * @param $classObject
         * @return bool
         * @throws Exception
         */
        final public function classHasImplementedView( $classObject )
        {
            $retVal = false;

            if( is_null( $classObject ) )
            {
                throw new Exception('ArticleFactory - Static Function - classHasImplementedView, classObject is null, function only accepts classes');
            }

            if( !is_object( $classObject ) )
            {
                throw new Exception('ArticleFactory - Static Function - classHasImplementedView, classObject is not a object., function only accepts classes');
            }

            if( BaseFactoryTemplate::ModelImplements( $classObject, self::getViewName() ) )
            {
                $retVal = true;
                return boolval( $retVal );
            }

            return boolval( $retVal );
        }

    }

?>