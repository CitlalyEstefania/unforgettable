<?php
include 'partials/header.php';

// fetch current user's posts from database
$query = "SELECT id, title, author_id FROM posts WHERE checked=0  ORDER BY id DESC";
$posts = mysqli_query($connection, $query);
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
    <?php elseif (isset($_SESSION['checked-post-success'])) : // shows if verify user was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['checked-post-success'];
                unset($_SESSION['checked-post-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['checked-post'])) : // shows if verify user was NOT successful
    ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['checked-post'];
                unset($_SESSION['checked-post']);
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
                        <a href="manage-post-checked.php" class="active"><i class="uil uil-comment-alt-check"></i>
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
                        <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                            <h5>Administrar Usuarios</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-author.php"><i class="uil uil-create-dashboard"></i>
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
            <h2>Verificar Posts</h2>
            <?php if (mysqli_num_rows($posts) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Eliminar</th>
                            <th>Verificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                            <!-- get author title of each post from categories table -->
                            <?php
                            $author_id = $post['author_id'];
                            $author_query = "SELECT username FROM users WHERE id=$author_id";
                            $author_result = mysqli_query($connection, $author_query);
                            $author = mysqli_fetch_assoc($author_result);
                            ?>
                            <tr>
                                <h3 class="post__title">
                                    <TD><a href="<?= ROOT_URL ?>post-checked.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></TD>
                                </h3>
                                <td><?= $author['username'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="btn sm danger">Eliminar</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/check-post.php?id=<?= $post['id'] ?>" class="btn sm succes">✓</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No se encontraron posts" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>


<?php
include '../partials/footer.php';
?>