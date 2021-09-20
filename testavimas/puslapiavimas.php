<?php require_once("../connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puslapiavimas</title>
    <?php require_once("../includes.php"); ?>
</head>
<body>
    <div class="container">
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Vardas</th>
        <th scope="col">Pavardė</th>
        <th scope="col">Teisės</th>
        </tr>
    </thead>
    <tbody>
        <?php 

        if(isset($_GET["page-limit"])) {
            $page_limit = $_GET["page-limit"] * 30 - 30;    
        } else {
            $page_limit = 0;    
        }

        $sql = "SELECT * FROM 
        klientai
        ORDER BY klientai.ID ASC
        LIMIT $page_limit , 30
        ";

        $result = $conn->query($sql); 
        while($clients = mysqli_fetch_array($result)) {
            echo "<tr>";
                echo "<td>". $clients["ID"]."</td>";
                echo "<td>". $clients["Vardas"]."</td>";
                echo "<td>". $clients["Pavarde"]."</td>";
                echo "<td>". $clients["Teises_id"]."</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

    <?php        
        $sql = "SELECT CEILING(COUNT(ID)/30), COUNT(ID) FROM klientai";
        $result = $conn->query($sql);  
        
        if($result->num_rows == 1) { 
            $clients_total_pages = mysqli_fetch_array($result);
            
            
            for($i = 1; $i <= intval($clients_total_pages[0]); $i++) {
              
                echo "<a href='puslapiavimas.php?page-limit=$i'>";
                    echo $i; 
                    echo " ";
                echo "</a>";
            }            
            echo "<p>";
            echo "Is viso puslapiu: ";
            echo $clients_total_pages[0];
            echo "</p>";

            echo "<p>";
            echo "Is viso klientu: ";
             echo $clients_total_pages[1];
            echo "</p>";
        }
        else {
            echo "Nepavyko suskaiciuoti klientu";
        }
    ?>

</div>
</body>
</html>