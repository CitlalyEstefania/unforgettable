<?php
include 'partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
    die();
}
?>
<form action="<?= ROOT_URL ?>admin/edit-user-logic.php?id=<?= $id ?>" method="POST">



<section class="form__section">
    <div class="margin-form__section-container top"></div>
    <div class="container form__section-container">
        <h2>Editar Usuario</h2>
        <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST">
            <input type="text" value="<?= $user['firstname'] ?>" name="firstname" placeholder="Nombre">
            <input type="text" value="<?= $user['lastname'] ?>" name="lastname" placeholder="Apellido/s">
            <select name="userrole">
                <option value="0">Autor</option>
                <option value="1">Admin</option>
            </select>
            <button type="submit" name="submit" class="btn">Actualizar Usuario</button>
        </form>
    </div>
    <div class="margin-form__section-container bottom"></div>
</section>


<?php
include '../partials/footer.php';
?>