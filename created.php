<?php
require 'database.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = htmlspecialchars($_POST['title']);
  $content = htmlspecialchars($_POST['content']);

  if (empty($title) || empty($content)) {
    header('Location: created.php?error=emptyfields');
    exit;
  } else {
    echo 'Title and Content Enter';
  }

  $sql = 'INSERT INTO posts (title, content) VALUES (:title, :content)';

  $statement = $pdo->prepare($sql);

  $params = [
    'title' => $title,
    'content' => $content
  ];

  $statement->execute($params);

  header('Location: index.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Blog</title>
  <!-- TAILWIND CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <section class=" p-4 bg-blue-600 mb-8">
    <div>
      <h1 class="text-4xl font-bold text-white">Create Blog Post</h1>
    </div>
  </section>

  <!-- form for creating blog post -->
  <section class=" container mx-auto  p-4  mb-8 rounded-md shadow-lg">
    <form action="" method="post" autocomplete="off">
      <div class="mb-5">
        <label for="title" class="block mb-2 text-lg">Title:</label>
        <input type="text" name="title" id="title" class="bg-gray-100 border border-gray-600 rounded p-2 w-1/2 outline-none text-xl" placeholder="Title">
      </div>

      <div class="mb-3">
        <label for="title" class="block mb-2 text-xl">Content:</label>
        <!-- <input type="text" name="title" id="content" class="bg-gray-
          700 border border-gray-600 rounded p-2 w-full"> -->
        <textarea name="content" id="content" class="bg-gray-100 border border-gray-600 rounded p-2 text-lg" rows="8" cols="50" placeholder="Write  your blog post here"></textarea>
      </div>

      <!-- Error Message -->
      <div class="mb-5">
        <?php if (isset($_GET['error'])  && $_GET['error'] == 'emptyfields') : ?>
          <p class="text-red-500 text-lg">Please fill all the fields</p>
        <?php endif; ?>
      </div>

      <section class="flex justify-between items-center">
        <div>
          <button type="submit" class="bg-blue-600 px-4 py-2 text-white rounded-md text-lg">Create Post</button>
        </div>

        <div>
          <a href="index.php" class="text-blue-500 text-lg">Go to post</a>
        </div>
      </section>


    </form>
  </section>
</body>

</html>