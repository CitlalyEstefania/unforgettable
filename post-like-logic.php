<?php
require 'config/database.php';

// $like_dislike;

if(isset($_POST['like_btn'])) {
    $like_dislike = "1";
    $post_id = filter_var($_POST['id_post'], FILTER_SANITIZE_NUMBER_INT);
    $author_id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);

    $author_check = "SELECT * FROM users WHERE id='$author_id'";
    $author_result = mysqli_query($connection, $author_check);
    if(mysqli_num_rows($author_result) === 0) {
        $_SESSION['comments'] = "Inicia sesion para dar 'me gusta' o 'no me gusta' a la publicacion";
        header('location: ' . ROOT_URL . 'post.php?id=' . $post_id);
        die();
    }

    $query = "SELECT * FROM likes WHERE post_id=$post_id AND user_id=$author_id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0){
        $like = mysqli_fetch_assoc($result);
        if ($like['like_type'] == "1") {
            $like_dislike = "2";
            $like_query = "INSERT INTO likes (post_id, user_id, like_type) VALUES ('$post_id', '$author_id', '$like_dislike') ON DUPLICATE KEY UPDATE like_type= VALUES(like_type)";
            $like_result = mysqli_query($connection, $like_query);
            if (!$like_result) {
                $_SESSION['comments'] = "Hubo un error, intentelo mas tarde";
                header('location: ' . ROOT_URL . 'post.php?id=' . $post);
                die();
            }
        } else {
            $like_query = "INSERT INTO likes (post_id, user_id, like_type) VALUES ('$post_id', '$author_id', '$like_dislike') ON DUPLICATE KEY UPDATE like_type= VALUES(like_type)";
            $like_result = mysqli_query($connection, $like_query);
            if (!$like_result) {
                $_SESSION['comments'] = "Hubo un error, intentelo mas tarde";
                header('location: ' . ROOT_URL . 'post.php?id=' . $post_id);
                die();
            }
        }
    } else {
        $like_query = "INSERT INTO likes (post_id, user_id, like_type) VALUES ('$post_id', '$author_id', '$like_dislike') ON DUPLICATE KEY UPDATE like_type= VALUES(like_type)";
        $like_result = mysqli_query($connection, $like_query);
        if (!$like_result) {
            $_SESSION['comments'] = "Hubo un error, intentelo mas tarde";
            header('location: ' . ROOT_URL . 'post.php?id=' . $post_id);
            die();
        }
    }

    
}

header('location: ' . ROOT_URL . 'post.php?id=' . $post_id);
die();