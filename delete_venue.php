<?php
include("db_connect.php");

    if (!isset($_SESSION['admin']))
    {
        header('Location: index.php');
        exit;
    }

    if (!isset($_GET['id']) || !ctype_digit($_GET['id'])){
        echo 'Invalid thread ID.';
        header('Location: manage_venues.php');
        exit;
    }

    $stmt = $db ->prepare("DELETE FROM venues WHERE venue_id = ?");
    $venue = $stmt->execute([$_GET['id']]);

    if($venue){
        echo '<p>Thread deleted! </p>';
        header('location: manage_venues.php');
    }else{
        echo '<p>Something went wrong.</p>';
        header('location: edit_venue.php?id='.$_GET['id']);
    }
?>