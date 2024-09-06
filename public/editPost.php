<?php
    $postId = $_GET['id'];


    $post = getById('post', $postId);
    $categories = getAll('category');

    class PostController
    {
        public function actionIndex()
        {
            return require_once 'papka_s_vew';
        }

        public function actionEdit($id)
        {
            $model = new PostModel();
            $model->editPost($id, $_POST);
        }
    }

    class PostModel
    {
        public function getById($id)
        {
            return 'post';
        }

        public function editPost($id, $data)
        {
            $post = $this->getById($id);
            $title = $_POST['title'];
            $text = $_POST['text'];
            $category = $_POST['categoryId'];
            $date = date('Y-m-d');
            $this->saveModel();
            return 'aaa';
        }
    }

    function editPost(int $id) {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $category = $_POST['categoryId'];
        $date = date('Y-m-d');

        query("UPDATE `post` SET `title` = '$title', `text` = '$text', `category_id` = '$category', `date` = '$date' WHERE `id` = $id");
    }

    if($_POST) {
        editPost($postId);
    }
?>

<form method="post">
    <h2>
        Edit post
    </h2>
    <div class="form-group">
        <label for="exampleFormControlInput1">Post title</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="title" value="<?= $post['title']?>">
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Post text</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text"><?= $post['text']?></textarea>
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
    <button class="btn btn-primary" type="submit">Edit</button>
</form>



