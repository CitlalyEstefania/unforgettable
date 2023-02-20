<?php include("template/superior.php"); ?>

<?php 

include("admin/config/bd.php");

$sentenciaSQL=$conexion->prepare("SELECT * FROM publi");
$sentenciaSQL->execute();
$listapubli=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="jumbotron">
    <h1 class="display-3">Publicaciones</h1>
    <hr class="my-2">
    <br/>
</div>


<?php foreach($listapubli as $publi) { ?>
<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="./img/<?php echo $publi['imagen']; ?>"  alt="">
        <div class="card-body">
            <h4 class="card-title"><?php echo $publi['titulo']; ?></h4>
            <a name="" id="" class="btn btn-primary" href="#" role="button"> Ver más</a>
        </div>
    </div>
    <br/>
</div>
<?php } ?>


<?php include("template/inferior.php"); ?>