<?php
require __DIR__ . '/../config/database.php';

if (isset($_POST['submit'])) {
    // get updated form data
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    // check for valid input
    if (!$firstname || !$lastname) {
        $_SESSION['edit-user'] = "Formato inválido";
    } else {
        // update user
        $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', is_admin=$is_admin WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Fallo al actualizar el usuario";
        } else {
            $_SESSION['edit-user-success'] = "Usuario actualizado éxitosamente";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();
