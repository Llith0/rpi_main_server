<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$mysql = new mysqli("localhost", "root", "enzolepd", "aquatech");

if($mysql->connect_errno)
{
    echo "Echec lors de la connexion : (".$mysql->connect_errno." )".$mysql->error;
}

$sql = "SELECT date,evp,precip FROM jour";
$result = $mysql->query($sql);

$fileEvp = file_put_contents("pluviometrie.csv","Date,pluviometrie\n");
$fileEvp = file_put_contents("evapotranspiration.csv","Date,evapotranspiration\n");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $date = $row["date"];
        $date = substr($date, 0, 4).substr($date, 5, 2).substr($date, 8, 2);
        $evp = $row["evp"];
        $precip = $row["precip"];
        $content = $date.",".$precip."\n";
        $fileEvp = file_put_contents("pluviometrie.csv",$content, FILE_APPEND);
        $content = $date.",".$evp."\n";
        $fileEvp = file_put_contents("evapotranspiration.csv",$content, FILE_APPEND);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Accueil</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="assets/css/dygraph.css"/>
    <script src="assets/js/dygraph.min.js"></script>
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
        <div class="container" style="height : 900px; text-align: center">
            <div class="row" style="display: inline-block" >
                <div class="col" style ="margin-bottom: 80px; margin-top: 80px">
                    <h1 style="font-size : 15px; margin-left: 50px">Evapotranspiration (mm)</h1>
                    <div id="graphdiv2" style="width:1000px; height:300px;"></div>
                <script type="text/javascript">
                g2 = new Dygraph(document.getElementById("graphdiv2"),"evapotranspiration.csv", // path to CSV file
                {}          // options
                 );
                </script>
                </div>
                <div class="col">
                    <h1 style="font-size : 15px; margin-left: 50px">Pluviométrie (mm)</h1>
                    <div id="graphdiv3" style="width:1000px; height:300px;"></div>
                    <script type="text/javascript">
                    g4 = new Dygraph(document.getElementById("graphdiv3"),"pluviometrie.csv", // path to CSV file
                    {}          // options
                     );
                    </script>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
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
    </script>
</body>

</html>
