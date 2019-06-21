<?php

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
    <title>Accueil</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="assets/css/dygraph.css"/>
    <script src="assets/js/dygraph.min.js"></script>
</head>

<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color: #9292bf;">
            <div class="container"><img src="assets/img/logo.png" style="width: 80px;height: 62px;"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item" role="presentation"></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="index.html" style="margin-left: 30px;">Accueil</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="planification.html">Planification</a></li>
                    </ul><span class="navbar-text actions"> <a class="login" href="login.php">Connexion</a><a class="btn btn-light action-button" role="button" href="#">Inscription</a></span></div>
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
                g2 = new Dygraph(document.getElementById("graphdiv2"),"temperatures1.csv", // path to CSV file
                {}          // options
                 );
                </script>
                </div>
                <div class="col">
                    <h1 style="font-size : 15px; margin-left: 50px">Pluviométrie (mm)</h1>
                    <div id="graphdiv3" style="width:1000px; height:300px;"></div>
                    <script type="text/javascript">
                    g4 = new Dygraph(document.getElementById("graphdiv3"),"temperatures2.csv", // path to CSV file
                    {}          // options
                     );
                    </script>
                </div>
            </div>
        </div>
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
                        <p class="copyright" style="position: absolute;bottom: 0;right: 0;font-size: 15px;">Aquatech 2019</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>