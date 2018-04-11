<?php
  include_once("config.php");

  //MySQL connection.
  $linkID = mySQLConnect();
  function mySQLConnect( $dbserver = DB_SERVER, $dbName = DB_DATABASE, $dbUser = DB_USER, $dbPass = DB_PASSWORD ) {
    if ( ! $con = mysqli_connect($dbserver, $dbUser, $dbPass, $dbName) ) {
      die("Could not connect to database. Please contact your administrator.");
    } else {
      return $con;
    }
  }

  //Additional functions here:
  

?>
