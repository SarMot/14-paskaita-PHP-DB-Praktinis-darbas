<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vartotojai</title>

    <?php require_once("includes.php"); ?>

</head>
<body>
    <div class="container">
      <?php require_once("includes/menu.php"); ?>
<?php 

if(!isset($_COOKIE["prisijungta"])) { 
    header("Location: index.php");    
} else {
    echo "Sveikas prisijunges";
    echo "<form action='vartotojai.php' method ='get'>";
    echo "<button class='btn btn-primary' type='submit' name='logout'>Logout</button>";
    echo "</form>";
    if(isset($_GET["logout"])) {
        setcookie("prisijungta", "", time() - 3600, "/");
        header("Location: index.php");
    }
}    
?>
<?php if(isset($_GET["filtravimas_id"]) && !empty($_GET["filtravimas_id"]) && $_GET["filtravimas_id"] != "default") {?>
                <option value="default">Rodyti visus</option>
<?php } else {?>
                <option value="default" selected="true">Rodyti visus</option>
<?php } ?>    

                        <?php 
                         $sql = "SELECT * FROM uzsiregistrave_vartotojai";
                         $result = $conn->query($sql);

                         while($clientRights = mysqli_fetch_array($result)) {
                            if(isset($_GET["filtravimas_id"]) && $_GET["filtravimas_id"] == $clientRights["reiksme"] ) {
                                echo "<option value='".$clientRights["reiksme"]."' selected='true'>";
                            } else  {
                                echo "<option value='".$clientRights["reiksme"]."'>";
                            }
                                echo $clientRights["pavadinimas"];
                            echo "</option>";
                        }
                        ?>