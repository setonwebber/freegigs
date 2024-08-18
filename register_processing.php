<link rel="stylesheet" type="text/css" href="stylesheet.css" />


<?php
    if (isset($_POSt['submit']))
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
    <title>Registration Form</title>
    <meta name="author" content="Seton Webber" />
    <meta name="description" content="Registration Form." />
    <script>
        function validateForm(){
            var form = document.register;

            if (form.mbnumber.value == '') {
                alert('Please enter a phone number.');
                return false;
            }

            if (form.pword.value == '') {
                alert('Password is empty.');
                return false;
            }

            // Tests if the password and password confirmation fields do not match
            if (form.pword.value != form.pword_conf.value) {
                alert('Password does not match confirmation.');
                return false;
            }

            if (form.uname.value == '') {
                alert('Username is empty.');
                return false;
            }

            if (form.uname.value == '') {
                alert('Username is empty.');
                return false;
            }

            if (form.uname.value == '') {
                alert('Username is empty.');
                return false;
            }

            if (form.uname.value == '') {
                alert('Username is empty.');
                return false;
            }

            // Tests if the "I agree" checkbox is unchecked
            if (!form.agree.checked) {
                alert('You must agree to the terms and conditions.');
                return false;
            }
        }
    </script>
  </head>

  <body>
    <h3>Account Registration</h3>
    <form name="register" method="post" action="login_form.php">

      <fieldset><legend>Login Details</legend>
  
        <label><span>Mobile Number<sup>*</sup>:</span><input type="tel" name="mbnumber"/></label>

        <label><span>Password<sup>*</sup>:</span><input type="password" name="pword" /></label>

        <label><span>Confirm Password<sup>*</sup>:</span><input type="password" name="pword_conf" /></label>
  
      </fieldset>
  
      <fieldset><legend>Personal Details</legend>
  
        <label><span>First Name<sup>*</sup>:</span><input type="text" name="fname" autofocus /></label>

        <label><span>Last Name<sup>*</sup>:</span><input type="text" name="lname" autofocus /></label>

        <label><span>Date of Birth<sup>*</sup>:</span><input type="date" name="dob" autofocus /></label>

        <br />

        <label class="middle"><input type="checkbox" name="agree" /> I agree to all terms and conditions.</label>

        <input type="submit" name="submit" value="Submit" class="middle" />
      </fieldset>
    </form>
    <p><a href="index.php">Back</a></p>
  </body>
</html>