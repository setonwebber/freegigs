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

<html>
    <head>
        <title>Free-Gigs</title>
        <meta name="author" content="Seton Webber" />
        <script>
        function validateForm(){
            var form = document.login;

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
        }
    </script>
    </head>
    <body>
        <fieldset><legend>Welcome to Free-Gigs, the Free Concert Website</legend>
            <table>
                <td>
                    <fieldset><legend>Login:</legend>
                        <form name="login" method="post" action="index.php" onsubmit="return validateForm()">
                            <label><span>Mobile Number<sup></sup>:</span><input type="tel" name="mbnumber"/></label>

                            <label><span>Password<sup></sup>:</span><input type="password" name="pword" /></label>

                            <input type="submit" name="submit" value="Log in" class="middle" />

                            </br>

                            <p> Don't have an account? <a href="registration_form.php">Click here to register.</a></p>

                            <p><a href="admin_form.php">Admin login.</a></p>
                        </form>
                    </fieldset>
                </td>
                <td>
                    <fieldset><legend>Upcoming Concerts:</legend>
                        <body>
                            - Example data
                        </body>
                    </fieldset>
                </td>
            </table>
        </fieldset>
    </body>
</html>