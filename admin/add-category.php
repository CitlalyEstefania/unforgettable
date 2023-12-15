<?php
include 'partials/header.php';

// get back form data if invalid
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

unset($_SESSION['add-category-data']);
?>

<section class="form__section">
    <div class="margin-form__section-container top"></div>
    <image class="form__section-container-image" src="<?= ROOT_URL ?>img_backgrounds/urban_background_addCategory.jpg" alt="backgroudn image"></image>
    <div class="container form__section-container">
        <h2 style="color: white;">Agregar Categoría</h2>
        <?php if (isset($_SESSION['add-category'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']) ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
            <input type="text" value="<?= $title ?>" name="title" placeholder="Título">
            <textarea rows="4" value="<?= $description ?>" name="description" placeholder="Descripción"></textarea>
            <button type="submit" name="submit" class="btn">Añadir</button>
        </form>
    </div>
    <div class="margin-form__section-container bottom"></div>
</section>
