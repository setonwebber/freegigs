<link rel="stylesheet" type="text/css" href="stylesheet.css" />

<?php
    include("db_connect.php");

    if (!isset($_SESSION['admin']))
    {
        header('Location: index.php');
    }
?>

<html>
    <head>
        <title>Manage Bands</title>
        <script>
            function validateForm() {
                var form = document.addband;

                if (form.band_name.value.length = 0){
                    alert('Must enter a band name.');
                    return false;
                }

                if (form.band_name.value.length > 35){
                    alert('Band name is too long, please enter one less than 35 characters.')
                    return false;
                }

                <?php $stmt = $db->prepare("SELECT band_name FROM bands");
                $stmt->execute();
                $bands = $stmt->fetchAll();?>

                bands = [ <?php foreach($bands as $band){echo "'".$band['band_name']."' ,";};?> ]

                if (bands.includes(form.band_name.value)) {
                    alert('Band already exists in database.')
                    return false;}
                
                return true;
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
                        <p><b>Manage Bands</b></p>
                        <p><a href="manage_venues.php">Manage Venues</a></p>
                        <p><a href="add_concert.php">Add Concert</a></p>
                        <p><a href="logout.php">Log Out</a></p>
                    </div>
                </td>
                <td style="padding: 10px; vertical-align:top">
                    <div>
                        <body>
                            <div>
                                <h3>Current Bands:</h3>
                                <?php 
                                    $stmt = $db->prepare("SELECT * FROM bands");
                                    $stmt->execute();
                                    $bands = $stmt->fetchAll();

                                    if($bands){
                                        echo "<ul style='line-height:180%'>";
                                        foreach($bands as $band){
                                            echo "<li>".$band['band_name']." - 
                                                    <a href='edit_band.php?id=".$band['band_id']."'>Edit</a> - 
                                                    <a onclick='return confirm(\"Are you sure you want to delete this band?\")' href='delete_band.php?id=".$band['band_id']."'>Delete</a></li>";
                                            
                                        }
                                        echo "</ul>";
                                    }else{
                                        echo "<p>No bands in database.</p>";
                                    }
                                    
                                ?>
                            </div>
                            <hr>
                            <div>
                                <h3>Add New Band:</h3>
                                    <form name="addband" method="post" action="add_band.php" onsubmit="return validateForm()">

                                        <div style="padding: 10px; width: 500px; vertical-align:top">

                                            <label><span>Name: </span><input type="text" name="band_name"/></label>
                                            <input type="submit" name="submit" value="Add band"/>
                                        </div>
                                    </form>
                            </div>
                        </body>
                    </div>
                </td>
            </table>
        </fieldset>
    </body>
</html>