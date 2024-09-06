<?php
    require_once 'connect.php';
    function matchUrl(string $url, string $filename) {
        if(strtok($_SERVER['REQUEST_URI' ],'?')  == $url) {
           require_once $filename;
        }
    }

    function query(string $query) {
        global $connect;
        return mysqli_query($connect, $query);
    }

    function getAll(string $table) {
        return mysqli_fetch_all(query("SELECT * FROM `$table`"), MYSQLI_ASSOC);
    }

    function getById(string $table, int $id) {
        $result = mysqli_fetch_assoc(query("SELECT * FROM `$table` WHERE `id` = '$id'"));
        return mysqli_fetch_assoc(query("SELECT * FROM `$table` WHERE `id` = '$id'"));
    }

    function displayLinks(int $id) {
        $postLinkParams = [
            ['path' => 'editPost', 'title' => 'Edit'],
            ['path' => 'fullPost', 'title' => 'Full']
        ];
        foreach($postLinkParams as $postLinkParam) {
            echo getLinkToPost($postLinkParam['path'], $id, $postLinkParam['title']);
        }
    }

    function displayButtons(int $id) {
        $buttonParams = [
            ['path' => 'deletePost', 'title' => 'Delete']
        ];
        foreach($buttonParams as $buttonParam) {
            echo "<form action='/{$buttonParam['path']}?id=$id' method='post'>
                    <input type='hidden' value='$id' name='id'>
                    <button class='btn btn-primary' type='submit'>{$buttonParam['title']}</button>
                  </form>";
        }
    }

    function getLinkToPost(string $path, int $postId, string $text) {
        return "<a href='/$path?id=$postId' class='btn btn-primary'>$text</a>";
    }

    $urls = [
        ['url' => '/', 'filename' => 'card.php'],
        ['url' => '/addNewPost', 'filename' => 'addPost.php'],
        ['url' => '/deletePost', 'filename' => 'delete.php'],
        ['url' => '/editPost', 'filename' => 'editPost.php'],
        ['url' => '/fullPost', 'filename' => 'fullPost.php'],
        ['url' => '/addNewCategory', 'filename' => 'addCategory.php'],
        ['url' => '/selectCategory', 'filename' => 'selectCategory.php']
    ]
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lonely Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php
            require_once 'header.php';
            foreach($urls as $url) {
                matchUrl($url['url'], $url['filename']);
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>
</html>
