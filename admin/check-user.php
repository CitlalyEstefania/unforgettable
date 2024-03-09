<?php
require __DIR__ . '/../config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch user from database
    $query = "SELECT checked FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // just an auxiliar variable
    $value = 0;

    // make sure we got back only one user
    if (mysqli_num_rows($result) == 1) {
        $user_check_status = $user['checked'];
        if ($user_check_status == 0) {
            $value = 1;
        } 
    }

    // update user
    $query = "UPDATE users SET checked='$value' WHERE id=$id LIMIT 1";
    $result = mysqli_query($connection, $query);

    if (mysqli_errno($connection)) {
        $_SESSION['checked-user'] = "Fallo al actualizar el usuario";
    } else {
        $_SESSION['checked-user-success'] = "Usuario actualizado éxitosamente";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-user-checked.php');
die();
