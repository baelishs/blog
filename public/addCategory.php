<?php
    if(!empty($_POST)){
        $title = $_POST['title'];
        query("INSERT INTO `category` (`title`) VALUES ('$title')");
    }
    $categories = getAll('category')
?>

<h2>Add new category</h2>
<form method="post">
    <div class="form-group">
        <label for="exampleFormControlInput1">Category title</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="title">
    </div>
    <button class="btn btn-primary" type="submit">Add</button>
</form>

<hr>

<h4>All categories</h4>
<ul class="list-group">
    <?php foreach($categories as $category): ?>
        <li class="list-group-item"> <?= $category['title'] ?> </li>
    <?php endforeach; ?>
</ul>
