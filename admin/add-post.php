<?php
include '../partials/header.php';

// fetch categories from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

// get back form data if form was invalid
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;

// delete form data session
unset($_SESSION['add-post-data']);

$query2 = "SELECT * FROM users WHERE id = {$_SESSION['user-id']}";
$result = mysqli_query($connection, $query2);

$user = mysqli_fetch_assoc($result);
$user_status = $user['checked'];
?>

<?php if ($user_status == 1) : ?>
    <section class="form__section">
        <div class="margin-form__section-container top"></div>
        <image class="form__section-container-image" src="<?= ROOT_URL ?>img_backgrounds/space_background_addPost.jpg" alt="backgroudn image"></image>
        <div class="container form__section-container">
            <h2>Agregar Post</h2>
            <?php if (isset($_SESSION['add-post'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-post'];
                        unset($_SESSION['add-post']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="title" value="<?= $title ?>" placeholder="Título">
                <select name="category">
                    <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                        <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                    <?php endwhile ?>
                </select>
                <textarea rows="10" name="body" placeholder="Cuerpo"><?= $body ?></textarea>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <div class="form__control inline">
                        <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                        <label for="is_featured">Recomendados</label>
                    </div>
                <?php endif ?>
                <div class="form__control">
                    <label for="thumbnail">Agregar Imagen</label>
                    <input type="file" name="thumbnail" id="miniatura">
                </div>
                <button type="submit" name="submit" class="btn">Añadir</button>
            </form>
        </div>
        <div class="margin-form__section-container bottom"></div>
    </section>
<?php else : ?>
    <section class="empty__page">
        <h1>El usuario aun no ha sido verificado</h1>
        <p>Mientras espera cheque nuestros post mas recientes.<a href="../blog.php"> Ver</a></p>
    </section>
<?php endif ?>


<?php
include '../partials/footer.php';
?>
