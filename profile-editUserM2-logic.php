<?php
require __DIR__ . '/../config/database.php';

if(isset($_POST['submit'])){
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm_pass = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $user = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firtsname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $_post_array = array(
        'username' => $user,
        'firstname' => $firtsname,
        'lastname' => $lastname,
        'flag-form' => "mode2"
    );
    if (empty($pass) || empty($confirm_pass)) {
        $_SESSION['profile-data'] = $_post_array;
        $_SESSION['change-image'] = "Complete todos los campos para continuar";
        header('location: ' . ROOT_URL . 'profile.php');
        die();
    } elseif ($pass != $confirm_pass) {
        $_SESSION['profile-data'] = $_post_array;
        $_SESSION['change-image'] = "Las contraseñas no coinciden";
        header('location: ' . ROOT_URL . 'profile.php');
        die();
    } else {

        $query_user = "SELECT * FROM users WHERE id='$id'";
        $result_user = mysqli_query($connection, $query_user);
        $user_record = mysqli_fetch_assoc($result_user);
        $db_password = $user_record['password'];

        if (password_verify($pass, $db_password)) {

            $query_update = "UPDATE users SET username='$user', firstname='$firtsname', lastname='$lastname' WHERE id='$id'";
            $result_update = mysqli_query($connection, $query_update);
            if ($result_update) {
                $_SESSION['change-image-success'] = "Cambios realizados con éxito" . $lastname . $firtsname;
                header('location: ' . ROOT_URL . 'profile.php');
                die();
            } else {
                $_SESSION['change-image'] = "Hubo un error con el servidor, intente de nuevo más tarde";
                header('location: ' . ROOT_URL . 'profile.php');
                die();
            }
        } else {
            $_SESSION['profile-data'] = $_post_array;
            $_SESSION['change-image'] = "Contraseña Incorrecta";
            header('location: ' . ROOT_URL . 'profile.php');
            die();
        }

    }
} else {
    $_SESSION['change-image'] = "Hubo un error con el servidor, intente de nuevo más tarde";
    header('location: ' . ROOT_URL . 'profile.php');
    die();
}
?>
