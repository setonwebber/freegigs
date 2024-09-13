<link rel="stylesheet" type="text/css" href="stylesheet.css" />

<?php
    include("db_connect.php");

    if (!isset($_SESSION['admin']))
    {
        header('Location: index.php');
    }

    if (isset($_POST['submit'])){
        $stmt = $db->prepare("INSERT INTO concerts (band_id, venue_id, concert_date) VALUES (?, ?, ?);");
        $stmt->execute([$_POST['band_id'], $_POST['venue_id'], $_POST['date']]);
        $venue = $stmt->fetch();

        if($venue){
            echo "<script>alert('Added concert ".$_POST['band_id']."');</script>"; 
            header('Location: add_concert.php');
            exit;
        }else{
            echo "<script>alert('Unable to add venue, try again.');</script>"; 
            header('Location: add_concert.php');
        }
    }
?>

<html>
    <head>
        <title>Add Concert</title>
        <script>
            function validateForm() {
            
            // Create a variable to refer to the form
            var form = document.add_concert;
            }
        </script>
    </head>
    <body>
        <fieldset><legend>Welcome to Free-Gigs, the Free Concert Website</legend>
            <table width="1000">
                <td style="padding: 10px; width: 150px; vertical-align:top">
                    <div style="text-align: center;">
                        <p><i>Admin Area</i></p>
                        <br>
                        <p><a href="manage_bands.php">Manage Bands</a></p>
                        <p><a href="manage_venues.php">Manage Venues</a></p>
                        <p><b>Add Concert</b></p>
                        <p><a href="logout.php">Log Out</a></p>
                    </div>
                </td>
                <td style="padding: 10px; vertical-align:top">
                    <div>
                        <body>
                            <h3>Add Concert:</h3>

                            <form name="add_concert" method="post" action="add_concert.php" onsubmit="return validateForm()">
                                <div style="vertical-align:top">
                                    <label><p>Band:
                                        <select name="band_id" style="width: 295px;">
                                            <option value="" selected disabled>Select a band.</option>
                                            <?php  
                                                $bands = $db->query("SELECT * FROM bands ORDER BY band_id");
                                        
                                                foreach($bands as $band)
                                                {
                                                echo '<option value="'.$band['band_id'].'">'.$band['band_name'].'</option>';
                                                }
                                            ?></p>
                                    </select></label>
                                    <label><p>Venue:
                                        <select name="venue_id" style="width: 295px;">
                                            <option value="" selected disabled>Select a venue.</option>
                                            <?php  
                                                $venues = $db->query("SELECT * FROM venues ORDER BY venue_id");
                                        
                                                foreach($venues as $venue)
                                                {
                                                echo '<option value="'.$venue['venue_id'].'">'.$venue['venue_name'].'</option>';
                                                }
                                            ?></p>
                                    </select></label>

                                    <label><p>Date: <input type="datetime-local" name="date"/></p></label>

                                    <p><input type="submit" name="submit" value="Add concert"/></p>
                                </div>
                            </form>
                        </body>
                    </div>
                    <hr>
                    <div>
                        <body>
                            <h3>All Concerts</h3>
                            <?php 
                                $stmt = $db->prepare(
                                    "SELECT concert_id, b.band_id, v.venue_id, band_name, venue_name, DATE_FORMAT(concert_date, '%Y-%m-%d %l:%i%p') as concert_date
                                    FROM concerts as c
                                    JOIN bands as b ON c.band_id = b.band_id
                                    JOIN venues as v ON c.venue_id = v.venue_id 
                                    ORDER BY band_name, concert_date");
                                $stmt->execute();
                                $concerts = $stmt->fetchAll();

                                if($concerts){
                                    echo "<table style='width:100%'>";
                                    echo "
                                    <tr>
                                        <th>Band</th>
                                        <th>Venue</th>
                                        <th>Date</th>
                                    </tr>";
                                    foreach($concerts as $concert){
                                        echo "
                                        <tr>
                                            <td>".$concert['band_name']."</td>
                                            <td>".$concert['venue_name']."</td>
                                            <td>".$concert['concert_date']."</td>
                                        </tr>";
                                    }
                                    echo "</table>";
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