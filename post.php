<?php
require 'database.php';

$id = $_GET['id'] ?? 'null'; // if no id is passed, set it to an empty string

$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT); // sanitize the id to prevent SQL injection

if (!$id) {
  header('Location: index.php');
  exit;
}

$sql = 'SELECT * FROM posts WHERE id = :id';

$stmt = $pdo->prepare($sql);

$param = [
  'id' => $id
];

$stmt->execute($param);

$post = $stmt->fetch();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $post['title']; ?></title>
  <!-- TAILWIND CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <section class=" p-4 bg-blue-600 mb-8">
    <div>
      <h1 class="text-4xl font-bold text-white">Post </h1>
    </div>
  </section>

  <!-- list of blog post -->
  <div class="container mx-auto">
    <div class="p-5 bg-white rounded-lg shadow-lg leading-loose mb-5">
      <h2 class="font-bold text-2xl mb-5">
        <strong>Title:</strong>
        <?= $post['title']; ?>
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

  <!-- edit post -->
  <div class="container mx-auto mb-5 ">
    <a href="update.php?id=<?= $post['id']; ?>" class="bg-green-600 px-4 py-2 text-white rounded-md text-xl text-center w-full block">Edit</a>
  </div>

  <!-- delete post -->
  <div class="container mx-auto mb-5">
    <form action="delete.php" method="post">
      <input type="hidden" name="id" value="<?= $post['id']; ?>">
      <button type="submit" class="bg-red-500 px-4 py-2 text-white rounded-md text-xl text-center w-full">Delete</button>
    </form>
  </div>

  <!-- link to go back to the index page -->
  <div class="container mx-auto">
    <a href="index.php" class="text-blue-500 text-xl">Go Back</a>
  </div>
</body>

</html>