<link rel="stylesheet" type="text/css" href="stylesheet.css" />

<?php
    include('db_connect.php');

    if (!isset($_SESSION['admin']))
    {
        header('Location: index.php');
    }


    if (isset($_POST['submit'])){
        $errors = [];
  
        if (trim($_POST['band_name']) == '')
        {
            $errors[] = 'Band name not specified.';
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

            $stmt = $db->prepare("UPDATE bands SET band_name = ? WHERE band_id = ?");
            $band = $stmt->execute([$_POST['band_name'], $_POST['band_id']]);

            if($band){
                header('Location: manage_bands.php');
                exit;
            }else{
                echo "<script>alert('Unable to edit band, try again.');</script>"; 
                header('Location: edit_band.php?id='.$_POST['band_id']);
            }
        }
    }else{
        $stmt = $db->prepare("SELECT * FROM bands WHERE band_id = ?");
        $stmt->execute([$_GET['id']]);
        $band = $stmt->fetch();
    }
?>

<html>
    <head>
    <title><?php echo $band['band_name'];?></title>
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
                    <h4>Editing <?php echo $band['band_name'];?>:</h4>
                    <hr>
                    <form name="editband" method="post" action="edit_band.php" onsubmit="return validateForm()">
                        <div style="vertical-align:top">
                            <label><input type="hidden" name="band_id" value=<?php echo $_GET['id'];?>></label>
                            <label><span>Band name: </span><input type="text" name="band_name" value="<?php echo $band['band_name'];?>"/></label>
                            <input type="submit" name="submit" value="Apply changes"/>
                        </div>
                    </form>
                    <small><a href="manage_bands.php">Back</a></small>
                </div>
                </td>
            </table>
        </fieldset>
    </body>
</html>
