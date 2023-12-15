<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch user from database
    $query = "SELECT * FROM comments WHERE id=$id";
    $result = mysqli_query($connection, $query);

    // make sure we got back only one user
    if (mysqli_num_rows($result) == 1) {
        $comment = mysqli_fetch_assoc($result);
        $comment_id = $comment['id'];
        $delete_comment_query = "DELETE FROM comments WHERE id=$id";
        $delete_comment_result = mysqli_query($connection, $delete_comment_query);
        if (mysqli_errno($connection)) {
            $_SESSION['checked-comment'] = "No se pudo eliminar el comentario";
        } else {
            $_SESSION['checked-comment-succcess'] = "Comentario eliminado éxitosamente";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-comment-checked.php');
die();
