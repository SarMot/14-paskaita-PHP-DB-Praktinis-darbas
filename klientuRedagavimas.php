<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klientu redagavimas</title>

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

if(isset($_GET["ID"])) {
    $id = $_GET["ID"];
    $sql = "SELECT * FROM klientai WHERE ID = $id";

    $result = $conn->query($sql);

    if($result->num_rows == 1) {
        $client = mysqli_fetch_array($result);
        $hideForm = false;
    
    } else {
        $hideForm = true;
    }
}

if(isset($_GET["submit"])) {
    
    if(isset($_GET["Vardas"]) && isset($_GET["Pavarde"]) && isset($_GET["Teises_id"]) && !empty($_GET["Vardas"]) && !empty($_GET["Pavarde"]) && !empty($_GET["Teises_id"])) {
        $id = $_GET["ID"];
        $vardas = $_GET["Vardas"];
        $pavarde = $_GET["Pavarde"];
        $teises_id = intval($_GET["Teises_id"]);

        $sql = "UPDATE `klientai` SET `Vardas`='$vardas',`Pavarde`='$pavarde',`Teises_id`=$teises_id WHERE ID = $id";

        if(mysqli_query($conn, $sql)) {
            $message =  "Vartotojas redaguotas sėkmingai";
            $class = "success";
        } else {
            $message =  "Kazkas ivyko negerai";
            $class = "danger";
        }
    } else {
        $id = $client["ID"];
        $vardas = $client["Vardas"];
        $pavarde = $client["Pavarde"];
        $teises_id = intval($client["Teises_id"]);

        $sql = "UPDATE `klientai` SET `Vardas`='$vardas',`Pavarde`='$pavarde',`Teises_id`=$teises_id WHERE ID = $id";
        if(mysqli_query($conn, $sql)) {
            $message =  "Vartotojas redaguotas sėkmingai";
            $class = "success";
        } else {
            $message =  "Kazkas ivyko negerai";
            $class = "danger";
        }
    }
}

?>

<div class="container">
        <h1>Kliento redagavimas</h1>
        <?php if($hideForm == false) { ?>
            <form action="klientuRedagavimas.php" method="get">
                
                <input class="hide" type="text" name="ID" value ="<?php echo $client["ID"]; ?>" />

                <div class="form-group">
                    <label for="vardas">Vardas</label>
                    <input class="form-control" type="text" name="vardas" value="<?php echo $client["Vardas"]; ?>" />
                </div>
                <div class="form-group">
                    <label for="pavarde">Pavardė</label>
                    <input class="form-control" type="text" name="pavarde" value="<?php echo $client["Pavarde"]; ?>"/>
                </div>
               
                <div class="form-group">
                    <label for="teises_id">Teisės</label>
                    <input class="form-control" type="text" name="teises_id" value="<?php echo $client["Teises_id"]; ?>"/>
                    <?php 
                    

                    ?>


                    <select class="form-control" name="teises_id">
                        <?php 
                         $sql = "SELECT * FROM klientai_teises";
                         $result = $conn->query($sql);
                            while($clientRights = mysqli_fetch_array($result)) {

                            if($client["teises_id"] == $clientRights["reiksme"] ) {
                                echo "<option value='".$clientRights["reiksme"]."' selected='true'>";
                            }  else {
                                echo "<option value='".$clientRights["reiksme"]."'>";
                            }  
                                
                                echo $clientRights["pavadinimas"];
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>

                <a href="Klientai.php">Grižti</a><br>
                <button class="btn btn-primary" type="submit" name="submit">Redaguoti</button>
            </form>
            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <h2> Tokio kliento nėra </h2>
            <a href="Klientai.php">Grižti</a>
        <?php }?>    
    </div>
</body>
</html>