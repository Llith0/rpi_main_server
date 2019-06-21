<?php

session_start();

if((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true) &&  $_SESSION["permissions"] === 1) {
    header("location: index.php");
    exit;
}

$jsonObj = new stdClass();

if(isset($_POST["InputElectrovannes"]))
{
    $electrovannes = $_POST["InputElectrovannes"];
    if($electrovannes >= 0 && $electrovannes <= 4)
        if(is_numeric($electrovannes))
        {
            $jsonObj->electrovannes = $electrovannes;
        }
        else
        echo "la valeur rentrée n'est pas un nombre !";
    else
        echo "La valeur du champ \"Nombre d'électrovannes\" n'est pas entre 0 et 4 ";
}

if(isset($_POST["InputElectrovannes"]))
{
switch($electrovannes)
{
    case 0 : 
    {
        $surface1 = 0;
        $jsonObj->surface1 = $surface1;
        $surface2 = 0;
        $jsonObj->surface2 = $surface2;
        $surface3 = 0;
        $jsonObj->surface3 = $surface3;
        $surface4 = 0;
        $jsonObj->surface4 = $surface4;
    } break;
    case 1 :
    {
        if(isset($_POST["surface1"]))
        {
            if(is_numeric($_POST["surface1"]))
            {
                $surface1 = $_POST["surface1"];
                $jsonObj->surface1 = $surface1;
            }
            else
                echo "la valeur rentrée n'est pas un nombre !";
        }
        if($_POST["surface1"] === "")
        {
            echo "pas de valeurs rentrées, definition de la surface1 à 0";
            $surface1 = 0;
            $jsonObj->surface1 = $surface1;
        }
        $surface2 = 0;
        $jsonObj->surface2 = $surface2;
        $surface3 = 0;
        $jsonObj->surface3 = $surface3;
        $surface4 = 0;
        $jsonObj->surface4 = $surface4;
    } break;

    case 2 : 
    {
        if(isset($_POST["surface1"]))
        {
            if(is_numeric($_POST["surface1"]))
            {
                $surface1 = $_POST["surface1"];
                $jsonObj->surface1 = $surface1;
            }
            else
                echo "la valeur rentrée n'est pas un nombre !";
        }
        if($_POST["surface1"] === "")
        {
            echo "pas de valeurs rentrées, definition de la surface1 à 0";
            $surface1 = 0;
            $jsonObj->surface1 = $surface1;
        }

        if(isset($_POST["surface2"]))
        {
            if(is_numeric($_POST["surface2"]))
            {
                $surface2 = $_POST["surface2"];
                $jsonObj->surface2 = $surface2;
            }
            else
                echo "la valeur rentrée n'est pas un nombre !";
        }
        if($_POST["surface2"] === "")
        {
            echo "pas de valeurs rentrées, definition de la surface2 à 0";
            $surface2 = 0;
            $jsonObj->surface2 = $surface2;
        }
        $surface3 = 0;
        $jsonObj->surface3 = $surface3;
        $surface4 = 0;
        $jsonObj->surface4 = $surface4;
    } break;
    
    case 3 :
    {
        if(isset($_POST["surface1"]))
        {
            if(is_numeric($_POST["surface1"]))
            {
                $surface1 = $_POST["surface1"];
                $jsonObj->surface1 = $surface1;
            }
            else
                echo "la valeur rentrée n'est pas un nombre !";
        }
        if($_POST["surface1"] === "")
        {
            echo "pas de valeurs rentrées, definition de la surface1 à 0";
            $surface1 = 0;
            $jsonObj->surface1 = $surface1;
        }

        if(isset($_POST["surface2"]))
        {
            if(is_numeric($_POST["surface2"]))
            {
                $surface2 = $_POST["surface2"];
                $jsonObj->surface2 = $surface2;
            }
            else
                echo "la valeur rentrée n'est pas un nombre !";
        }
        if($_POST["surface2"] === "")
        {
            echo "pas de valeurs rentrées, definition de la surface2 à 0";
            $jsonObj->surface2 = $surface2;
        }
        if(isset($_POST["surface3"]))
        {
            if(is_numeric($_POST["surface3"]))
            {
                $surface3 = $_POST["surface3"];
                $jsonObj->surface3 = $surface3;
            }
            else
                echo "la valeur rentrée n'est pas un nombre !";
        }
        if($_POST["surface3"] === "")
        {
            echo "pas de valeurs rentrées, definition de la surface3 à 0";
            $surface3 = 0;
            $jsonObj->surface3 = $surface3;
        }
        $surface4 = 0;
        $jsonObj->surface4 = $surface4;
    } break;

    case 4 :
    {
        if(isset($_POST["surface1"]))
        {
            if(is_numeric($_POST["surface1"]))
            {
                $surface1 = $_POST["surface1"];
                $jsonObj->surface1 = $surface1;
            }
            else
                echo "la valeur rentrée n'est pas un nombre !";
        }
        if($_POST["surface1"] === "")
        {
            echo "pas de valeurs rentrées, definition de la surface1 à 0";
            $surface1 = 0;
            $jsonObj->surface1 = $surface1;
        }

        if(isset($_POST["surface2"]))
        {
            if(is_numeric($_POST["surface2"]))
            {
                $surface2 = $_POST["surface2"];
                $jsonObj->surface2 = $surface2;
            }
            else
                echo "la valeur rentrée n'est pas un nombre !";
        }
        if($_POST["surface2"] === "")
        {
            echo "pas de valeurs rentrées, definition de la surface2 à 0";
            $surface2 = 0;
            $jsonObj->surface2 = $surface2;
        }
        if(isset($_POST["surface3"]))
        {
            if(is_numeric($_POST["surface3"]))
            {
                $surface3 = $_POST["surface3"];
                $jsonObj->surface3 = $surface3;
            }
            else
                echo "la valeur rentrée n'est pas un nombre !";
        }
        if($_POST["surface3"] === "")
        {
            echo "pas de valeurs rentrées, definition de la surface3 à 0";
            $surface3 = 0;
            $jsonObj->surface3 = $surface3;
        }
        if(isset($_POST["surface4"]))
        {
            if(is_numeric($_POST["surface4"]))
            {
                $surface4 = $_POST["surface4"];
                $jsonObj->surface4 = $surface4;
            }
            else
                echo "la valeur rentrée n'est pas un nombre !";
        }
        if($_POST["surface4"] === "")
        {
            echo "pas de valeurs rentrées, definition de la surface4 à 0";
            $surface4 = 0;
            $jsonObj->surface4 = $surface4;
        } 
    }break;
}
    if(isset($_POST["heure"]))
    {
        if(is_numeric($_POST["heure"]))
        {
            $heure = $_POST["heure"];
            if(strlen($heure) === 4)
            {
                $jsonObj->heure = $heure;
            }
            else
             echo "la longueur de l'heure n'est pas respectée ! ";
        }
        else
            echo "la valeur rentrée n'est pas un nombre !";
        if($_POST["heure"] === "")
        {
            echo "pas de valeurs rentrées, definition de l'heure à ' à 22 00";
            $heure = 2200;
            $jsonObj->heure = $heure;
        }
    }

    $json = json_encode($jsonObj);
}

$handle = "settings.json";

if(isset($_POST["heure"]))
    file_put_contents($handle, $json);

$file = file_get_contents($handle);

if($file !== "")
{
    $jsonD = json_decode($file);
    $jsonElectovanne = $jsonD->{'electrovannes'};
    $jsonSurface1 = $jsonD->{'surface1'};
    $jsonSurface2 = $jsonD->{'surface2'};
    $jsonSurface3 = $jsonD->{'surface3'};
    $jsonSurface4 = $jsonD->{'surface4'};
    $jsonHeure = $jsonD->{'heure'};
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Paramètres</title>
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
                    </ul><span style = "text-align : center" class="navbar-text actions"><b class="m-4">Salut, <?php echo htmlspecialchars($_SESSION["username"]);?> !</b><a class="btn btn-danger action-button" style="background : red" role="button" href="logout.php">Deconnexion</a><?php if((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true) &&  $_SESSION["permissions"] >= 1) {echo"<i id=\"settings\" onclick=\"settings()\" style = \" font-size : 25px; padding-left : 10px; vertical-align:middle;\" class=\"material-icons\">settings</i>";}?></span></div>
    </div>
    </nav>
    </div>
    <div>
        <div class="container" style="height : 900px;">
        <h5 class="text-center" style="margin-top : 50px; margin-bottom : 50px">Paramètres du système :</h5>

        <form name = "settings" action="" method="post">
  <div class="form-group">
    <label for="InputElectrovannes">Nombre d'électrovannes : </label>
    <input type="text" class="form-control" name="InputElectrovannes" id="InputElectrovannes" aria-describedby="emailHelp" placeholder="Rentrer le nombre électrovannes (4 maximum)">
    <small id="electrovanneAcutalValue" class="form-text text-muted">Valeur actuelle : <?php echo $jsonElectovanne ?>  </small>
  </div>
  <div class="form-group">
    <label for="surface1">Surface 1 : </label>
    <input type="text" class="form-control" name = "surface1" id="surface1" placeholder="Entrer la surface (rentrer la valeur en m²)">
    <small id="surface1AcutalValue" class="form-text text-muted">Valeur actuelle : <?php echo $jsonSurface1 ?> </small>
  </div>
  <div class="form-group">
    <label for="surface2">Surface 2 : </label>
    <input type="text" class="form-control" name = "surface2" id="surface2" placeholder="Entrer la surface (rentrer la valeur en m²)">
    <small id="surface2AcutalValue" class="form-text text-muted">Valeur actuelle : <?php echo $jsonSurface2 ?> </small>
  </div>
  <div class="form-group">
    <label for="surface3">Surface 3 : </label>
    <input type="text" class="form-control" name = "surface3" id="surface3" placeholder="Entrer la surface (rentrer la valeur en m²)">
    <small id="surface3AcutalValue" class="form-text text-muted">Valeur actuelle : <?php echo $jsonSurface3 ?> </small>
  </div>
  <div class="form-group">
    <label for="surface4">Surface 4 : </label>
    <input type="text" class="form-control" name = "surface4" id="surface4" placeholder="Entrer la surface (rentrer la valeur en m²)">
    <small id="surface4AcutalValue" class="form-text text-muted">Valeur actuelle : <?php echo $jsonSurface4 ?> </small>
  </div>
  <div class="form-group">
    <label for="heure">Heure de début d'arrosage : </label>
    <input type="text" class="form-control" name="heure" id="heure" placeholder="rentrer l'heure pour le début d'arrosage (format hhmm)">
    <small id="heureAcutalValue" class="form-text text-muted">Valeur actuelle : <?php echo $jsonHeure ?></small>
  </div>
  <button type="submit" class="btn btn-primary" style="margin-top : 20px">Enregistrer les paramètres</button>
</form>
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
    </script>
</body>

</html>
