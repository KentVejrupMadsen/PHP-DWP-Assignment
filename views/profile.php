<?php
    /**
     *  Title: Profile
     *  Author: Kent vejrup Madsen
     *  Type: PHP Script, view
     *  Project: DWP-Assignment
     */

    PageTitleController::getSingletonController()->append( ' - Profile' );
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo encodingStandardHTML(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        
        <?php
            PageTitleView::getSingletonView()->printHTML();
        ?>
    </head>
    <body>
        <?php getHeader(); ?>
        
        <main> 
            <h4> Welcome, <?php echo $_SESSION[ 'user_session_object_username' ]; ?> </h4>
            
            <div> 
                <h2>
                    My Profile
                </h2>

            </div>
        </main>

        <?php getFooter(); ?>
    </body>
</html>