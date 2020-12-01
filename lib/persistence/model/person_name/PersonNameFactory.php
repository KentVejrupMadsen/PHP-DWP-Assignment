<?php
    /**
     *  Title: PersonNameFactory
     *  Author: Kent vejrup Madsen
     *  Type: PHP Script, Class
     *  Project: DWP-Assignment
     */


    /**
     * Class PersonNameFactory
     */
    class PersonNameFactory
        extends BaseFactoryTemplate
    {
        /**
         * PersonNameFactory constructor.
         * @param $mysql_connector
         * @throws Exception
         */
        public function __construct( ?MySQLConnectorWrapper $mysql_connector )
        {
            $this->setupBase();
            $this->setWrapper( $mysql_connector );
            $this->setPaginationAndLimit(CONSTANT_FIVE, CONSTANT_ZERO);

        }


        /**
         * @return string
         */
        final public static function getTableName()
        {
            return 'person_name';
        }


        /**
         * @return string
         */
        final public function getFactoryTableName():string
        {
            return self::getTableName();
        }


        /**
         * @return string
         */
        final public static function getViewName()
        {
            return 'PersonNameView';
        }


        /**
         * @return string
         */
        final public static function getControllerName()
        {
            return 'PersonNameController';
        }


        /**
         * @return bool|mixed
         * @throws Exception
         */
        final public function exist(): bool
        {
            $status_factory = new StatusOnFactory( $this->getWrapper() );
            
            $database = $this->getWrapper()->getInformation()->getDatabase();
            $value = $status_factory->getStatusOnTable( $database, self::getTableName() );
            
            return boolval( $value );
        }


        /**
         * @return mixed|PersonNameModel
         */
        final public function createModel(): PersonNameModel
        {
            $model = new PersonNameModel( $this );
            return $model;
        }


        /**
         * @param $var
         * @return bool
         */
        final public function validateAsValidModel( $var )
        {
            $retVal = false;

            if( $var instanceof PersonNameModel )
            {
                $retVal = true;
            }

            return boolval( $retVal );
        }


        /**
         * @return array|mixed|null
         * @throws Exception
         */
        final public function read(): ?array
        {
            $retVal = null;

            $sql = "SELECT * FROM person_name LIMIT ? OFFSET ?;";

            $stmt_limit  = null;
            $stmt_offset = null;

            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );

                $stmt->bind_param( "ii",
                                    $stmt_limit,
                                    $stmt_offset );

                $stmt_limit  = $this->getLimitValue();
                $stmt_offset = $this->CalculateOffset();

                // Executes the query
                $stmt->execute();

                $result = $stmt->get_result();

                if( $result->num_rows > CONSTANT_ZERO )
                {
                    $retVal = array();

                    while( $row = $result->fetch_assoc() )
                    {
                        $model = $this->createModel();
                        
                        $model->setIdentity( $row[ 'identity' ] );
                        
                        $model->setFirstName( $row[ 'first_name' ] );
                        $model->setLastName( $row[ 'last_name' ] );
                        $model->setMiddleName( $row[ 'middle_name' ] );

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

            $sql = "SELECT * FROM person_name WHERE identity = ?;";

            $stmt_identity  = null;

            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );

                $stmt->bind_param( "i",
                    $stmt_identity );

                $stmt_limit  = $model->getIdentity();

                // Executes the query
                $stmt->execute();

                $result = $stmt->get_result();

                if( $result->num_rows > CONSTANT_ZERO )
                {
                    while( $row = $result->fetch_assoc() )
                    {
                        $model->setIdentity( $row[ 'identity' ] );

                        $model->setFirstName( $row[ 'first_name' ] );
                        $model->setLastName( $row[ 'last_name' ] );
                        $model->setMiddleName( $row[ 'middle_name' ] );

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
         * @return mixed
         * @throws Exception
         */
        final public function create( &$model ): bool
        {
            if( !$this->validateAsValidModel( $model ) )
            {
                throw new Exception( 'Not accepted model' );
            }

            $retVal = null;

            $sql = "INSERT INTO person_name( first_name, last_name, middle_name ) VALUES( ?, ?, ? );";

            $stmt_first_name    = null;
            $stmt_last_name     = null;
            $stmt_middle_name   = null;

            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );
                
                //
                $stmt->bind_param( "sss", 
                                    $stmt_first_name, 
                                    $stmt_last_name,
                                    $stmt_middle_name );

                //
                $stmt_first_name    = $model->getFirstName();
                $stmt_last_name     = $model->getLastName();
                $stmt_middle_name   = $model->getMiddleName();

                // Executes the query
                $stmt->execute();

                $model->setIdentity( $this->getWrapper()->finishCommitAndRetrieveInsertId( $stmt ) );
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
         * @param $model
         * @return mixed
         * @throws Exception
         */
        final public function update( &$model ): bool
        {
            if( !$this->validateAsValidModel( $model ) )
            {
                throw new Exception( 'Not accepted model' );
            }
            
            $retVal = false;

            $sql = "UPDATE person_name SET first_name = ?, last_name = ?, middle_name = ? WHERE identity = ?;";

            $stmt_first_name = null;
            $stmt_last_name = null;
            $stmt_middle_name = null;

            $stmt_identity = null;

            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );

                //
                $stmt->bind_param( "sssi",
                                    $stmt_first_name,
                                    $stmt_last_name,
                                    $stmt_middle_name,
                                    $stmt_identity );

                //
                $stmt_first_name    = $model->getFirstName();
                $stmt_last_name     = $model->getLastName();
                $stmt_middle_name   = $model->getMiddleName();

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

            return boolval($retVal);
        }


        /**
         * @param $model
         * @return bool|mixed
         * @throws Exception
         */
        final public function delete( &$model ): bool
        {
            if( !$this->validateAsValidModel( $model ) )
            {
                throw new Exception( 'Not accepted model' );
            }
            
            $retVal = null;

            $sql = "DELETE FROM person_name WHERE identity = ?;";

            $stmt_identity = null;

            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );
                
                //
                $stmt->bind_param( "i",  
                                    $stmt_identity );

                //
                $stmt_identity = intval( $model->getIdentity(), 10 );

                // Executes the query
                $stmt->execute();

                // commits the statement
                $this->getWrapper()->finish();

                $retVal = true;
            }
            catch( Exception $ex )
            {
                $retVal = false;

                // Rolls back, the changes
                $this->getWrapper()->undoState();

                throw new Exception( 'Error:' . $ex );
            }
            finally
            {
                $this->getWrapper()->disconnect();
            }

            return $retVal;
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
                //
                $this->getWrapper()->disconnect();
            }

            return intval( $retVal );
        }


        /**
         * @param array $filter
         * @return mixed|void
         */
        public function lengthCalculatedWithFilter(array $filter)
        {
            // TODO: Implement lengthCalculatedWithFilter() method.
        }


    }

?>