<?php
$pg = "contacto";
include_once("PHPMailer/src/PHPMAILER.php");
include_once("PHPMailer/src/SMTP.php");
include_once("PHPMailer/src/Exception.php");

/*if ($_POST) {
  if (isset($_POST['g-recaptcha'])) {    
    $captcha = $_POST['g-recaptcha'];   
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
*/

if ($_POST) {
  $nombre = $_POST["txtNombre"];
  $correo = $_POST["txtCorreo"];
  $mensaje = $_POST["txtMensaje"];

  if ($nombre != "" && $correo != "") {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "mail.depcsuite.com"; // SMTP a utilizar  
    $mail->Username = "info@arnoldamorin.com.ar"; // Correo completo a utilizar
    $mail->Password = "thv9b3vn";
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
    $mail->addReplyTo("info@arnoldamorin.com.ar");
    $mail->Subject = utf8_decode("Contacto página Web");
    $mail->Body = "Recibimos tu consulta, te responderemos a la brevedad.";
    if (!$mail->send()) {
      $msg = "Error al enviar el correo, intente nuevamente mas tarde." . $mail->ErrorInfo;
      
    }
    $mail->ClearAllRecipients(); //Borra los destinatarios

    //Envía ahora un correo a nosotros con los datos de la persona
    $mail->addAddress("info@arnoldamorin.com.ar");
    $mail->Subject = utf8_decode("Recibiste un mensaje desde tu página Web");
    $mail->Body = "Te escribio $nombre cuyo correo es $correo y el siguiente mensaje:<br><br>$mensaje";

    if ($mail->send()) { // Si fue enviado correctamente redirecciona */
      header('Location:confirmacion-envio.php');
    } else {
      $msg = "Error al enviar el correo, intente nuevamente mas tarde." . $mail->ErrorInfo;
    }
  } else {
    $msg = "Complete todos los campos";
  }
}
//}

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
      <div class="col-sm-6 col-12 mt-3">
        <p>Si deseas contactarte conmigo podés enviarme un mail con este formulario.</p>
      </div>
      <div class="col-sm-6 col-12 mt-3">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-sm-3 form-group">
            <input type="text" id="txtNombre" name="txtNombre" class="form-control shadow" placeholder="Nombre:">
          </div>
          <div class="mb-sm-3 form-group">
            <input type="email" id="txtCorreo" name="txtCorreo" class="form-control shadow" placeholder="Correo:">
          </div>
          <div class="mb-sm-3 form-group">
            <textarea name="txtMensaje" id="txtMensaje" class="form-control shadow" cols="40" rows="5" style="resize: both;" placeholder="Mensaje:"></textarea>
          </div>
          <div class="row">
            <div class="col-lg-6 col-10 form-group">
              <div class="g-recaptcha" data-sitekey="6LdSuT8aAAAAACnNop88wUc6CQeibKmFYVhCZKTJ"></div>
            </div>
            <div class="col-lg-6 col-12 form-group">
              <div class="text-sm-left  text-lg-right text-center">
                <button type="submit" class="btn">ENVIAR</button>
              </div>
            </div>
          </div>
        </form>
        <?php if (isset($msg)) { ?>
          <div class="alert alert-danger col-6" role="alert"><?= $msg ?></div>
        <?php }  ?>
      </div>
    </div>
  </div> 
</main>
<?php
include_once("footer.php"); ?>