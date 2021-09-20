<?php 
    require_once("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</style>
</head>
<body>
    <?php
    
    if(isset($_GET["submit"])) {
            if(isset($_GET["username"]) && isset($_GET["password"]) && !empty($_GET["username"]) && !empty($_GET["password"])) {
                $username = $_GET["username"];
                $password = $_GET["password"];

                $sql = "SELECT * FROM `uzsiregistrave_vartotojai` WHERE slapyvardis='$username' AND slaptazodis='$password'"; 

                $result = $conn->query($sql);

                if($result->num_rows == 1) {

                    $user_info = mysqli_fetch_array($result);
                    
                    $cookie_array = array(
                        $user_info["ID"],
                        $user_info["slapyvardis"],
                        $user_info["Vardas"],
                        $user_info["teises_id"]
                    );

                    $cookie_array = implode("|", $cookie_array);
                    setcookie("prisijungta", $cookie_array, time() + 3600, "/");

                    header("Location: Klientai.php");
                } else {
                    $message = "Neteisingi prisijungimo duomenys";
                }
               
            } else {
                $message = "Laukeliai yra tušti arba duomenys yra neteisingi";
            }
        }    

?>

<?php if(!isset($_COOKIE["prisijungta"])) { ?>
    <div class="container">
        <h1>Klientų valdymo sistema</h1>
        <form action="index.php" method="get">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" />
            </div>
            <a href="klientupildymoforma.php">Klientu pildymo forma</><br>
            <button class="btn btn-primary" type="submit" name="submit">Log In</button>
        </form>

        <?php if(isset($message)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $message; ?>
            </div>
        <?php } ?>
    </div>
    <?php } else {
        header("Location: Klientai.php");
    } ?>

    
</body>
</html>