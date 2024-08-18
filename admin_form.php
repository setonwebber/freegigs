<link rel="stylesheet" type="text/css" href="stylesheet.css" />

<?php
    if (isset($_POST['submit']))
    {
    echo '<h3>Form submitted successfully!</strong></h3>';

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login Form</title>
    <meta name="author" content="Seton Webber" />
    <meta name="description" content="Registration Form." />
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
    <form name="login" method="post" action="admin_processing.php" onsubmit="return validateForm()">

      <fieldset><legend>Login</legend>
  
        <label><span>User Name<sup></sup>:</span><input type="tel" name="uname"/></label>

        <label><span>Password<sup></sup>:</span><input type="password" name="pword" /></label>

        <input type="submit" name="submit" value="Log in" class="middle" />
        
        </br>

        <p><a href="index.php">Back</a></p>
      </fieldset>
    </form>
  </body>
</html>