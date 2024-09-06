<?php
    $id = $_POST['id'];
    query("DELETE FROM `comments` WHERE `post_id` = '$id'");
    query("DELETE FROM `post` WHERE `id` = '$id'");
?>

<div class="alert alert-success" role="alert" style="width: 25rem;">
    <h4 class="alert-heading">Nice!</h4>
    <p>ur post #<?= $id ?> and all comments to that post was deleted, it's alright you'll make a lot of them</p>
</div>
