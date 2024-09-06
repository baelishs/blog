<?php
    $categories = getAll('category');

    function addPost() {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $date = date('Y-m-d');
        $categoryId = $_POST['categoryId'];

        query("INSERT INTO `post` (`title`, `text`, `date`, `category_id`) VALUES ('$title', '$text', '$date', NULLIF('$categoryId', ''))");
    }

    if(!empty($_POST)) {
        addPost();
    }

    ?>

<form method="post">
    <h2>
        Add new post
    </h2>
    <div class="form-group">
        <label for="exampleFormControlInput1">Post title</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="title">
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Post text</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text"></textarea>
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Category</label>
        <select name="categoryId" class="form-select" >
            <option selected></option>
            <?php foreach($categories as $category): ?>
                <option value="<?= $category['id'] ?>"> <?= $category['title'] ?> </option>
            <?php endforeach;?>
        </select>
    </div>
    <hr>
    <button class="btn btn-primary" type="submit">Add</button>
</form>

