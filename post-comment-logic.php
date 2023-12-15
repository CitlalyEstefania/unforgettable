<?php
require 'config/database.php';

if (isset($_POST['submit'])){
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $author_id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $post_id = filter_var($_POST['id_post'], FILTER_SANITIZE_NUMBER_INT);

    // validate form data
    if (!$comment) {
        $_SESSION['comments'] = "Ingresa un comentario";
        header('location: ' . ROOT_URL . 'post.php?id=' . $post_id);
        die();
    } else {
        $id_users = "SELECT * FROM users WHERE id='$author_id'";
        $id_users_result = mysqli_query($connection, $id_users);

        if (mysqli_num_rows($id_users_result) === 0) {
            $_SESSION['comments'] = "Inicia sesion para comentar";
            header('location: ' . ROOT_URL . 'post.php?id=' . $post_id);
            die();
        }
        // insert comment into database
        $insert_comment_query = "INSERT INTO comments (body, post_id,author_id) VALUES ('$comment', '$post_id','$author_id')";
        $insert_comment_result = mysqli_query($connection, $insert_comment_query);

        // redirect back to add-comment page if there is any problem
        if (!$insert_comment_result) {
            $_SESSION['comments'] = "Hubo un error al agregar el comentario";
            $_SESSION['comments-data'] = $_POST;
            header('location: ' . ROOT_URL . 'post.php?id=' . $post_id);
            die();
        }
    }
}

header('location: ' . ROOT_URL . 'post.php?id=' . $post_id);
die();