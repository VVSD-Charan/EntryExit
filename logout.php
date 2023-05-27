<?php
   require "./partials/_nav.php";

   session_start();

   if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false)
   {
      header('Location:  login.php');
      exit;
   }

   session_unset();
   session_destroy();

   error_reporting(E_ALL); 
   ini_set('display_errors', 'On');
   header('Location: login.php'); 
   ?>