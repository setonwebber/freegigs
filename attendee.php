<link rel="stylesheet" type="text/css" href="stylesheet.css" />

<?php
    include("db_connect.php");

    if(isset($_SESSION['admin'])){
        header('Location: manage_bands.php');
    } elseif (!isset($_SESSION['mbnumber'])) {
        header('Location: index.php');
    }

    $stmt = $db->prepare("SELECT * FROM attendees WHERE mobile_num = ?");
    $stmt->execute([$_SESSION['mbnumber']]);
    $user = $stmt->fetch();
?>

<html>
    <head>
        <title>Free-Gigs</title>
    </head>
    <body>
        <fieldset><legend>Welcome to Free-Gigs, the Free Concert Website</legend>
            <table width="1000">
                <td style="padding: 10px; width: 200px; vertical-align:top">
                    <div class="middle">
                        <p>You are logged in as <?php echo $user['first_name']." ".$user['surname'] ?></p>
                        <br>
                        <p><a href="logout.php">Log Out</a></p>
                    </div>
                </td>
                <td>
                    <?php
                        $stmt = $db->prepare(
                            "SELECT concert_id, b.band_id, v.venue_id, band_name, venue_name, DATE_FORMAT(concert_date, '%Y-%m-%d %l:%i%p') as concert_date
                            FROM concerts as c
                            JOIN bands as b ON c.band_id = b.band_id
                            JOIN venues as v ON c.venue_id = v.venue_id 
                            ORDER BY concert_date");
                        $stmt->execute();
                        $concerts = $stmt->fetchAll();
                    ?>
                    <div>
                        <h3>Upcoming Concerts</h3>
                        <?php 
                            if($concerts){
                                echo "<ul style='line-height:180%'>";
                                foreach($concerts as $concert){
                                    $stmt = $db->prepare("SELECT * FROM bookings WHERE mobile_num = ? AND concert_id = ?");
                                    $stmt->execute([$_SESSION['mbnumber'], $concert['concert_id']]);
                                    $booking = $stmt->fetch();

                                    if($booking){
                                        echo "<li>".$concert['concert_date'].", <b>"
                                        .$concert['band_name']."</b> playing at <i>"
                                        .$concert['venue_name']."</i>";
                                    }else{
                                        echo "<li>".$concert['concert_date'].", <b>"
                                        .$concert['band_name']."</b> playing at <i>"
                                        .$concert['venue_name'].
                                        " - <a href='add_booking.php?id=".$concert['concert_id']."'>Book</i><a>";
                                    }
                                    
                                }
                                echo "</ul>";
                            }else{
                                echo "<p>No upcoming concerts.</p>";
                            }
                        ?>
                    </div>
                    <hr>
                    <div>
                        <h3>Your Bookings</h3>
                        <?php 
                            if($db->prepare("SELECT COUNT(*) FROM bookings WHERE mobile_num = ?")->execute([$_SESSION['mbnumber']]) > 0){
                                echo "<ul style='line-height:180%'>";
                                foreach($concerts as $concert){
                                    $stmt = $db->prepare("SELECT * FROM bookings WHERE mobile_num = ? AND concert_id = ?");
                                    $stmt->execute([$_SESSION['mbnumber'], $concert['concert_id']]);
                                    $booking = $stmt->fetch();

                                    if($booking){
                                        echo "<li>".$concert['concert_date'].", <b>"
                                        .$concert['band_name']."</b> playing at <i>"
                                        .$concert['venue_name'].
                                        " - <a href='delete_booking.php?id=".$concert['concert_id']."'>Cancel</i><a>";
                                    }
                                }
                                echo "</ul>";
                            }else{
                                echo "<p>No upcoming bookings.</p>";
                            }
                        ?>
                    </div>
                </td>
            </table>
        </fieldset>
    </body>
</html>