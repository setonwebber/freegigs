<?php
    include('db_connect.php');

    // check if a user isnt an admin and send them to the index page
    if (!isset($_SESSION['admin']))
    {
        header('Location: index.php');
    }

    // this runs if the form is submitted from manage_bands
    if (isset($_POST['submit'])){
        // this is server-side validation for add_band
        $errors = [];

        // get the database for the checking band name already exists validation
        $stmt = $db->prepare("SELECT band_name FROM bands");
        $stmt->execute();
        $bands = $stmt->fetchAll();

        // check if band name is empty
        if ($_POST['band_name'] == ""){
            $errors[] = 'Band name is empty.';
        }

        // check if band name is too long (VARCHAR(35))
        if (strlen($_POST['band_name']) > 35){
            $errors[] = 'Band name is too long (more than 35 characters).';
        }

        // check if band name already exists in database.
        if (in_array($_POST['band_name'], $bands)){
            $errors[] = 'Band name already in database.';
        }

        // if any errors are returned
        if ($errors)
        { // Display all error messages and link back to form
            foreach ($errors as $error)
            {
            echo '<p>'.$error.'</p>';
            }
        
            echo '<a href="javascript: window.history.back()">Return to form</a>';
        }else{
            // insert values into databse
            $stmt = $db->prepare("INSERT INTO bands (band_name) VALUES (?);");
            $stmt->execute([$_POST['band_name']]);
            $band = $stmt->fetch();
            
            if($band){
                // if success redirect to manage_bands
                header('Location: manage_bands.php');
                exit;
            }else{
                // if fail somehow, redirect to manage_bands with error alert.
                echo "<script>alert('Unable to add band, try again.');</script>"; 
                header('Location: manage_bands.php');
            }
        }
    }
?>