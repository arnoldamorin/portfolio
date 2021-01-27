<?php
 $pg = "contacto";
 include_once ("PHPMailer/src/PHPMailer.php");
 include_once ("PHPMailer/src/SMTP.php");
 $pg = "contacto";
 if($_POST){ 
  $nombre = $_POST["txtNombre"];
  $correo = $_POST["txtCorreo"];
  $asunto = $_POST["txtAsunto"];
  $mensaje = $_POST["txtMensaje"];

  if($nombre != "" && $correo != ""){
      $mail = new PHPMailer();
      $mail->IsSMTP();
      $mail->SMTPAuth = true;
      $mail->Host = "mail.dominio.com"; // SMTP a utilizar
      $mail->Username = "info@dominio.com.ar"; // Correo completo a utilizar
      $mail->Password = "aqui va la clave de tu correo";
      $mail->Port = 25;
      $mail->From = "info@dominio.com.ar"; //Desde la cuenta donde enviamos
      $mail->FromName = "Tu nombre a mostrar";
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
      $mail->addBCC("otrocorreo@gmail.com"); //Copia oculta
      $mail->Subject = utf8_decode("Contacto página Web");
      $mail->Body = "Recibimos tu consulta, te responderemos a la brevedad.";
      if(!$mail->Send()){
          $msg = "Error al enviar el correo, intente nuevamente mas tarde.";
      }
      $mail->ClearAllRecipients(); //Borra los destinatarios

      //Envía ahora un correo a nosotros con los datos de la persona
      $mail->addAddress("info@dominio.com.ar");
      $mail->Subject = utf8_decode("Recibiste un mensaje desde tu página Web");
      $mail->Body = "Te escribio $nombre cuyo correo es $correo, con el asunto $asunto y el siguiente mensaje:<br><br>$mensaje";
     
      if($mail->Send()){ /* Si fue enviado correctamente redirecciona */
          header('Location: confirmacion-envio.php');
      } else {
          $msg = "Error al enviar el correo, intente nuevamente mas tarde.";
      }    
  } else {
      $msg = "Complete todos los campos";
  }

}
?>


<?php include_once('menu.php');?>
  <main>
    <div class="container">
      <div class="row mb-sm-5">
        <div class="col-12">
          <h1>Contacto</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-12">          
            <p>Si deseas contactarte conmingo podes enviarme un mail con este formulario</p>
        </div>
        <div class="col-sm-6 col-12">
          <form action="" method="POST">
            <div class="mb-sm-3">
              <input type="text" id="txtNombre" name="txtNombre" class="form-control shadow" placeholder="Nombre">
            </div>
            <div class="mb-sm-3">
              <input type="email" id="txtCorreo" name="txtCorreo" class="form-control shadow" placeholder="Correo">
            </div>
            <div class="mb-sm-3">
              <textarea name="txtMensaje" id="txtMensaje" class="form-control shadow" cols="40" rows="5"
                style="resize: both;"></textarea>
            </div>
          </form>
          <div class="row">
            <div class="col-sm-6 col-10">
              <form action="?" method="POST">
                <div class="g-recaptcha" data-sitekey="xd"></div>
            </div>
            <div class="col-sm-6 col-12">
              <div class="text-sm-right text-center">
                <button type="submit" class="btn">ENVIAR</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main> 
  <?php 
include_once("footer.php");?>