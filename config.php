<?php
      $host        = "host = localhost";
      $port        = "port = 5432";
      $dbname      = "dbname = test1";
      $credentials = "user = postgres password=12345";

      $db = pg_connect( "$host $port $dbname $credentials"  );
   // if(!$db) {
   //    echo "Error : Unable to connect database\n";
   // } else {
   //    echo "Connected database successfully\n";
   // }
?>