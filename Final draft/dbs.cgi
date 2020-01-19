<?php
   ini_set('mysql.connect_timeout',300);
   ini_set('default_socket_timeout',300);
   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'web.session');
   define('DB_PASSWORD', 'abc123');
   define('DB_DATABASE', 'web');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>