<?php
include("db_connect.php");

    if (!isset($_SESSION['admin']))
    {
        header('Location: index.php');
        exit;
    }

    if (!isset($_GET['id']) || !ctype_digit($_GET['id'])){
        echo 'Invalid band ID.';
        header('Location: manage_bands.php');
        exit;
    }

    $stmt = $db ->prepare("DELETE FROM bands WHERE band_id = ?");
    $band = $stmt->execute([$_GET['id']]);

    if($band){
        echo '<p>band deleted! </p>';
        header('location: manage_bands.php');
    }else{
        echo '<p>Something went wrong.</p>';
        header('location: edit_band.php?id='.$_GET['id']);
    }
?>