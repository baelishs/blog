<?php
    define("LIMIT", 5);

    $categoryId = empty($_GET['categoryId']) ? null : $_GET['categoryId'];
    $posts = getPaginationPosts($categoryId);
    $categories = getAll('category');
    $categoriesMap = array_column($categories, 'title', 'id');;

    function getTotal(string $table, string $column = '', ?int $id = null) {
        $condition = $id ? " WHERE `$column` = $id" : '';
        return mysqli_fetch_assoc(query("SELECT COUNT(*) FROM `$table` " . $condition))['COUNT(*)'];
    }

    function getTotalPages(?int $categoryId ) {
        $totalPosts = $categoryId ? getTotal('category', 'id', $categoryId) : getTotal('post');
        return ceil($totalPosts / LIMIT);
    }

    function displayPagination(?int $categoryId) {
        for ($page = 1; $page <= getTotalPages($categoryId); $page++) {
            $link = getPaginationLink($page, $categoryId);
            echo "<li class='page-item'>
                    <a class='page-link' href='$link' > $page</a>
                  </li>";
        }
    }

    function getPaginationPosts(?int $categoryId) {
        $page = $_GET['page'] ?? 1;
        $offset = ($page-1) * LIMIT;
        $condition = $categoryId ? "WHERE `category_id` = '$categoryId'" : '';
        return mysqli_fetch_all(query("SELECT * FROM `post` $condition LIMIT " . LIMIT . " OFFSET $offset"), MYSQLI_ASSOC);
    }

    function getPaginationLink(int $page, ?int $categoryId) {
        $categoryLink = $categoryId ? '&categoryId=' . $categoryId : '';
        return '/?page=' . $page . $categoryLink;
    }
?>

<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Category</label>
        <select name="categoryId" class="form-select" >
            <option selected></option>
            <?php foreach($categories as $category) :?>
                <option value="<?= $category['id'] ?>"> <?= $category['title'] ?> </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Show posts with this category</button>
</form>
<hr>
<h3> <?= $categoryId ? getById('category', $categoryId)['title'] : '' ?> </h3>
<?php foreach($posts as $post) :?>
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <h5 class="card-title"> <?= $post['title'] ?> </h5>
                    <p class="card-text"> <?= $post['text'] ?> </p>
                    <p> Category: <?= $categoriesMap[$post['category_id']] ?? '' ?> </p>
                    <p> <?= $post['date'] ?> </p>
                    <?= displayLinks($post['id']) ?>
                    <?= displayButtons($post['id']) ?>
                </div>
            </div>
<?php endforeach; ?>

<nav aria-label="Page navigation">
    <ul class="pagination">
        <?= displayPagination($categoryId)?>
    </ul>
</nav>
