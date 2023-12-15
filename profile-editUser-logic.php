<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    $user = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $flag = filter_var($_POST['flag-form'], FILTER_SANITIZE_STRING);



    //validate input values
    if(empty($user) || empty($firstname) || empty($lastname)){
        $_SESSION['profile-data'] = $_POST;
        $_SESSION['profile-data']['flag-form'] = "mode1";
        $_SESSION['change-image'] = "Complete todos los campos para continuar" . $firstname . $lastname;
        header('location: ' . ROOT_URL . 'profile.php');
        die();
    } else {
        $user_check_query = "SELECT * FROM users WHERE username='$user' AND id <> {$_SESSION['user-id']}";
        $result = mysqli_query($connection, $user_check_query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['profile-data'] = $_POST;
            $_SESSION['profile-data']['flag-form'] = "mode1";
            $_SESSION['change-image'] = "El nombre de usuario ya existe";
            header('location: ' . ROOT_URL . 'profile.php');
            die();
        }

        $_SESSION['profile-data'] = $_POST;
        $_SESSION['profile-data']['flag-form'] = "mode2";
        $_SESSION['change-image-success'] = "Ingrese su contraseña para confirmar los cambios";
        header('location: ' . ROOT_URL . 'profile.php');
        die();
    }
} else {
    $_SESSION['change-image'] = "Hubo un error con el servidor, intente de nuevo más tarde";
    header('location: ' . ROOT_URL . 'profile.php');
    die();
}
?>