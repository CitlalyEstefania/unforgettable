<?php 
require 'config/database.php';

if (isset($_POST['canvasBlob'])){
    $base64data = $_POST['canvasBlob'];
    
    if (empty($base64data)) {
        $_SESSION['change-image'] = "No se ha podido cambiar la imagen";
    } elseif(!preg_match('#^data:image/\w+;base64#i', $base64data)) {
        $_SESSION['change-image'] = "No se pudo leer la imagen proporcionada";
    } else {
        $avatar = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64data));
        if ($avatar === false){
            $_SESSION['change-image'] = "No se puedo convertir la imagen al formato correcto";
        } else {

            $filename = uniqid() . '.jpg';
            $filepath = 'images/' . $filename;

            if (file_put_contents($filepath, $avatar) === false){
                $_SESSION['change-image'] = "No se pudo guardar la imagen";
            } else {
                $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
                if (strlen(base64_decode($avatar)) < 1000000) {
                    $avatar_update = "UPDATE users SET avatar='$filename' WHERE id=$id LIMIT 1";
                    $avatar_result = mysqli_query($connection, $avatar_update);

                    if (mysqli_errno($connection)) {
                        $_SESSION['change-image'] = "Hubo un problema al cambiar la imagen";
                    } else {
                        $_SESSION['change-image-success'] = "Imagen cambiada éxitosamente";
                    }
                } else {
                    $_SESSION['change-image'] = "Archivo demasiado grande";
                }
            }
        }
    }
} else {
    $_SESSION['change-image'] = "Hubo un error con el servidor, intente de nuevo más tarde";
}

header('location: ' . ROOT_URL . 'profile.php');
die();
?>