<?php
include("db_connect.php");

    if(isset($_SESSION['admin'])){
        header('Location: manage_bands.php');
    } elseif (!isset($_SESSION['mbnumber'])) {
        header('Location: index.php');
    }

    if (!isset($_GET['id']) || !ctype_digit($_GET['id'])){
        echo 'Invalid concert ID.';
        header('Location: attendee.php');
        exit;
    }

    $stmt = $db ->prepare("DELETE FROM bookings WHERE mobile_num = ? AND concert_id = ?");
    $booking = $stmt->execute([$_SESSION['mbnumber'], $_GET['id']]);

    if($booking){
        echo '<p>Booking deleted! </p>';
        header('location: attendee.php');
    }else{
        echo '<p>Something went wrong.</p>';
        header('location: attendee.php');
    }
?>