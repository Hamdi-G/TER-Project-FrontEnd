<?php
session_start();
if (isset($_SESSION['access_token']))
{$access_token=$_SESSION['access_token'];}
if (isset($_SESSION['user_id']))
{$user_id=$_SESSION['user_id'];}
if (isset($_SESSION['admin']))
{$admin=$_SESSION['admin'];}
if (isset($_SESSION['connect']))
{$connect=$_SESSION['connect'];}
else
{$connect=0;}
if ($connect == "1")
{
  ?>
<!DOCTYPE html>
<!-- saved from url=(0077)http://demos.creative-tim.com/material-dashboard-pro/examples/pages/user.html -->
<html lang="en" class="perfect-scrollbar-on"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <link rel="apple-touch-icon" sizes="76x76" href="./hello_files/logo_iut.gif">
  <link rel="icon" type="image/png" href="../hello_files/logo_iut.gif">
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
  <link href="../hello_files/bootstrap.min.css" rel="stylesheet">
  <!--  Material Dashboard CSS    -->
  <link href="../hello_files/material-dashboard.css" rel="stylesheet">
  <!--  CSS for Demo Purpose, don't include it in your project     -->
  <link href="../hello_files/demo.css" rel="stylesheet">
  <!--     Fonts and icons     -->
  <link href="../hello_files/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet"  href="../hello_files/css.css">
  <script src="../hello_files/jquery-3.1.1.min.js" type="text/javascript"></script>
  <script src="../assets/js/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="../assets/css/sweetalert2.min.css">
  <script src="../plugins/spinner/g-spinner.js"></script>
    <link href="../plugins/spinner/gspinner.css" rel="stylesheet">
  </head>

  <body cz-shortcut-listen="true">
    <div class="wrapper">
      <div id="loader"></div>
      <div class="sidebar" data-active-color="rose" data-background-color="black" data-image="../assets/img/sidebar.jpg">
        <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
      -->
      <div class="logo">
        <a href="http://www.creative-tim.com/" class="simple-text">
          Système d'information <br> sur les étudiants
        </a>
      </div>
      <div class="logo logo-mini">
        <a href="http://www.creative-tim.com/" class="simple-text">
          SIE
        </a>
      </div>
      <div class="sidebar-wrapper ps-container ps-theme-default ps-active-y" data-ps-id="55dd967a-7c15-f2b4-e1b1-8d97839de57b">
        <div class="user">
          <div class="photo">
            <img src="../hello_files/avatar.jpg">
          </div>
          <div class="info">
            <a id="pseudo" data-toggle="collapse" href="http://demos.creative-tim.com/material-dashboard-pro/examples/pages/user.html#collapseExample" class="collapsed">


            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li>
                  <a href="http://demos.creative-tim.com/material-dashboard-pro/examples/pages/user.html#">My Profile</a>
                </li>
                <li>
                  <a href="http://demos.creative-tim.com/material-dashboard-pro/examples/pages/user.html#">Edit Profile</a>
                </li>
                <li>
                  <a href="#" onclick="location.href='../php/logout.php';">Déconnection</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li>
            <a href="#">
              <i class="material-icons">dashboard</i>
              <p>Accueil</p>
            </a>
          </li>
          <li>
            <a href="note-result.php">
              <i class="material-icons">dashboard</i>
              <p>Notes et resultats</p>
            </a>
          </li>
          <li>
            <a href="follow.php">
              <i class="material-icons">dashboard</i>
              <p>Suivi des diplômés</p>
            </a>
          </li>
          <li>
            <a href="absence.php">
              <i class="material-icons">dashboard</i>
              <p>Déclarations d’absences</p>
            </a>
          </li>
          <li>
            <a href="catching.php">
              <i class="material-icons">dashboard</i>
              <p>Demandes de rattrapages</p>
            </a>
          </li>
          <li>
            <a data-toggle="collapse" href="#pagesExamples" aria-expanded="false">
              <i class="material-icons">image</i>
              <p>Paramètres
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="pagesExamples">
              <ul class="nav">
                <li>
                  <a href="#">infrastructure</a>
                </li>
                <li>
                  <a href="users.php">utilisateurs</a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a href="http://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
        </ul>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 587px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 331px;"></div></div></div>
        <div class="sidebar-background" style="background-image: url(../../assets/img/sidebar-1.jpg) "></div></div>
        <div class="main-panel ps-container ps-theme-default ps-active-y" data-ps-id="44b814e0-342e-b1a5-dc65-f4bf3c25a075">
          <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
              <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                  <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                  <i class="material-icons visible-on-sidebar-mini">view_list</i>
                </button>
              </div>
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"> Profile </a>
              </div>
              <div class="collapse navbar-collapse">
                <form class="navbar-form navbar-right" role="search">
                  <div class="form-group form-search is-empty">
                    <input type="text" class="form-control" placeholder="Recherche étudiant">
                    <span class="material-input"></span>
                    <span class="material-input"></span></div>
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                      <i class="material-icons">search</i>
                      <div class="ripple-container"></div>
                    </button>
                  </form>
                </div>
              </div>
            </nav>

            <?php
          }
          else
          {
            header('Location: ../');
            exit();
          }
          ?>
