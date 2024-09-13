<link rel="stylesheet" type="text/css" href="stylesheet.css" />

<?php
    include("db_connect.php");

    if(isset($_SESSION['mbnumber'])){
        header('Location: attendee.php');
    } elseif (isset($_SESSION['admin'])) {
        header('Location: manage_bands.php');
    }
?>

<html>
    <head>
        <title>Free-Gigs</title>
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
            <table width="1000">
                <td style="padding: 10px; width: 300px; vertical-align:top">
                    <div>
                        <p><small>You cannot book ticket unless you are logged in.</small></p>
                        <form name='login' method='post' action='login.php' onsubmit='return validateForm()'>
                            <label><span>Mobile Number:</span><input type='tel' name='mbnumber'/></label>

                            <label><span>Password:</span><input type='password' name='pword' /></label>
                            
                            </br>

                            <input type='submit' name='submit' value='Log in' class='middle' />

                            <p> Dont have an account? <a href='registration_form.php'>Click here to register.</a></p>

                            <p><a href='admin_login.php'>Admin login.</a></p>
                        </form>
                    </div>
                </td>
                <td>
                    <div>
                        <body>
                            <h3>Upcoming Concerts</h3>
                            <?php 
                                $stmt = $db->prepare(
                                    "SELECT concert_id, b.band_id, v.venue_id, band_name, venue_name, DATE_FORMAT(concert_date, '%Y-%m-%d %l:%i%p') as concert_date
                                    FROM concerts as c
                                    JOIN bands as b ON c.band_id = b.band_id
                                    JOIN venues as v ON c.venue_id = v.venue_id 
                                    ORDER BY concert_date");
                                $stmt->execute();
                                $concerts = $stmt->fetchAll();

                                if($concerts){
                                    echo "<ul style='line-height:180%'>";
                                    foreach($concerts as $concert){
                                        echo "<li>".$concert['concert_date'].", <b>".$concert['band_name']."</b> playing at <i>".$concert['venue_name']."</i>";
                                    }
                                    echo "</ul>";
                                }else{
                                    echo "<p>No upcoming concerts.</p>";
                                }
                                
                            ?>
                        </body>
                    </div>
                </td>
            </table>
        </fieldset>
    </body>
</html>