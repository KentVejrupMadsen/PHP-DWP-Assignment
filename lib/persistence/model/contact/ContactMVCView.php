<?php 
    /**
     *  title:
     *  Author:
     *  Type: PHP Script
     */

    /**
     * Class ContactView
     */
     class ContactMVCView
        extends BaseMVCView
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
         final public function validateModel( $model ): bool
         {
             $retval = false;
 
             if( $model instanceof ContactModelEntity )
             {
                 $retval = true;
             }
 
             return boolval( $retval );
         }


         /**
          * @return int|mixed|null
          */
         final public function viewIdentity()
         {
             if( $this->viewIsIdentityNull() )
             {
                 return null;
             }

             return $this->getIdentity();
         }


         /**
          * @return bool|mixed
          */
         final public function viewIsIdentityNull()
         {
             $retVal = false;

             if( is_null( $this->identity ) )
             {
                 $retVal = true;
             }

             return boolval( $retVal );
         }


     }

?>