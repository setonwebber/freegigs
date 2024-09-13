<link rel="stylesheet" type="text/css" href="stylesheet.css" />

<?php
  include('db_connect.php');

  if(isset($_SESSION['mbnumber'])){
    header('Location: index.php');
  }

  if (isset($_POST['submit'])){
    $stmt = $db->prepare("SELECT * FROM admin WHERE username=? AND pword = ?");
    $stmt->execute([$_POST['uname'], $_POST['pword']]);
    $user = $stmt->fetch();

    if($user){
        $_SESSION['admin'] = 1;
        header('Location: manage_bands.php');
        exit;
    }else{
        echo "<script>alert('Invalid Credentials. Try Again.');</script>"; 
        header('Location: index.php');
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Login</title>
    <script>
        function validateForm(){
            var form = document.login;

            // Test if user name is empty
            if (form.uname.value == '') {
                alert('Please enter a username.');
                return false;
            }

            // Tests if password is empty
            if (form.pword.value == '') {
                alert('Please enter a password.');
                return false;
            } 
        }
    </script>
  </head>

  <body>
    <form name="login" method="post" action="admin_login.php" onsubmit="return validateForm()">

        <div style="padding: 10px; width: 200px; vertical-align:top">
          
          <label><span>User Name: </span><input type="text" name="uname"/></label>

          <label><span>Password: </span><input type="password" name="pword" /></label>

          </br>

          <input type="submit" name="submit" value="Log in" class="middle" />
          
          <p><a href="index.php">Back</a></p>
        </div>
    </form>
  </body>
</html>