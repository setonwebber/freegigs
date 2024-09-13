<?php
    include('db_connect.php');

    // check if the user is an admin, if so, redirect to manage_bands
    if(isset($_SESSION['admin'])){
        header('Location: manage_bands.php');
    } 
    // check if the user has a mobile number session, if not, redirect to index
    elseif (!isset($_SESSION['mbnumber'])) {
        header('Location: index.php');
    }

    // check if 'id' parameter is set and is a valid digit
    if (!isset($_GET['id']) || !ctype_digit($_GET['id'])){
        echo 'invalid concert id.'; // output error message if invalid id
        header('Location: attendee.php');
        exit;
    }

    // check if the form is submitted
    if (isset($_POST['submit'])){
        // insert a new booking using the mobile number and concert id
        $stmt = $db->prepare("INSERT INTO bookings (mobile_num, concert_id) VALUES (?, ?);");
        $stmt->execute([$_SESSION['mbnumber'], $_GET['id']]);
        $booking = $stmt->fetch(); // fetch the result of the insert operation

        // check if booking is successful, then redirect to the attendee page
        if($booking){
            header('Location: attendee.php');
            exit;
        }else{
            // if booking fails, show an error alert and redirect to attendee page
            echo "<script>alert('unable to add band, try again.');</script>"; 
            header('Location: attendee.php');
        }
    }
?>
