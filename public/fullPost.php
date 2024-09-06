<?php
    $postId = $_GET['id'];
    $post = getById('post', $postId);

    function addComment(int $id) {
        $username = $_POST['username'];
        $text = $_POST['text'];
        $date = date('Y-m-d');

        query("INSERT INTO `comments` (`username`, `text`, `post_id`, `date`) VALUES ('$username', '$text', '$id', '$date')");
    }

    if($_POST) {
        addComment($postId);
    }

    function displayCommentsById(int $id) {
        $comments = mysqli_fetch_all(query("SELECT * FROM `comments` WHERE `post_id` = '$id'"), MYSQLI_ASSOC);
        foreach($comments as $comment) {
            echo "<div class='card'>
                <div class='card-body'>
                    <h5> {$comment['username']} </h5>
                    <p> {$comment['text']} </p>
                    <p> {$comment['date']} </p>
                </div>
            </div>";
        }
    }
?>

<div class="card-body">
    <h2> <?= $post['title']?> </h2>
    <p> <?= $post['text']?> </p>
    <p> <?= $post['category_id'] ? getById('category', $post['category_id'])['title'] : '' ?> </p>
    <p> <?= $post['date']?> </p>
    <?= displayLinks($postId)?>
    <?= displayButtons($postId)?>
</div>
<hr>
<h5>Comments</h5>
<form method="post">
    <div class="form-group">
        <input type="text" id="form-username" class="form-control mb-1" placeholder="Username" name="username">
        <textarea class="form-control mt-2" id="form-comment" rows="2" placeholder="Enter your comment here..." name="text"></textarea>
    </div>
    <button type="submit" id="submit" class="btn btn-primary float-right">Comment</button>
</form>
<?php displayCommentsById($postId)?>

