<?php
require __DIR__ . '/../config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch user from database
    $query = "SELECT checked FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);

    // just an auxiliar variable
    $value = 0;

    // make sure we got back only one user
    if (mysqli_num_rows($result) == 1) {
        $post_check_status = $post['checked'];
        if ($post_check_status == 0) {
            $value = 1;
        } 
    }

    // update user
    $query = "UPDATE posts SET checked='$value' WHERE id=$id LIMIT 1";
    $result = mysqli_query($connection, $query);

    if (mysqli_errno($connection)) {
        $_SESSION['checked-post'] = "Fallo al verificar el post";
    } else {
        $_SESSION['checked-post-success'] = "Post verificado éxitosamente";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-post-checked.php');
die();
