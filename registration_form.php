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
    <title>Registration Form</title>
    <meta name="author" content="Seton Webber" />
    <meta name="description" content="Registration Form." />
    <script>
        function validateForm(){
            var form = document.register;

            // Test if mobile number is empty
            if (form.mbnumber.value == '') {
                alert('Please enter a phone number.');
                return false;
            }

            // Test if mobile number is valid (contains only digits and is 10 digits in length)
            if (!form.mbnumber.value.match(/\d/g) || form.mbnumber.value.length != 10) {
                alert('Please enter a valid phone number.');
                return false;
            }

            // Tests if password is empty
            if (form.pword.value == '') {
                alert('Please enter a password.');
                return false;
            }

            // Tests if the password and password confirmation fields do not match
            if (form.pword.value != form.pword_conf.value) {
                alert('Password does not match confirmation.');
                return false;
            }

            // Tests if first name is empty
            if (form.fname.value == '') {
                alert('Username is empty.');
                return false;
            }

            // Tests if last name is empty
            if (form.lname.value == '') {
                alert('Username is empty.');
                return false;
            }

            // Tests if date of birth is empty
            if (form.dob.value == '') {
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
    <form name="register" method="post" action="register_processing.php" onsubmit="return validateForm()">
        <fieldset><legend>Account Registration</legend>
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
            
            <p><a href="index.php">Back</a></p>
        </fieldset>
        </form>
  </body>
</html>