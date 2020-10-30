<?php 

    //
    require 'globals.php';
    
    //
    require 'functions.php';

    //
    require 'autoloader.php';

    // Autoloader script for loading classes automaticly.
    // So i don't have to require the files
    spl_autoload_register(
        function ( $class_name ) 
        {
            $autoloader = new Autoloader( 'lib/' );
            $autoloader->load();
            
            $autoloader->extract_class( $class_name );
        }
    );
?>