<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $postId = $_POST['id_post'];
    $query = "DELETE FROM comments WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if($result){
        $_SESSION['comments-success'] = "El comentario se ha eliminado";
    }else{
        $_SESSION['comments'] = "No se pudo realizar la acción, intente de nuevo más tarde";
    }
}

header('location: ' . ROOT_URL . 'post.php?id=' . $postId);
die();
?>