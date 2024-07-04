<?php

// CONNECTING MY DATABASE

// GIVING MY (LOCALHOST, APACHE PORT, DATABASE, USERNAME AND PASSWORD) VARIABLES
$host = 'localhost';
$port = 3306;
$dbname = 'blog';
$username = 'root';
$password = '';

// CREATE A DATA SOURCE NAME TO LINK (LOCALHOST, APACHE PORT, DATABASE, USERNAME AND PASSWORD)  
$dsn = "mysql:host={$host};port={$port};dbname={$dbname}";


/**
 * ALSO USING THE PDO OBJECT
 * ADDING A TRY CATCH FOR CONNECTIONS SUCCESS AND ERROR
 */
try {
  $pdo = new PDO($dsn, $username, $password);

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // TO FETCH ALL MY DATA IN MY DATABASE
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo 'Connection Failed ' . $e->getMessage();
}
