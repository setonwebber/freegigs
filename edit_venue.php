<link rel="stylesheet" type="text/css" href="stylesheet.css" />

<?php
    include('db_connect.php');

    if (!isset($_SESSION['admin']))
    {
        header('Location: index.php');
    }


    if (isset($_POST['submit'])){
        $errors = [];
  
        if (trim($_POST['venue_name']) == '')
        {
            $errors[] = 'venue name not specified.';
        }

        if ($errors)
        { 
            foreach ($errors as $error)
            {
            echo '<p>'.$error.'</p>';
            }
            
            echo '<a href="javascript: window.history.back()">Return to form</a>';
        }
        else
        { 

            $stmt = $db->prepare("UPDATE venues SET venue_name = ? WHERE venue_id = ?");
            $venue = $stmt->execute([$_POST['venue_name'], $_POST['venue_id']]);

            if($venue){
                header('Location: manage_venues.php');
                exit;
            }else{
                echo "<script>alert('Unable to edit venue, try again.');</script>"; 
                header('Location: edit_venue.php?id='.$_POST['venue_id']);
            }
        }
    }else{
        $stmt = $db->prepare("SELECT * FROM venues WHERE venue_id = ?");
        $stmt->execute([$_GET['id']]);
        $venue = $stmt->fetch();
    }
?>

<html>
    <head>
    <title><?php echo $venue['venue_name'];?></title>
    </head>
    <body>
        <fieldset><legend>Welcome to Free-Gigs, the Free Concert Website</legend>
            <table width="1000">
                <td style="padding: 10px; width: 150px; vertical-align:top">
                    <div style="text-align: center;">
                        <p><i>Admin Area</i></p>
                        <br>
                        <p><a href="manage_bands.php">Manage Bands</a></p>
                        <p><b>Manage Venues</b></p>
                        <p><a href="add_concert.php">Add Concert</a></p>
                        <p><a href="logout.php">Log Out</a></p>
                    </div>
                </td>
                <td style="padding: 10px; vertical-align:top">
                <div>
                    <h4>Editing <?php echo $venue['venue_name'];?>:</h4>
                    <hr>
                    <form name="editvenue" method="post" action="edit_venue.php" onsubmit="return validateForm()">
                        <div style="vertical-align:top">
                            <label><input type="hidden" name="venue_id" value=<?php echo $_GET['id'];?>></label>
                            <label><span>Venue name: </span><input type="text" name="venue_name" value="<?php echo $venue['venue_name'];?>"/></label>
                            <input type="submit" name="submit" value="Apply changes"/>
                        </div>
                    </form>
                    <small><a href="manage_venues.php">Back</a></small>
                </div>
                </td>
            </table>
        </fieldset>
    </body>
</html>
