<?php
include 'partials/header.php';

// fetch post from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
    if (isset($_SESSION['user-id'])) {
        $current_user_id = $_SESSION['user-id'];
    } else {
        $current_user_id = 0;
    }

    // fetch comments from database
    $comments_query = "SELECT * FROM comments WHERE post_id=$id ORDER BY date_time";
    $comments_result = mysqli_query($connection, $comments_query);
    // get back form data if form was invalid
    $comment = $_SESSION['comments-data']['comment'] ?? null;
    // delete form data session
    unset($_SESSION['add-post-data']);

    // check if the user like or dislike the post
    $like_query = "SELECT * FROM likes WHERE post_id=$id AND user_id=$current_user_id";
    $like_result = mysqli_query($connection, $like_query);

    //fetch likes count
    $likes_count_query = "SELECT COUNT(*) FROM likes WHERE post_id=$id AND like_type='1'";
    $likes_count_result = mysqli_query($connection, $likes_count_query);
    $likes_count = mysqli_fetch_assoc($likes_count_result);
    $likes_count = $likes_count['COUNT(*)'];

} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>

<style>
    <?php
    if (mysqli_num_rows($like_result) > 0){
        $like = mysqli_fetch_assoc($like_result);
        if ($like['like_type'] == "1") {
            echo ".like_dislike.like { color: var(--color-gray-700); }";
        }
    }
    ?>
</style>
<section class="messages-warning-comments__container">
        <div id="comments-messages-containers">
            <?php if (isset($_SESSION['comments-success'])) : ?>
                <div class="alert__message success container alert__message-comments">
                    <p>
                        <?= $_SESSION['comments-success']; unset($_SESSION['comments-success']); ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['comments'])) : ?>
                <div class="alert__message error container alert__message-comments">
                    <p>
                        <?= $_SESSION['comments']; unset($_SESSION['comments']); ?>
                    </p>
                </div>
            <?php endif ?>
        </div>
</section>
<section class="singlepost">
    <div id="like_dislike__singlepost">
        <form action="<?= ROOT_URL ?>post-like-logic.php" method="POST">
            <div id="like_count">
                <a href="#" onclick="document.getElementById('like_btn').click(); return false;">
                    <span class="iconify like_dislike like" data-icon="uil:heart" data-width="70" data-height="70"></span>
                    <h3><?= $likes_count ?></h3>
                </a>
            </div>

            <button type="submit" id="like_btn" name="like_btn" style="display: none;">like</button>
            <input type="hidden" name="id_post" value="<?= $id ?>">
        </form>
    </div>
    <div class="singlepost__container">
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
        <div class="singlepost__thumbnail">
            <img src="./images/<?= $post['thumbnail'] ?>">
        </div>
        <p>
            <?= $post['body'] ?>
        </p>
    </div>
</section>

<!--====================== END OF SINGLE POST ====================-->
<section>
    <div class="container singlepost__container-comments" id="comments-container">
        <h2>Comentarios</h2>
        <form action="<?= ROOT_URL ?>post-comment-logic.php" method="POST">
            <textarea name="comment" cols="30" rows="10" placeholder="Comenta algo acerca de este post!"><?= $comment ?></textarea>
            <button type="submit" name="submit" class="btn">Comentar</button>
            
            <input type="hidden" name="id_post" value="<?= $id ?>">
        </form>
        <?php if (mysqli_num_rows($comments_result) > 0): ?>
            <?php while ($comments = mysqli_fetch_assoc($comments_result)) : ?>
                <div class="singlecomment__container">
                    <div>
                        <?php
                        // fetch author from users table using author_id
                        $author_id_comment = $comments['author_id'];
                        $author_query_comment = "SELECT * FROM users WHERE id=$author_id_comment";
                        $author_result_comment = mysqli_query($connection, $author_query_comment);
                        $author_comment = mysqli_fetch_assoc($author_result_comment);

                        //Initialize the edit mode to false/zero
                        // $edit_mode = 0;
                        ?>
                        <div class="post__author-avatar">
                            <img src="./images/<?= $author_comment['avatar'] ?>">
                        </div>
                    </div>
                    <div class="comment__author-container">
                        <div class="comment__author">
                            <div class="post__author-info">
                                <h5>By: <?= "{$author_comment['firstname']} {$author_comment['lastname']}" ?></h5>
                                <small>
                                    <?= date("M d, Y - H:i", strtotime($comments['date_time'])) ?>
                                </small>
                            </div>
                            <div id="comment_body__form_edit-mode" data-edit="<?= $edit_mode . ',' . $comments['id']?>">
                                <p><?= $comments['body']?></p>
                                <!-- <form action="<?= ROOT_URL ?>post-comment-logic.php" method="POST">
                                    <textarea name="comment" cols="30" rows="10" placeholder="Errores? Aun puedes editarlos!"><?= $comments['body'] ?></textarea>
                                    <div class="singlecomment__container-container_btns">
                                        <button class="btn danger sm" name="submit" type="submit">cancelar</button>
                                        <button class="btn sm" name="editar" type="button">confirmar</button>
                                    </div>
                                    
                                    <input type="hidden" name="edit_mode" value="<?= $edit_mode ?>">
                                    <input type="hidden" name="id_post" value="<?= $id ?>">
                                </form> -->
                            </div>
                        </div> 
                        <?php if ($current_user_id != 0): ?>
                            <?php if ($current_user_id == $author_id_comment): ?>
                                <form action="<?= ROOT_URL ?>post-delete_comment-logic.php" method="POST" id="comment-form_EditDelete">
                                    <div class="singlecomment__container-container_btns">
                                        <!-- <button class="btn sm" name="editar" type="button" id="btn-editMode_Ini">editar</button> -->
                                        <button class="btn danger sm" name="submit" type="submit">eliminar</button>
                                        <input type="hidden" name="id" value="<?= $comments['id'] ?>">
                                        <input type="hidden" name="id_post" value="<?= $id ?>">
                                    </div>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div id="container-without-comments">
                <h3>Se el primero en comentar.</h3>
            </div>
        <?php endif; ?>
    </div>
</section>




<?php
include 'partials/footer.php';

?>