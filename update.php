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

$isUpdateRequest = $_SERVER['REQUEST_METHOD'] === 'POST';
$error = '';
if ($isUpdateRequest) {
  $title = htmlspecialchars($_POST['title'] ?? ''); // if no title is passed, set it to an empty string
  $content = htmlspecialchars($_POST['content'] ?? ''); // if no content is passed, set it to an empty string

  if (empty($title) || empty($content)) {
    $error = 'Please fill in all the fields';
  } else {



    $sql = 'UPDATE posts SET title = :title, content = :content, created_at = NOW() WHERE id =:id';

    $stmt = $pdo->prepare($sql);

    $params = [
      'title' => $title,
      'content' => $content,
      'id' => $id
    ];

    $stmt->execute($params);


    header('Location: index.php');
    exit;
  }
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
      <h1 class="text-4xl font-bold text-white">Edit Blog Post</h1>
    </div>
  </section>

  <!-- form for creating blog post -->
  <section class=" container mx-auto  p-4  mb-8 rounded-md shadow-lg">
    <form action="" method="post" autocomplete="off">

      <!-- <input type="hidden" name="_method" value="put"> -->
      <input type="hidden" name="id" value="<?= $post['id']; ?>">

      <div class="mb-5">
        <label for="title" class="block mb-2 text-lg">Title:</label>
        <input type="text" name="title" id="title" class=" bg-gray-100 border border-gray-600 rounded p-2 w-1/2 outline-none text-xl" placeholder="Title" value="<?= htmlspecialchars($post['title']); ?>">

      </div>

      <div class="mb-3">
        <label for="title" class="block mb-2 text-xl">Content:</label>
        <!-- <input type="text" name="title" id="content" class="bg-gray-
          700 border border-gray-600 rounded p-2 w-full"> -->
        <textarea name="content" id="content" class="bg-gray-100 border border-gray-600 rounded p-2 text-lg outline-none" rows="8" cols="50" value="<?= htmlspecialchars($post['content']) ?>" placeholder="Write  your blog post here"></textarea>

      </div>

      <!-- Error Message -->
      <?php if ($error) : ?>
        <div class="mb-4 text-red-500 text-lg">
          <?= $error; ?>
        </div>
      <?php endif; ?>

      <section class="flex justify-between items-center">
        <div>
          <button type="submit" class="bg-blue-600 px-4 py-2 text-white rounded-md text-lg">Update Post</button>
        </div>

        <div>
          <a href="index.php" class="text-blue-500 text-lg">Go back to post</a>
        </div>
      </section>
    </form>
  </section>
</body>

</html>