<?php
include 'partials/header.php';

// fetch post from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>                                                                

<!--====================== START OF SINGLE POST ====================-->
<section class="singlepost">
    <div class="container singlepost__container" style="margin: 8rem 0 0 0;">
        <h2><?= $post['title'] ?></h2>
        <div class="post__author">
            <?php
            // fetch author from users table using author_id
            $author_id = $post['author_id'];
            $author_query = "SELECT * FROM users WHERE id=$author_id";
            $author_result = mysqli_query($connection, $author_query);
            $author = mysqli_fetch_assoc($author_result);

            ?>
            <div class="post__author-avatar">
                <img src="./images/<?= $author['avatar'] ?>">
            </div>
            <div class="post__author-info">
                <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                <small>
                    <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                </small>
            </div>
        </div>
        <div class="post__singlechecked">
            <div class="post__singlechecked-buttonBack">
                <a href="admin/manage-post-checked.php" class="btn btn__primary">🡰</a>
                <label for="">Regresar</label>
            </div>
            <div class="post__singlechecked-image">
                <img src="./images/<?= $post['thumbnail'] ?>">
            </div>
            <div class="post__singlechecked-buttonChecked">
                <a href="<?= ROOT_URL ?>admin/check-post.php?id=<?= $post['id'] ?>" class="btn">✔</a>
                <label for="">Verificar</label>
            </div>
        </div>
        <p>
            <?= $post['body'] ?>
        </p>
    </div>
</section>



<?php
include 'partials/footer.php';

?>