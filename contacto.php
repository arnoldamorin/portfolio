<?php
$pg = "contacto";
include_once("PHPMailer/src/PHPMailer.php");
include_once("PHPMailer/src/SMTP.php");
$pg = "contacto";
if ($_POST) {
  if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
  }
  if (!$captcha) {
    $mensaje = "Check the checkbox";
    exit;
  }
  $secretKey = "6LdSuT8aAAAAAOC-416usF5_A5SUpPl64pTzxpUB";
  $ip = $_SERVER['REMOTE_ADDR'];
  // post request to server
  $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
  $response = file_get_contents($url);
  $responseKeys = json_decode($response, true);
  // should return JSON with success as true  
  $nombre = $_POST["txtNombre"];
  $correo = $_POST["txtCorreo"];
  $mensaje = $_POST["txtMensaje"];

  if ($nombre != "" && $correo != "") {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "mail.depcsuite.com"; // SMTP a utilizar
    $mail->Username = "info@arnoldamorin.com.ar"; // Correo completo a utilizar
    $mail->Password = "mamcimparse1";
    $mail->Port = 25;
    $mail->From = "info@arnoldamorin.com.ar"; //Desde la cuenta donde enviamos
    $mail->FromName = "Arnold Amorin";
    $mail->IsHTML(true);
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );

    //Destinatarios
    $mail->addAddress($correo);
    $mail->addBCC("aamorin.ar@gmail.com"); //Copia oculta
    $mail->Subject = utf8_decode("Contacto página Web");
    $mail->Body = "Recibimos tu consulta, te responderemos a la brevedad.";
    if (!$mail->Send()) {
      $msg = "Error al enviar el correo, intente nuevamente mas tarde.";
    }
    $mail->ClearAllRecipients(); //Borra los destinatarios

    //Envía ahora un correo a nosotros con los datos de la persona
    $mail->addAddress("info@arnoldamorin.com.ar");
    $mail->Subject = utf8_decode("Recibiste un mensaje desde tu página Web");
    $mail->Body = "Te escribio $nombre cuyo correo es $correo, con el asunto $asunto y el siguiente mensaje:<br><br>$mensaje";

    if ($mail->Send()) { /* Si fue enviado correctamente redirecciona */
      header('Location: confirmacion-envio.php');
    } else {
      $msg = "Error al enviar el correo, intente nuevamente mas tarde.";
    }
  } else {
    $msg = "Complete todos los campos";
  }
}

?>


<?php include_once('menu.php'); ?>
<main>
  <div class="container">
    <div class="row mb-sm-5">
      <div class="col-12">
        <h1>Contacto</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-12">
        <p>Si deseas contactarte conmigo podes enviarme un mail con este formulario</p>
      </div>
      <div class="col-sm-6 col-12">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-sm-3">
            <input type="text" id="txtNombre" name="txtNombre" class="form-control shadow" placeholder="Nombre">
          </div>
          <div class="mb-sm-3">
            <input type="email" id="txtCorreo" name="txtCorreo" class="form-control shadow" placeholder="Correo">
          </div>
          <div class="mb-sm-3">
            <textarea name="txtMensaje" id="txtMensaje" class="form-control shadow" cols="40" rows="5" style="resize: both;"></textarea>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 col-10">
            <form action="?" method="POST">
              <div class="g-recaptcha" data-sitekey="6LdSuT8aAAAAACnNop88wUc6CQeibKmFYVhCZKTJ"></div>
          </div>
          <div class="col-sm-6 col-12">
            <div class="text-sm-right text-center">
              <button type="submit" class="btn">ENVIAR</button>
            </div>
            <?php if (isset($mensaje)) { ?>
              <div class="alert alert-danger col-6" role="alert"><?= $mensaje ?></div>
            <?php }  ?>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
</main>
<?php
include_once("footer.php"); ?>