<?php

require 'database.php';

$isDeleteRequest = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($isDeleteRequest) {
  $id = $_POST['id'];
  $sql = 'DELETE FROM posts WHERE id = :id';

  $stmt = $pdo->prepare($sql);

  $param = [
    'id' => $id
  ];

  $stmt->execute($param);

  $post = $stmt->fetch();
}

header('Location: index.php');
exit;
