<?php
session_start();
  try
  { 
    $db = new PDO('mysql:host=localhost;port=6033;dbname=freegigs', 'root', '');
	  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
  }
  catch (PDOException $e) 
  {
    echo 'Error connecting to database server:<br />';
    echo $e->getMessage();
    exit;
  } 
?>