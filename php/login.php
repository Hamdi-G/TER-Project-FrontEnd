<?php
$user_id =$_POST['user_id'];
$admin =$_POST['admin'];
$access_token=$_POST['access_token'];
session_start();
$_SESSION['connect']=1;
$_SESSION['user_id']=$user_id;
$_SESSION['admin']=$admin;
$_SESSION['access_token']=$access_token;
