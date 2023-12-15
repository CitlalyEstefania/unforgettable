<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch user from database
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // make sure we got back only one user  CHECK USER EXISTENCE    
    if (mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;
        // delete image if available
        if ($avatar_path) {
            unlink($avatar_path);
        }
    } else {
        $_SESSION['delete-user'] = "No se pudo eliminar '{$user['firstname']} '{$user['lastname']}', no se encontro usuario";
        header('location: ' . ROOT_URL . 'admin/manage-users.php');
        die();
    }

    // FOR LATER
    // fetch all thumbnails of user's posts and delete them 
    $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
    $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    if (mysqli_num_rows($thumbnails_result) > 0) {
        while ($thumbnail = mysqli_fetch_assoc($thumbnails_result)) {
            $thumbnail_path = '../images/' . $thumbnail['thumbnail'];
            // delete thumbnail from images folder is exist
            if ($thumbnail_path) {
                unlink($thumbnail_path);
            }
        }
    }
    $delete_posts_query = "DELETE FROM posts WHERE author_id=$id";
    $delete_posts_result = mysqli_query($connection, $delete_posts_query);
    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "No se pudo eliminar los posts de '{$user['firstname']} '{$user['lastname']}'";
    } else {
        $_SESSION['delete-user-success'] = "Posts de {$user['firstname']} {$user['lastname']} eliminados éxitosamente";
    }

    // delete user's comments from database
    $delete_comments_query = "DELETE FROM comments WHERE author_id=$id";
    $delete_comments_result = mysqli_query($connection, $delete_comments_query);
    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "No se pudo eliminar los comentarios de '{$user['firstname']} '{$user['lastname']}'";
    } else {
        $_SESSION['delete-user-success'] = "Comentarios de {$user['firstname']} {$user['lastname']} eliminados éxitosamente";
    }

    // delete user's likes from database
    $delete_likes_query = "DELETE FROM likes WHERE user_id=$id";
    $delete_likes_result = mysqli_query($connection, $delete_likes_query);
    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "No se pudo eliminar los likes de '{$user['firstname']} '{$user['lastname']}'";
    } else {
        $_SESSION['delete-user-success'] = "Likes de {$user['firstname']} {$user['lastname']} eliminados éxitosamente";
    }

    // delete user from database
    $delete_user_query = "DELETE FROM users WHERE id=$id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);
    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "No se pudo eliminar '{$user['firstname']} '{$user['lastname']}'";
    } else {
        $_SESSION['delete-user-success'] = "{$user['firstname']} {$user['lastname']} eliminado éxitosamente";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();
