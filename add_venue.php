<?php
    include('db_connect.php');

    if (!isset($_SESSION['admin']))
    {
        header('Location: index.php');
    }

    if (isset($_POST['submit'])){
        $errors = [];

        $stmt = $db->prepare("SELECT venue_name FROM venues");
        $stmt->execute();
        $venues = $stmt->fetchAll();

        if ($_POST['venue_name'] == ""){
            $errors[] = 'Venue name is empty.';
        }

        if (strlen($_POST['venue_name']) > 50){
            $errors[] = 'Venue name is too long (more than 50 characters).';
        }

        if (in_array($_POST['venue_name'], $venues)){
            $errors[] = 'Venue name already in database.';
        }

        if ($errors)
        { // Display all error messages and link back to form
            foreach ($errors as $error)
            {
            echo '<p>'.$error.'</p>';
            }
        
            echo '<a href="javascript: window.history.back()">Return to form</a>';
        }else{
            $stmt = $db->prepare("INSERT INTO venues (venue_name) VALUES (?);");
            $stmt->execute([$_POST['venue_name']]);
            $venue = $stmt->fetch();
    
            if($venue){
                header('Location: manage_venues.php');
                exit;
            }else{
                echo "<script>alert('Unable to add venue, try again.');</script>"; 
                header('Location: manage_venues.php');
            }
        }
    }
?>