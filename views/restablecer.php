<?php 
	$token = $_GET['token'];
  $idusuario = $_GET['idusuario'];
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion.php";

	$sql = "SELECT pe.idusuario FROM reseteopass r, usuario pe, persona p WHERE (r.token = '$token')AND(pe.idusuario=r.idusuario)AND(pe.idpersona=p.idpersona)";
	$resultado = ejecutarConsulta($sql);
	if( $resultado->num_rows > 0 ){
        $usuario = $resultado->fetch_assoc();
        require_once "../controller/seguridad.php";
        $seguridad=new seguridad();
        $descifrado=$seguridad->stringEncryption('decrypt', $idusuario);
		if( $usuario['idusuario'] == $descifrado ){
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="theme-color" content="#ffffff">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

	<!-- Theme style -->
  <link href="../public/plugins/sweetAlert2/css/sweetalert2.min.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .swal2-container {
        zoom: 1.5;
      }
    </style>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      	<div class="login-logo">
        	<a href="../../index.html"><b>Gutyestore</b></a>
      	</div><!-- /.login-logo -->
      	<div class="login-box-body">
          <form id="frmRestablecer" name="frmRestablecer" method="post">
          <div class="register-box-body">
            <p class="login-box-msg">Recuperar la Contraseña</p>        
              <div class="form-group has-feedback">
                <label for="password"> Nueva contraseña </label>
                <input type="password" class="form-control" id="clave" name="clave" required>
              </div>     
              <div class="form-group has-feedback">
                <label for="password2"> Confirmar contraseña </label>
                <input type="password" class="form-control" id="password2" name="password2" required>
              </div>              
              <div class="row">
                <!-- /.col -->
                <input type="hidden" name="token" value="<?php echo $token ?>">
                <input type="hidden" id="idusuario" name="idusuario" value="<?php echo $usuario['idusuario'] ?>">
                <div class="form-group">
                    <center><input type="submit" class="btn btn-warning" value="Cambiar Contraseña" ></center>
                </div>
                <!-- /.col -->
              </div>
    </form>
    </div>
	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->
    <!-- jQuery -->
    <script src="../public/plugins/jQuery/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <!-- SWEETALERT -->
    <!--Script de sweetalert2 js-->
    <script src="../public/plugins/sweetAlert2/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="scripts/restablecer.js"></script>
  </body>
</html> 
<?php
		}
		else{
			header('../index.php');
		}
	}
	else{
		header('../index.php');
    }
?>