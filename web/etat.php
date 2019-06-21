<?php

require_once "config.php";

$e1 = "";
$e2 = "";

$sql = "SELECT value FROM trame";

if ($res = mysqli_query($link, $sql)) { 
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) { 
            $trame = $row["value"];
        }
    }
}

if ($trame === "000000000") 
{
    $e1 = "#7F0000";
    $e2 = "#7F0000";
    $e3 = "#7F0000";
    $e4 = "#7F0000";
}

if ($trame === "110000000") 
{
    $e1 = "#32CD32";
    $e2 = "#7F0000";
    $e3 = "#7F0000";
    $e4 = "#7F0000";
}

if ($trame === "001100000") 
{
    $e1 = "#7F0000";
    $e2 = "#32CD32";
    $e3 = "#7F0000";
    $e4 = "#7F0000";
}

if ($trame === "000011000") 
{
    $e1 = "#7F0000";
    $e2 = "#7F0000";
    $e3 = "#32CD32";
    $e4 = "#7F0000";
}

if ($trame === "000000110") 
{
    $e1 = "#7F0000";
    $e2 = "#7F0000";
    $e3 = "#7F0000";
    $e4 = "#32CD32";
}

$etat = 0;
$class = "";

if($etat === 0)
{
    $class = "primary";
}
else if($etat === 1)
{
    $class = "danger";
}

if(array_key_exists('test',$_POST)){
    testfun();
 }

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Etat système</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link href="assets/css/material_icons.css" rel="stylesheet">

</head>

<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color: #9292bf;">
            <div class="container"><img src="assets/img/logo.png" style="width: 80px;height: 62px;"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item" role="presentation"></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="index.php" style="margin-left: 30px;">Accueil</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="planification.php">Planification</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="etat.php">Etat système</a></li>
                    </ul><span style = "text-align : center" class="navbar-text actions"><b class="m-4">Salut, <?php echo htmlspecialchars($_SESSION["username"]);?> !</b><a class="btn btn-danger action-button" style="background : red" role="button" href="logout.php">Deconnexion</a><?php if((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true) &&  $_SESSION["permissions"] === 1) {echo"<i id=\"settings\" onclick=\"settings()\" style = \" font-size : 25px; padding-left : 10px; vertical-align:middle;\" class=\"material-icons\">settings</i>";}?></span></div>
    </div>
    </nav>
    </div>
    <div>
        <div class="container" style="height : 1300px; text-align : center; @media screen and (max-width: 500px) {height : 1500px}">
        <h5 class="text-center" style="margin-top : 50px; margin-bottom : 50px">Etat des électrovannes : </h5>
        <div class="row">
    <div class="col-sm" style = "background-color : <?php echo $e1 ?>; height : 200px;">
      <div style=" position: absolute; top: 50%; transform: translateY(-50%); left: 50%; transform: translateX(-50%); color : #cccccc; font-weight : bold;">Electrovanne 1</div>
    </div>
    <div class="col-sm" style = "background-color : <?php echo $e2 ?>; height : 200px;">
    <div style=" position: absolute; top: 50%; transform: translateY(-50%); left: 50%; transform: translateX(-50%); color : #cccccc; font-weight : bold;">Electrovanne 2</div>
    </div>
    </div>
    <div class="row">
    <div class="col-sm" style = "background-color : <?php echo $e3 ?>; height : 200px;">
    <div style=" position: absolute; top: 50%; transform: translateY(-50%); left: 50%; transform: translateX(-50%); color : #cccccc; font-weight : bold;">Electrovanne 3</div>
    </div>
    <div class="col-sm" style = "background-color : <?php echo $e4 ?>; height : 200px;">
    <div style=" position: absolute; top: 50%; transform: translateY(-50%); left: 50%; transform: translateX(-50%); color : #cccccc; font-weight : bold;">Electrovanne 4</div>
    </div>
    </div>
    <h5 class="text-center" style="margin-top : 50px; margin-bottom : 50px">Arrêt du système : </h5>
    <h6 class="text-center" style="margin-top : 50px; margin-bottom : 50px">Etat du système : </h6>
    <button type="button" class="btn btn-primary" name="etat" id="etat" style="height : 150px; width : 150px; border-radius: 50%;"><i class="material-icons" style="font-size : 80px">power_settings_new</i></button>
        </div>

        <div class="footer-clean" style="background-color: #9292bf">
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Accueil</h3>
                        <ul>
                            <li><a href="#">Graphiques</a></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Planification</h3>
                        <ul>
                            <li><a href="#">Calendrier</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 item social">
                        <p class="copyright" style="font-size: 15px;">Aquatech 2019</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
      function settings()
        {
            window.location.href = "parametres.php";
        }
        $('#btn').click(function(){

        $.ajax({
        url:'test.php?call=true',
        type:'GET',
        success:function(data){
        body.append(data);

        }
    });
})  
    </script>
</body>

</html>