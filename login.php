<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<?php
    include("db_connect.php");

    if(isset($_SESSION['mbnumber'])){
        header('Location: index.php');
    }

    if (isset($_POST['submit'])){
        $stmt = $db->prepare("SELECT * FROM attendees WHERE mobile_num=? AND password = ?");
        $stmt->execute([$_POST['mbnumber'], $_POST['pword']]);
        $user = $stmt->fetch();

        
        if($user){
            $_SESSION['mbnumber'] = $user['mobile_num'];
            header('Location: attendee.php');
            exit;
        }else{
            echo "<script>alert('Invalid Credentials. Try Again.');</script>"; 
            header('Location: index.php');
        }
    }
?>
