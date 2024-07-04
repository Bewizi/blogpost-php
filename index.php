<?php
require 'database.php';

$sql = 'SELECT * FROM posts';

$stmt = $pdo->prepare($sql);


$stmt->execute();

$posts = $stmt->fetchAll();



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Post</title>
  <!-- TAILWIND CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <section class=" p-4 bg-blue-600 mb-8">
    <div>
      <h1 class="text-4xl font-bold text-white">Blog Post</h1>
    </div>
  </section>

  <!-- list of blog post -->
  <?php foreach ($posts as $post) : ?>
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols ">
      <div class="p-5 bg-white rounded-lg shadow-lg   leading-loose mb-5">
        <h2 class="font-bold text-2xl mb-5">
          <a href="post.php?id=<?= $post['id'] ?>">
            <strong>Title:</strong>
            <?= $post['title']; ?>
          </a>
        </h2>
        <p class="text-lg mb-2 leading-loose text-justify">
          <strong>Description:</strong>
          <?= $post['content']; ?>
        </p>
        <span class="text-slate-400">
          <?= $post['created_at']; ?>
        </span>
      </div>
    </div>
  <?php endforeach; ?>
  <div class="container mx-auto">
    <a href="created.php" class="text-blue-500 text-xl">Create Post</a>
  </div>
</body>

</html>