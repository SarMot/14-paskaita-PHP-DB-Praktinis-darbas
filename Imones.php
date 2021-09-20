<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imones</title>

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
    echo "<form action='Imones.php' method ='get'>";
    echo "<button class='btn btn-primary' type='submit' name='logout'>Logout</button>";
    echo "</form>";
    if(isset($_GET["logout"])) {
        setcookie("prisijungta", "", time() - 3600, "/");
        header("Location: index.php");
    }
}    
?>

<?php 

if(isset($_GET["ID"])) {
    $id = $_GET["ID"];
    $sql = "DELETE FROM `imones` WHERE ID = $id";
    if(mysqli_query($conn, $sql)) {
        $message = "Klientas sekmingai istrintas";
        $class="success";
    } else {
        $message = "Kazkas ivyko negerai";
        $class="danger";
    }
}

?>
<?php if(isset($message)) { ?>
    <div class="alert alert-<?php echo $class; ?>" role="alert">
        <?php echo $message; ?>
    </div>
<?php } ?>

<?php if(isset($_GET["search"]) && !empty($_GET["search"])) { ?>
    <a class="btn btn-primary" href="Imones.php"> Išvalyti paiešką</a>
<?php } ?>

<form action="Imones.php" method="get">

<div class="form-group">
    <select class="form-control" name="rikiavimas_id">
        <option value="DESC"> Nuo didžiausio iki mažiausio</option>
        <option value="ASC"> Nuo mažiausio iki didžiausio</option>
    </select>
    <button class="btn btn-primary" name="rikiuoti" type="submit">Rikiuoti</button>
</div>

</form>     


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Pavadinimas</th>
      <th scope="col">Teisinis statusas</th>
      <th scope="col">Veiksmai</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    
    if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"])) {
        $rikiavimas = $_GET["rikiavimas_id"];
    } else {
        $rikiavimas = "DESC";
    }

    $sql = "SELECT imones.ID, imones.pavadinimas,  imones_tipas.aprasymas
    FROM `imones` 
    LEFT JOIN imones_tipas ON imones_tipas.tipas_id = imones.tipas_ID
    WHERE 1 
    ORDER BY imones.ID $rikiavimas";

    
    if(isset($_GET["search"]) && !empty($_GET["search"])) {
        $search = $_GET["search"];
        $sql = "SELECT imones.ID, imones.pavadinimas, imones.tipas_ID, imones_tipas.aprasymas
        FROM `imones` 
        LEFT JOIN imones_tipas ON imones_tipas.aprasymas = imones.tipas_ID
        WHERE  imones.pavadinimas LIKE '%".$search."%' OR imones_tipas.aprasymmas LIKE '%".$search."%'  
        ORDER BY imones.ID $rikiavimas";
    
    }

    $result = $conn->query($sql); 

    while($companys = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>". $companys["ID"]."</td>";
            echo "<td>". $companys["pavadinimas"]."</td>";
            echo "<td>". $companys["aprasymas"]."</td>";
           
               
            
            echo "<td>";
                echo "<a href='Imones.php?ID=".$companys["ID"]."'>Trinti</a><br>";
                echo "<a href='klientuRedagavimas.php?ID=".$companys["ID"]."'>Redaguoti</a>";
            echo "</td>";
        echo "</tr>";
    }
    
    ?>
  </tbody>
</table>
    </div>
</body>
</html>