<?php 
    /**
     *  title:
     *  Author:
     *  Type: PHP Script
     */
    
    PageTitleController::getSingletonController()->append( ' - 404 Page' );
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="/assets/css/style.css">
        
        <?php
            PageTitleView::getSingletonView()->PrintHTML();
        ?>
    </head>
    <body>
        <?php get_header(); ?>
        
        <main> 
            <h2> 404 </h2>
            <p> Sorry, Page not found </p>
        </main>

        <?php get_footer(); ?>
    </body>
</html>