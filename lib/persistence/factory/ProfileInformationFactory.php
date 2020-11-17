<?php 
    /**
     *  title:
     *  Author:
     *  Type: PHP Script
     */


    /**
     * Class ProfileInformationFactory
     */
    class ProfileInformationFactory 
        extends FactoryTemplate
    {
        /**
         * ProfileInformationFactory constructor.
         * @param $mysql_connector
         * @throws Exception
         */
        public function __construct( $mysql_connector )
        {
            $this->setWrapper( $mysql_connector );

            $this->setLimit( CONSTANT_ZERO );
            $this->setPaginationIndex( CONSTANT_ZERO );
        }


        /**
         * @return string
         */
        final public static function getTableName()
        {
            return 'profile_information';
        }


        /**
         * @return string
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
            return 'ProfileInformationView';
        }


        /**
         * @return string
         */
        final public static function getControllerName()
        {
            return 'ProfileInformationController';
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
         * @return mixed|ProfileInformationModel
         */
        final public function createModel()
        {
            $model = new ProfileInformationModel( $this );
            return $model;
        }


        /**
         * @param $var
         * @return bool
         */
        final public function validateAsValidModel( $var )
        {
            $retVal = false;

            if( $var instanceof ProfileInformationModel )
            {
                $retVal = true;
            }

            return boolval( $retVal );
        }


        /**
         * @return array|mixed
         * @throws Exception
         */
        final public function read()
        {
            $retVal = null;

            $sql = "SELECT * FROM profile_information LIMIT ? OFFSET ?;";

            $stmt_limit = null;
            $stmt_offset = null;

            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );

                $stmt->bind_param( "ii",
                                    $stmt_limit,
                                    $stmt_offset );

                $stmt_limit = intval( $this->getLimit(), 10 );
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

                        $model->setProfileId( intval( $row[ 'profile_id' ], 10 ) );

                        $model->setPersonNameId( intval( $row[ 'person_name_id' ], 10 ) );
                        $model->setPersonAddressId( intval( $row[ 'person_address_id' ], 10 ) );
                        $model->setPersonEmailId( intval( $row[ 'person_email_id' ], 10 ) );

                        $model->setPersonPhone( strval( $row[ 'person_phone' ] ) );
                        $model->setBirthday( strval( $row[ 'birthday' ] ) );

                        $model->setRegistered( $row[ 'registered' ] );

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
         * @return bool|mixed
         * @throws Exception
         */
        final public function read_model( &$model )
        {
            if( !$this->validateAsValidModel( $model ) )
            {
                throw new Exception( 'Not accepted model' );
            }

            //
            $sql = "SELECT * FROM profile_information WHERE profile_id = ?;";

            $stmt_profile_id = null;

            //
            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );

                $stmt->bind_param( "i",
                                    $stmt_profile_id );

                $stmt_profile_id = intval( $model->getProfileId(), 10 );

                // Executes the query
                $stmt->execute();

                $result = $stmt->get_result();

                if( $result->num_rows > CONSTANT_ZERO )
                {
                    while( $row = $result->fetch_assoc() )
                    {
                        $model->setIdentity( intval( $row[ 'identity' ], 10 ) );

                        $model->setProfileId( intval( $row[ 'profile_id' ], 10 ) );

                        $model->setPersonNameId( intval( $row[ 'person_name_id' ], 10 ) );
                        $model->setPersonAddressId( intval( $row[ 'person_address_id' ], 10 ) );
                        $model->setPersonEmailId( intval( $row[ 'person_email_id' ], 10 ) );

                        $model->setPersonPhone( strval( $row[ 'person_phone' ] ) );
                        $model->setBirthday( strval( $row[ 'birthday' ] ) );

                        $model->setRegistered( $row[ 'registered' ] );

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

            $sql = "INSERT INTO profile_information( profile_id, person_name_id, person_address_id, person_email_id, person_phone, birthday ) VALUES( ?, ?, ?, ?, ?, ? );";

            $stmt_profile_id        = null;
            $stmt_person_name_id    = null;
            $stmt_person_address_id = null;
            $stmt_person_email_id   = null;

            $stmt_person_phone      = null;
            $stmt_birthday          = null;

            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );
                
                //
                $stmt->bind_param( "iiiiss", 
                                    $stmt_profile_id, 
                                    $stmt_person_name_id,
                                    $stmt_person_address_id,
                                    $stmt_person_email_id,
                                    $stmt_person_phone,
                                    $stmt_birthday );

                //
                $stmt_profile_id        = intval( $model->getProfileId(), 10);

                $stmt_person_name_id    = intval( $model->getPersonNameId(), 10 );
                $stmt_person_address_id = intval( $model->getPersonAddressId(), 10 );
                $stmt_person_email_id   = intval( $model->getPersonEmailId(), 10 );

                $stmt_person_phone      = $model->getPersonPhone();
                $stmt_birthday          = $model->getBirthday();

                // Executes the query
                $stmt->execute();

                //
                $model->setIdentity( intval( $this->getWrapper()->finish_insert( $stmt ), 10) );
                $retVal = true;
            }
            catch( Exception $ex )
            {
                // Rolls back, the changes
                $this->getWrapper()->undo_state();
                throw new Exception( 'Error:' . $ex );
            }
            finally
            {
                $this->getWrapper()->disconnect();
            }
            
            return intval( $retVal );
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

            //
            $retVal = null;

            //
            $sql = "UPDATE profile_information SET profile_id = ?, person_name_id = ?, person_address_id = ?, person_email_id = ?, person_phone = ?, birthday = ? WHERE identity = ?;";

            //
            $stmt_profile_id = null;

            $stmt_person_name_id    = null;
            $stmt_person_address_id = null;
            $stmt_person_email_id   = null;
            $stmt_person_phone      = null;
            $stmt_birthday          = null;

            $stmt_identity          = null;

            //
            $connection = $this->getWrapper()->connect();

            try
            {
                $stmt = $connection->prepare( $sql );

                //
                $stmt->bind_param( "iiiissi",
                                    $stmt_profile_id,
                                    $stmt_person_name_id,
                                    $stmt_person_address_id,
                                    $stmt_person_email_id,
                                    $stmt_person_phone,
                                    $stmt_birthday,
                                    $stmt_identity );

                //
                $stmt_profile_id        = intval( $model->getProfileId(), BASE_10 );
                
                $stmt_person_name_id    = intval( $model->getPersonNameId(), BASE_10 );
                $stmt_person_address_id = intval( $model->getPersonAddressId(), BASE_10 );
                $stmt_person_email_id   = intval( $model->getPersonEmailId(), BASE_10 );

                $stmt_person_phone      = $model->getPersonPhone();
                $stmt_birthday          = $model->getBirthday();

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
                $this->getWrapper()->undo_state();
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
        final public function delete( &$model ): bool
        {
            if( !$this->validateAsValidModel( $model ) )
            {
                throw new Exception( 'Not accepted model' );
            }
            
            $retVal = false;

            $sql = "DELETE FROM profile_information WHERE identity = ?;";

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
                // Rolls back, the changes
                $this->getWrapper()->undo_state();
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
        final public function classHasImplementedController( $classObject )
        {
            $retVal = false;

            if( is_null( $classObject ) )
            {
                throw new Exception('ArticleFactory - Static Function - classHasImplementedController, classObject is null, function only accepts classes');
            }

            if( !is_object( $classObject ) )
            {
                throw new Exception('ArticleFactory - Static Function - classHasImplementedController, classObject is not a object. function only accepts classes.');
            }

            if( FactoryTemplate::ModelImplements( $classObject, self::getControllerName() ) )
            {
                $retVal = true;
                return boolval( $retVal );
            }

            return boolval( $retVal );
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

            if( FactoryTemplate::ModelImplements( $classObject, self::getViewName() ) )
            {
                $retVal = true;
                return boolval( $retVal );
            }

            return boolval( $retVal );
        }

    }

?>