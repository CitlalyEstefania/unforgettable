<?php include 'partials/header.php'; 
if (isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $result = mysqli_fetch_assoc($result);

    $query2 = "SELECT * FROM posts WHERE author_id=$id ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query2);

    $flag = 1;
    if (mysqli_num_rows($posts) > 0) {
        $flag = 1;
    } else {
        $flag = 0;
    }

    // get the post data back if post wasn't successful
    $user_name = $_SESSION['profile-data']['username'] ?? null;
    $user_firstname = $_SESSION['profile-data']['firstname'] ?? null;
    $user_lastname = $_SESSION['profile-data']['lastname'] ?? null;
    $flagForm = $_SESSION['profile-data']['flag-form'] ?? "mode0";

    unset($_SESSION['profile-data']);
} else {
    header('Location: ' . ROOT_URL . 'signin.php');
} ?>

<style>
    .cropper-view-box, .cropper-point, .cropper-line{ /* Cambio de color del (de azul a rosa) Cuadro de recorte proporcionado por CroppperJs*/
        outline-color: rgb(202, 161, 195);
    }

    .cropper-point, .cropper-line{ /* Cambio de color de los puntos ylineas del cuadro de recorte proporcionado por CroppperJs*/
        background: rgb(202, 161, 195);
    }
</style>
<section id="profile">
    <div id="profile-messages-containers">
        <?php if (isset($_SESSION['change-image-success'])) : ?>
            <div class="alert__message success container alert__message-profile">
                <p>
                    <?= $_SESSION['change-image-success']; unset($_SESSION['change-image-success']); ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['change-image'])) : ?>
            <div class="alert__message error container alert__message-profile">
                <p>
                    <?= $_SESSION['change-image']; unset($_SESSION['change-image']); ?>
                </p>
            </div>
        <?php endif ?>
    </div>
    <div id="image-section">
        <div id="img-profile-img">
            <img src="<?= ROOT_URL . 'images/' . $result['avatar'] ?>" alt="Tu perfil" id="img-profile">
            <span id="edit-image">Editar Imagen</span>
        </div>
        <h1><?= $result['username']?></h1>
    </div>
    <div id="container-sections">
        <ul id="container-section-list">
            <li><h1 id="list-info-section">PERFIL</h1></li>
            <li><h1 id="list-post-section">POSTS</h1></li>
        </ul>
        <div id="info-section">
            <div class="info-section_labels info-section_values">
                <div class="info-section_labels info-section_values">
                    <div id="info-section_labels">
                        <h2>Usuario</h2>
                        <h2>Nombre</h2>
                        <h2>Apellido/s</h2>
                        <h2>Email</h2>
                    </div>
                    <div>
                        <h2><?= $result['username'] ?></h2>
                        <h2><?= $result['firstname'] ?></h2>
                        <h2><?= $result['lastname'] ?></h2>
                        <h2 id="filtered-email" data-email="<?= $result['email']?>"></h2>
                        <button class="btn" id="info-section_edit-btn">Editar</button>
                    </div>
                </div>
                <div id="info-section_form">
                    <form action="<?= ROOT_URL ?>profile-editUser-logic.php" method="POST">
                    <input type="text" name="username" value="<?= $user_name ?>" placeholder="Nombre de Usuario">
                        <input type="text" name="firstname" value="<?= $user_firstname ?>" placeholder="Nombre">
                        <input type="text" name="lastname" value="<?= $user_lastname ?>" placeholder="Apellido/s">
                        <input type="hidden" name="flag-form" id="info-section_form-modes" value="<?= $flagForm ?>">
                        <div class="info-section_form-btns">
                            <button class="btn" id="btn-cancel_form_edit_profile">Cancelar</button>
                            <button type="submit" name="submit" class="btn success">Guardar</button>
                        </div>
                    </form>
                </div>
                <div id="info-section_form-popUp">
                    <table>
                        <tr style="height: 10px;">
                            <th></th>
                            <th>Ingrese su contraseña</th>
                        </tr>
                        <tr>
                            <th style="width: 10px"></th>
                            <th>
                                <form action="<?= ROOT_URL ?>profile-editUserM2-logic.php"  method="POST">
                                    <input type="hidden" name="username" value="<?= $user_name ?>">
                                    <input type="hidden" name="firstname" value="<?= $user_firstname ?>">
                                    <input type="hidden" name="lastname" value="<?= $user_lastname ?>">

                                    <input type="password" name="password" placeholder="Contraseña">
                                    <input type="password" name="confirmpassword" placeholder="Confirmar Contraseña">
                                    <h5><a href="forgot.php">¿Olvidaste tu contraseña?</a></h5>
                                    <div class="info-section_form-btns">
                                        <button type="button" class="btn" id="btn-cancel_form_edit-popUp_profile">Cancelar</button>
                                        <button type="submit" name="submit" class="btn success">Confirmar</button>
                                    </div>
                                </form>
                            </th>
                            <th style="width: 10px"></th>
                        </tr>
                        <tr style="height: 10px;"></tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="post-section-flag" data-flag="<?= $flag?>">
            <div id="post-section">
                <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                    <article class="post">
                        <div class="post__thumbnail">
                            <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>">
                                <img src="./images/<?= $post['thumbnail'] ?>">
                            </a>
                        </div>
                        <div>
                            <h3 class="post__title">
                                <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                            </h3>
                            <p class="post__body">
                                <?= substr($post['body'], 0, 150) ?>...
                            </p>
                        </div>
                    </article>
                <?php endwhile ?>
            </div>
            <div id="post-section-warning">
                <h1>No se encontró ningun post</h1>
                <h3>¿No ha hecho ninguno? <a style="color: #005191;" href="admin/add-post.php"> Haga uno aquí</a></h3>
            </div>
        </div>
    </div>
    <div id="overlay2"></div>
    <div id="edit-image-popUp">
        <table>
            <tbody>
                <tr>
                    <th></th>
                    <th style="height: 10px;">
                        <h3 class= sm__profile>Recortar Imagen</h3>
                    </th>
                </tr>
                <tr>
                    <th style="width: 10px;"></th>
                    <th>
                        <div id="crop-image-container" style="width: 350px; height: 300px;">
                            <img src="<?= ROOT_URL . 'images/' . $result['avatar'] ?>" alt="Tu perfil" class="crop-image img">
                        </div>
                    </th>
                    <th>
                        <div>
                            <div class="table-popUp2">
                                <input type="image" src="https://api.iconify.design/uil/image-redo.svg?width=50&height=50" alt="regresar imagen anterior" id="restore-profile">
                                <label for="restore-profile" class="sm__profile">Reiniciar Recorte</label>
                            </div>
                            <form action="<?= ROOT_URL ?>profile-editImage-logic.php" method="POST" enctype="multipart/form-data" name="form-crop-image" id="form-crop-image">
                                <div class="table-popUp2">
                                    <input type="image" src="https://api.iconify.design/uil/image-upload.svg?width=50&height=50" alt="subir imagen nueva" name="input-profile-image" id="input-profile-image">
                                    <label for="input-profile-image" class="sm__profile">Subir Imagen</label>

                                    <input type="file" name="input-profile-file" id="input-profile-file" style="display: none;">
                                    <input type="hidden" name="canvasBlob" id="canvasBlob">
                                </div>
                            </form>
                        </div>
                    </th>
                </tr>
                <tr><th style="height: 10px;"></th></tr>
                <tr>
                    <th></th>
                    <th>
                        <div id="table-popUp3">
                            <button class="btn" id="close-popUp">Cancelar</button>
                        </div>
                    </th>
                    <th>
                        <div id="table-popUp4">
                            <button type="submit" class="btn success" id="btn-submit-showed">Guardar</button>
                        </div>
                    </th>
                </tr>
                <tr><th style="height: 10px;"></th></tr>
            </tbody>
        </table>
    </div>
    <div id="overlay"></div>
</section>

<?php
include './partials/footer.php';
?>


