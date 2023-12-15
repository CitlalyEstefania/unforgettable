<?php 


$error = array();

require "mail.php";

    require 'config/database.php';
	$mode = "enter_email";
	if(isset($_GET['mode'])){
		$mode = $_GET['mode'];
	}

	//something is posted
	if(count($_POST) > 0){

		switch ($mode) {
			case 'enter_email':
				$email = $_POST['email'];
				//valida email
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error[] = "Favor de ingresar un correo válido";
				}elseif(!valid_email($email)){
					$error[] = "Favor de ingresar un correo existente";
				}else{

					$_SESSION['forgot']['email'] = $email;
					send_email($email);
					header("Location: forgot.php?mode=enter_code");
					die;
				}
				break;

			case 'enter_code':
				// code...
				$code = $_POST['code'];
				$result = is_code_correct($code);

				if($result == "El código es correcto"){

					$_SESSION['forgot']['code'] = $code;
					header("Location: forgot.php?mode=enter_password");
					die;
				}else{
					$error[] = $result;
				}
				break;

			case 'enter_password':
				// code...
				$password = $_POST['password'];
				$password2 = $_POST['password2'];

				if($password !== $password2){
					$error[] = "Las contraseñas no coinciden";
				}elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
					header("Location: forgot.php");
					die;
				}else{
					
					save_password($password);
					if(isset($_SESSION['forgot'])){
						unset($_SESSION['forgot']);
					}

					header("Location: signin.php");
					die;
				}
				break;
			
			default:
				// code...
				break;
		}
	}

	function send_email($email){
		
		global $connection, $email;

		$expire = time() + (60 * 1);
		$code = rand(10000,99999);
		$email = addslashes($email);

		$query = "insert into codes (email,code,expire) value ('$email','$code','$expire')";
		mysqli_query($connection,$query);

		//send email here
		send_mail($email,"Password Reset","Tú código es " . $code);
	}
	
	function save_password($password){
		
		global $connection;

		$password = password_hash($password, PASSWORD_DEFAULT);
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "update users set password = '$password' where email = '$email' limit 1";
		mysqli_query($connection,$query);

	}
	
	function valid_email($email){
		global $connection;

		$email = addslashes($email);

		$query = "select * from users where email = '$email' limit 1";		
		$result = mysqli_query($connection,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				return true;
 			}
		}

		return false;

	}

	function is_code_correct($code){
		global $connection;

		$code = addslashes($code);
		$expire = time();
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
		$result = mysqli_query($connection,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_assoc($result);
				if($row['expire'] > $expire){

					return "El código es correcto";
				}else{
					return "El código ha expirado";
				}
			}else{
				return "El código es incorrecto";
			}
		}

		return "El código es incorrecto";
	}

	
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>unforgettable</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>

<body>
	<nav>
        <div class="container nav__container">
            <a href="<?= ROOT_URL ?>" class="nav__logo">unforgettable</a>

            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
<?php 

	switch ($mode) {
		case 'enter_email':
			?>
                <section class="form__section">
					<div class="margin-form__section-container top"></div>
					<image class="form__section-container-image" src="<?= ROOT_URL ?>img_backgrounds/desert_background_forgot.jpg" alt="backgroudn image"></image>
					<div class="container form__section-container">
				    	<h2>Restablecer Contraseña</h2>
						<form method="post" action="forgot.php?mode=enter_email"> 
				    		<h4>Ingresa tu correo aquí</h4>
				    		<span style="font-size: 15px;color:var(--color-red-light);font-weight: bold;">
				    		<?php 
				    			foreach ($error as $err) {
				    				echo $err . "<br>";
				    			}
				    		?>
				    		</span>
				    		<input class="textbox" type="email" name="email" placeholder="Email"><br>
				    		<br style="clear: both;">
				    		<input type="submit" value="Siguiente">
				    		<br><br>
				    		<h5><a href="signin.php">Regresar</a></h5>
				    	</form>
					</div>
					<div class="margin-form__section-container bottom"></div>
                </section>
			<?php				
			break;
			
		case 'enter_code':
			?>
				<section class="form__section">
					<div class="margin-form__section-container top"></div>
					<image class="form__section-container-image" src="<?= ROOT_URL ?>img_backgrounds/desert_background_forgot.jpg" alt="backgroudn image"></image>
					<div class="container form__section-container">
				    	<h2>Restablecer Contraseña</h2>
						<form method="post" action="forgot.php?mode=enter_code"> 
							<h3>Ingresa el código que enviamos a tu correo</h3>
							<span style="font-size: 12px;color:var(--color-red-light);font-weight: bold;">
							<?php 
								foreach ($error as $err) {
									echo $err . "<br>";
								}
							?>
							</span>
							<input class="textbox" type="text" name="code" placeholder="12345"><br>
							<br style="clear: both;">
							<input type="submit" value="Sigiente" style="float: right;">
							<a href="forgot.php">
								<input type="button" value="Volver al paso 1">
							</a>
							<br><br>
							<div><a href="signin.php">Cancelar operación</a></div>
						</form>
					</div>
					<div class="margin-form__section-container bottom"></div>
				</section>
			<?php
			break;

		case 'enter_password':
			?>
				<section class="form__section">
					<div class="margin-form__section-container top"></div>
					<image class="form__section-container-image" src="<?= ROOT_URL ?>img_backgrounds/desert_background_forgot.jpg" alt="backgroudn image"></image>
					<div class="container form__section-container">
				    	<h2>Restablecer Contraseña</h2>
						<form method="post" action="forgot.php?mode=enter_password"> 
							<h3>Ingresa tu contraseña nueva</h3>
							<span style="font-size: 12px;color:var(--color-red-light);font-weight: bold;">
							<?php 
								foreach ($error as $err) {
									echo $err . "<br>";
								}
							?>
							</span>
							<input class="textbox" type="password" name="password" placeholder="Password"><br>
							<input class="textbox" type="password" name="password2" placeholder="Retype Password"><br>
							<br style="clear: both;">
							<input type="submit" value="Siguiente" style="float: right;">
							<a href="forgot.php">
								<input type="button" value="Volver al paso 1">
							</a>
							<br><br>
							<div><a href="signin.php">Cancelar operación</a></div>
						</form>
					</div>
					<div class="margin-form__section-container bottom"></div>
				</section>
		<?php
			break;
					
				default:
					break;
			}

		?>


</body>
</html>