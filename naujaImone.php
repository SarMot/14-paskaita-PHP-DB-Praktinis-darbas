<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nauja Imone</title>

    <?php require_once("includes.php"); ?>
    
    <style>
        h1 {
            text-align: center;
        }

        .container {
            position:absolute;
            top:50%;
            left:50%;
            transform: translateY(-50%) translateX(-50%);
        }

        .hide {
            display:none;
        }
    </style>

</head>
<body>
<?php 


if(!isset($_COOKIE["prisijungta"])) { 
    header("Location: index.php");    
}


if(isset($_GET["submit"])) {
    if(isset($_GET["Pavadinimas"]) && isset($_GET["tipas_id"]) && !empty($_GET["Pavadinimas"]) && !empty($_GET["tipas_id"])) {

        $Pavadinimas = $_GET["Pavadinimas"];
        $tipas_id = intval($_GET["tipas_id"]);
        
       
        $sql = "INSERT INTO `imones`(`tipas_ID`, `pavadinimas`) VALUES ('$tipas_id','$Pavadinimas')";
        if(mysqli_query($conn, $sql)) {
            $message =  "Vartotojas pridėtas sėkmingai";
            $class = "success";
        } else {
            $message =  "Kazkas ivyko negerai";
            $class = "danger";
        }
    } else {
        $message =  "Uzpildykite visus laukelius";
        $class = "danger";
    }
}

?>

<div class="container">
        <h1>Nauja Imone</h1>
            <form action="naujaImone.php" method="get">

                <div class="form-group">
                    <label for="Pavadinimas">Imones pavadinimas</label>
                    <input class="form-control" type="text" name="Pavadinimas" placeholder="Pavadinimas" />
                </div>
                
                <div class="form-group">
                    <label for="tipas_id">Teisinis statusas</label>
                    <select class="form-control" name="tipas_id">
                        <?php 
                         $sql = "SELECT * FROM imones_tipas";
                         $result = $conn->query($sql);
                        
                         while($clientRights = mysqli_fetch_array($result)) {
                            echo "<option value='".$clientRights["aprasymas"]."'>";
                                echo $clientRights["tipas_id"];
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>

                <a href="Imones.php">Grizti</a><br>
                <button class="btn btn-primary" type="submit" name="submit">Nauja Imone</button>
            </form>

            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
                </div>
            <?php } ?>
        
              
    </div>
</body>
</html>