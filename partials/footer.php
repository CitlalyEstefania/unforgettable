<?php
// fetch all posts from posts table
$query = "SELECT * FROM posts ORDER BY date_time DESC";
$posts = mysqli_query($connection, $query);
?>

<footer>
    <div class="footer__socials">
        <br></br>
        <a href="https://youtube.com/@unforgettable-hd7rx" target="_blank"><i class="uil uil-youtube"></i></a>
        <a href="https://www.facebook.com/people/Unforgett4ble/100093126422532/" target="_blank"><i class="uil uil-facebook-f"></i></a>
        <a href="https://www.instagram.com/unforgettable_mx/" target="_blank"><i class="uil uil-instagram-alt"></i></a>
        <a href="https://twitter.com/unforget081020" target="_blank"><i class="uil uil-twitter"></i></a>
    </div>
    <div class="container footer__container">
   
            
            <ul>
            </ul>
              

        <article>
            <h4>Categorias</h4>
            <ul>
                <?php
                $all_categories_query = "SELECT * FROM categories";
                $all_categories = mysqli_query($connection, $all_categories_query);
                ?>
                <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
                    <li><a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>"><?= $category['title'] ?></a></li>
                <?php endwhile ?>
            </ul>
        </article>
       
            
            <ul>
             
            </ul>
      
        <article>
            <h4>Permalinks</h4>
            <ul>
                <li><a href="./blog.php">Inicio</a></li>
                <li><a href="">Blog</a></li>
                <!-- <li><a href="./about.php">Sobre Nosotros</a></li> -->
                <!-- <li><a href="./services.php">Servicios</a></li> -->
                <!-- <li><a href="./contact.php">Contacto</a></li> -->
            </ul>
        </article>
    </div>
    <div class="footer__copyright">
        <small>Equipo 4 &copy; 2023 Facultad de Ingeniería Electromecánica </small>
    </div>
</footer>

<script src="<?= ROOT_URL ?>node_modules/cropperjs/dist/cropper.min.js"></script>
<script src="<?= ROOT_URL ?>js/main.js"></script>
<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</body>

</html>