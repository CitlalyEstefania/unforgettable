<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch user from database
    $query = "SELECT checked FROM comments WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $comment = mysqli_fetch_assoc($result);

    // just an auxiliar variable
    $value = 0;

    // make sure we got back only one user
    if (mysqli_num_rows($result) == 1) {
        $comment_check_status = $comment['checked'];
        if ($comment_check_status == 0) {
            $value = 1;
        } 
    }

    // update user
    $query = "UPDATE comments SET checked='$value' WHERE id=$id LIMIT 1";
    $result = mysqli_query($connection, $query);

    if (mysqli_errno($connection)) {
        $_SESSION['checked-user'] = "Fallo al actualizar el comentario";
    } else {
        $_SESSION['checked-user-success'] = "Comentario actualizado éxitosamente";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-comment-checked.php');
die();
