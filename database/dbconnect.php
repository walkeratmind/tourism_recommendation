<?php
 define ('DB_NAME', 'tourism_recommendation');
 define ('DB_USER', 'root');
 define ('DB_PASSWORD', '');
 define ('DB_HOST', 'localhost');
 
 define ('SITE_ROOT', realpath(dirname(__FILE__)));
 define ('IMAGE_PATH', SITE_ROOT . "/../imageUploads/");
 
 class dbconnect {
   private $con;

   function __construct() {

   }

   function connect() {
     $this->con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

     if (mysqli_connect_errno()) {
       echo "failed to connect" . mysqli_connect_err();
     }
     return $this->con;
   }
 }

 ?>
