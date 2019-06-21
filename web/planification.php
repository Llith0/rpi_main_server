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
    <title>Planification</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    <link href='assets/fullcalendar/core/main.css' rel='stylesheet' />
    <link href='assets/fullcalendar/daygrid/main.css' rel='stylesheet' />
    <link href="assets/css/material_icons.css" rel="stylesheet">

    <script src='assets/fullcalendar/core/main.js'></script>
    <script src='assets/fullcalendar/daygrid/main.js'></script>
    <script src='assets/fullcalendar/core/locales-all.js'></script>
    <script src='assets/fullcalendar/interaction/main.js'></script>
    <script src='assets/js/date.format.js'></script>


    <script>
            var date;
            var bool = 0;

            document.addEventListener('DOMContentLoaded', function() {
              var calendarEl = document.getElementById('calendar');

              var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'dayGrid','interaction' ],
                locale: 'fr',

                dateClick: function(info) {
                    var date = info.dateStr
                    var dict = {};
                    dict['date'] = date;
                    console.log(dict)
                    
                    if(bool == 0)
                    {
                        bool = bool + 1;
                        var div = document.createElement("div");
                        var cDiv = document.getElementById("info");

                        div.innerHTML = "Date sélectionnée : " + dateFormat(new Date(date)," dddd d mmmm yyyy") + "<br/><br/>";

                        cDiv.appendChild(div);

                        var form = document.createElement("form");

                        cDiv.appendChild(form);

                        div2 = document.createElement("div");

                        div2.className = "form-group row";

                        form.appendChild(div2);

                        var label = document.createElement("label")

                        label.htmlFor = "staticHour";
                        label.className = "col-sm-3 col-form-label";
                        label.innerHTML = "Heure début arrosage : "

                        div2.appendChild(label);

                        var div3 = document.createElement("div");
                        div3.className = "col-sm-10";
                        div2.appendChild(div3);

                        var input = document.createElement("input");
                        input.type = "text";
                        input.className = "form-control"
                        input.id = "staticHour";
                        input.placeholder = "Heure format (xn:xx)";

                        div3.appendChild(input);

                        var button = document.createElement("button");
                        
                        button.className = "btn btn-info";

                        button.innerHTML = "reset";

                        button.addEventListener("click", function() 
                        {while (cDiv.firstChild) {
                        cDiv.removeChild(cDiv.firstChild);
                    }
                    bool = 0;
                });

                        cDiv.appendChild(button);


                    }

                },


                events: [
        {
          title: 'Arrosage à 12:00',
          description: "ok",
          start: date
        }
              ]

              });

              
      
              calendar.render();
            });
      
          </script>

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
                    </ul><span class="navbar-text actions"><b class="m-4">Salut, <?php echo htmlspecialchars($_SESSION["username"]);?> !</b><a class="btn btn-danger action-button" style="background : red" role="button" href="logout.php">Deconnexion</a><?php if((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true) &&  $_SESSION["permissions"] === 1) {echo"<i id=\"settings\" onclick=\"settings()\" style = \" font-size : 25px; padding-left : 10px; vertical-align:middle;\" class=\"material-icons\">settings</i>";}?></span></div>
    </div>
            </nav>
            </div>
            <div>  

    <div class="container" style="height : 1200px; text-align: center; margin-top: 50px">
        <div class="col">
            <div id='calendar'></div>
        </div>
        <div class="col" id = "info" style="margin-top : 100px; text-align: initial">
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