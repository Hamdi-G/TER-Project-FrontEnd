<?php
session_start();// � placer obligatoirement avant tout code HTML.
$_SESSION['connect']=0;
?>
<!DOCTYPE html>
<!-- saved from url=(0078)http://demos.creative-tim.com/material-dashboard-pro/examples/pages/login.html -->
<html lang="en" class="perfect-scrollbar-on"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <link rel="apple-touch-icon" sizes="76x76" href="http://demos.creative-tim.com/material-dashboard-pro/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./hello_files/logo_iut.gif">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Système d'information sur les étudiants</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
  <meta name="viewport" content="width=device-width">
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard-pro">
  <!--  Social tags      -->
  <meta name="keywords" content="material dashboard, bootstrap material admin, bootstrap material dashboard, material design admin, material design, creative tim, html dashboard, html css dashboard, web dashboard, freebie, free bootstrap dashboard, css3 dashboard, bootstrap admin, bootstrap dashboard, frontend, responsive bootstrap dashboard, premiu material design admin">
  <meta name="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google&#39;s Material Design.">
  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
  <meta itemprop="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google&#39;s Material Design.">
  <meta itemprop="image" content="http://s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg">
  <!-- Twitter Card data -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@creativetim">
  <meta name="twitter:title" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
  <meta name="twitter:description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google&#39;s Material Design.">
  <meta name="twitter:creator" content="@creativetim">
  <meta name="twitter:image" content="http://s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg">
  <!-- Open Graph data -->
  <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
  <meta property="og:type" content="article">
  <meta property="og:url" content="http://www.creative-tim.com/product/material-dashboard-pro">
  <meta property="og:image" content="http://s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg">
  <meta property="og:description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google&#39;s Material Design.">
  <meta property="og:site_name" content="Creative Tim">
  <!-- Bootstrap core CSS     -->
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <!--  Material Dashboard CSS    -->
  <link href="./css/material-dashboard.css" rel="stylesheet">
  <!--  CSS for Demo Purpose, don't include it in your project     -->
  <link href="./css/demo.css" rel="stylesheet">
  <!--     Fonts and icons     -->
  <link href="./css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./css/css">
  <script type="text/javascript" charset="UTF-8" src="./js/common.js.téléchargement"></script><script type="text/javascript" charset="UTF-8" src="./js/util.js.téléchargement"></script><script type="text/javascript" charset="UTF-8" src="./js/stats.js.téléchargement"></script></head>

  <body cz-shortcut-listen="true">

    <nav class="navbar navbar-primary navbar-transparent navbar-absolute" style="background-color: rgba(220, 220, 220, 0.3);">
      <div class="container">
        <div class="navbar-header">
          <img src="img/logo_uns_cmjncopie.png" width="100" height="60" style="float:left;">
          <div class="navbar-brand" href=" ../dashboard.html " style="font-size:20px;position: absolute; left: 27%;right: 25%;text-align: center; color: white;  font-size: 1.5em; line-height: 2.2em;">Systéme d'inforamtion sur les étudiants</div>
          <img src="img/logo-iut.png" width="70" height="60" style="position: absolute; right: 5%;">
        </div>
      </div>
    </nav>
    <!--<nav class="navbar navbar-primary navbar-transparent navbar-absolute" style="background-color: white; opacity: 0.4;
    filter: alpha(opacity=40); /* For IE8 and earlier */">
    <div class="container">
    <div class="navbar-header">
    <div class="nav navbar-nav navbar-left">
    <a class="navbar-brand" href="#">
    <img src="img/logo_uns_cmjncopie.png" width="100" height="60"></a>
  </div>

  <div class="nav navbar-nav navbar-right">
  <img src="img/logo-iut.png" width="70" height="80">
</div>
</div>
</div>
</nav>-->
<div class="wrapper wrapper-full-page">
  <div class="full-page login-page" filter-color="black" data-image="../../assets/img/login.jpeg">
    <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3" style="margin-top: 60px">
            <form id="myForm">
              <div class="card card-login">
                <div class="card-header text-center" data-background-color="blue">
                  <h4 class="card-title">Authentification</h4>

                </div>
                <p id="error"class="category text-center" style="color: red;display:none">
                  Identifiant ou mot de passe incorrect!
                </p>
                <div class="card-content">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">face</i>
                    </span>
                    <div class="form-group label-floating is-empty">
                      <label class="control-label">Identifiant</label>
                      <input type="text" class="form-control" id="pseudo" required="true">
                      <span class="material-input"></span></div>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">lock_outline</i>
                      </span>
                      <div class="form-group label-floating is-empty">
                        <label class="control-label">Mot de passe</label>
                        <input type="password" class="form-control" id="pwd" required="true">
                        <span class="material-input"></span></div>
                      </div>
                    </div>
                    <div class="footer text-center">
                      <button type="submit" class="btn btn-info btn-simple btn-wd btn-lg">Connexion</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="container">

          </div>
        </footer>
        <div class="full-page-background" style="background-image: url(img/sophia-antipolis.jpg) "></div></div>
      </div>

      <!--   Core JS Files   -->
      <script src="./js/jquery-3.1.1.min.js.téléchargement" type="text/javascript"></script>
      <script src="./js/jquery-ui.min.js.téléchargement" type="text/javascript"></script>
      <script src="./js/bootstrap.min.js.téléchargement" type="text/javascript"></script>
      <script src="./js/material.min.js.téléchargement" type="text/javascript"></script>
      <script src="./js/perfect-scrollbar.jquery.min.js.téléchargement" type="text/javascript"></script>
      <!-- Forms Validations Plugin -->
      <script src="./js/jquery.validate.min.js.téléchargement"></script>
      <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
      <script src="./js/moment.min.js.téléchargement"></script>
      <!--  Charts Plugin -->
      <script src="./js/chartist.min.js.téléchargement"></script>
      <!--  Plugin for the Wizard -->
      <script src="./js/jquery.bootstrap-wizard.js.téléchargement"></script>
      <!--  Notifications Plugin    -->
      <script src="./js/bootstrap-notify.js.téléchargement"></script>
      <!--   Sharrre Library    -->
      <script src="./js/jquery.sharrre.js.téléchargement"></script>
      <!-- DateTimePicker Plugin -->
      <script src="./js/bootstrap-datetimepicker.js.téléchargement"></script>
      <!-- Vector Map plugin -->
      <script src="./js/jquery-jvectormap.js.téléchargement"></script>
      <!-- Sliders Plugin -->
      <script src="./js/nouislider.min.js.téléchargement"></script>
      <!--  Google Maps Plugin    -->
      <script src="./js/js"></script>
      <!-- Select Plugin -->
      <script src="./js/jquery.select-bootstrap.js.téléchargement"></script>
      <!--  DataTables.net Plugin    -->
      <script src="./js/jquery.datatables.js.téléchargement"></script>
      <!-- Sweet Alert 2 plugin -->
      <script src="./js/sweetalert2.js.téléchargement"></script>
      <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
      <script src="./js/jasny-bootstrap.min.js.téléchargement"></script>
      <!--  Full Calendar Plugin    -->
      <script src="./js/fullcalendar.min.js.téléchargement"></script>
      <!-- TagsInput Plugin -->
      <script src="./js/jquery.tagsinput.js.téléchargement"></script>
      <!-- Material Dashboard javascript methods -->
      <script src="./js/material-dashboard.js.téléchargement"></script>
      <!-- Material Dashboard DEMO methods, don't include it in your project! -->
      <script src="./js/demo.js.téléchargement"></script>
      <script type="text/javascript">



      $(document).ready(function() {

        demo.checkFullPageBackgroundImage();

        setTimeout(function() {
          // after 1000 ms we add the class animated to the login/register card
          $('.card').removeClass('card-hidden');
        }, 700)

        // Lorsque je soumets le formulaire
        $('#myForm').on('submit', function(e) {
          e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire

          var $this = $(this); // L'objet jQuery du formulaire

          // Je récupère les valeurs
          var pseudo = $('#pseudo').val();
          var password = $('#pwd').val();

          // Envoi de la requête HTTP en mode asynchrone
          $.ajax({
            url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/oauth/v2/token',
            type: 'POST',
            data: {
              grant_type : 'password',
              client_id : '1_3bcbxd9e24g0gk4swg0kwgcwg4o8k8g4g888kwc44gcc0gwwk4',
              client_secret : '4ok2x70rlfokc8g0wws8c8kwcokw80k44sg48goc0ok4w0so0k',
              username : pseudo,
              password : password
            },
            dataType: "json",
            success: function(response) {

            var access_token_ = response.access_token;

              $.ajax({
                url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/teachers',
                type: 'GET',
                dataType: "json",
                success: function(response){
                  $.ajax({
                    type: 'POST',
                    url: 'php/login.php',
                    data: { user_id: response[0].id, access_token: access_token_},
                    success: function(response) {
                      window.location.href = "content/";
                    }
                  });
                  /*
                  sessionStorage.setItem('user_id',response[0].id);
                  console.log(sessionStorage.getItem('user_id'));
                  window.location.href = "content/";*/

                },
                beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + sessionStorage.getItem('access_token')); }
              }).fail(function(data, status) {

                alert(status);

              });
            }
          }).fail(function(data, status) {
            $('#error').show();
            $('#pseudo').val('');
            $('#pwd').val('');
            $('#pseudo').focus();

          });


        });
      });
      </script>

    </body></html>
