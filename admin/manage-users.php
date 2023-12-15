<?php
include 'partials/header.php';

// fetch users from database but not current user
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
$users = mysqli_query($connection, $query);
?>




<section class="dashboard">
    <?php if (isset($_SESSION['add-user-success'])) : // shows if add user was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-user-success'];
                unset($_SESSION['add-user-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-user-success'])) : // shows if edit user was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-user'])) : // shows if edit user was NOT successful
    ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-user'];
                unset($_SESSION['edit-user']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-user'])) : // shows if delete user was NOT successful
    ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['delete-user'];
                unset($_SESSION['delete-user']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-user-success'])) : // shows if delete user was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-user-success'];
                unset($_SESSION['delete-user-success']);
                ?>
            </p>
        </div>
    <?php endif ?>

    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
        <ul>
                <li>
                    <a href="add-post.php"><i class="uil uil-comment-add"></i>
                        <h5>Añadir Post</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php"><i class="uil uil-comment-alt-edit"></i>
                        <h5>Administrar Posts</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <a href="manage-all-post.php"><i class="uil uil-comment-alt-edit"></i>
                            <h5>Administrar todos Posts</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-post-checked.php"><i class="uil uil-comment-alt-check"></i>
                            <h5>Verificar Post</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-comment-checked.php"><i class="uil uil-user-plus"></i>
                            <h5>Verificar Comentarios</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-user-checked.php"><i class="uil uil-user-check"></i>
                            <h5>Verificar Usuario</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-users.php" class="active"><i class="uil uil-users-alt"></i>
                            <h5>Administrar Usuarios</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php"><i class="uil uil-create-dashboard"></i>
                            <h5>Añadir Categoría</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php"><i class="uil uil-apps"></i>
                            <h5>Administrar Categorías</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Administrar Usuarios</h2>
            <?php if (mysqli_num_rows($users) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Nombre de Usuario</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                            <tr>
                                <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Editar</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger">Eliminar</a></td>
                                <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No se encontraron usuarios" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>


<?php
include '../partials/footer.php';
?>