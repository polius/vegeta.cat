<?php
$submitMessage="";
if (isset($_POST["senderName"]))
{
  require 'mail/class.phpmailer.php';
  require 'mail/class.smtp.php';

  $mail = new PHPMailer;

  $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'vegeta.web@gmail.com';             // SMTP username
  $mail->Password = ',fiYC!pw7vmAk@.C~==o!z&dTxp,BrXRicabCyz_=oW,3%dQMar*yPJ]6>y,j2d^';                  // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                                    // TCP port to connect to

  $mail->setFrom('vegeta.web@gmail.com', 'VegetaCat');
  $mail->addAddress('vegeta.web@gmail.com', 'VegetaCat');     // Add a recipient
  $mail->isHTML(true);                                        // Set email format to HTML


  $mail->Subject = $_POST["senderOption"];

  include_once('mail/email.php');
  $mail->Body    = $mail_template;
  $mail->AltBody = $mail_template;

  if(!$mail->send())
  {
      //echo('Mailer Error: ' . $mail->ErrorInfo);
      $submitMessage="<p class=\"contactSendError\" style=\"margin-top:-10px;\">S'ha produït un error a l'enviar el missatge</p>";
  } else 
  {
      $submitMessage="<p class=\"contactSendOk\" style=\"margin-top:-10px;\">El vostre missatge s'ha enviat correctament</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
  <?php include_once('head.php'); ?>
  <script src="/js/hyperform.min.js"></script>
  hyperform(window);
</head>
<body>

  <?php
    $menu_section = 'contact';
    include_once('menu.php');
  ?>

<section class="main clearfix" id="map" style="margin-top:-16px;">

  <section class="top"></section>
  <section class="wrapper">
    <div class="content theme-content">
      
      <?php echo $submitMessage ?>

      <h1 id="labelTitle">Contacta'ns</h1>

      <div class="formStyle" style="margin-top:-20px;">
        
        <form method="post" action="contact.php" style="margin-top:20px;">
          <!--<p id="labelTitle" style="font-size:26px;margin-bottom:30px;">Contacta'ns</p>-->
          <p class="contactLabel">Nom</p>
          <input class="textForm"type="text" id="senderName" name="senderName" placeholder="El teu nom..." required>

          <p class="contactLabel">Email (opcional)</p>
          <input class="textForm" type="email" id="senderEmail" name="senderEmail" placeholder="El teu mail..." >

          <p class="contactLabel">Què vols notificar?</p>
          <span class="css3-metro-dropdown">
            <select class="dropdown-1" id="senderOption" name="senderOption">
              <option value="" disabled selected>Selecciona una opció</option>
              <option value="serie">Vull suggerir una sèrie</option>
              <option value="error">Vull notificar un error</option>
              <option value="altres">Altres</option>
            </select>
          </span>     
        
          <script>
            $( "#senderOption" ).change(function() {
                var str = "";
                $( "select option:selected" ).each(function() {
                  str += $(this).val();
                });
                if (str == "serie")
                {
                  $("#contactContent").html("");
                  $("#contactContent").append(""
                      +"<div id=\"divSerie\">"
                        +"<p id=\"labelSerieName\" class=\"contactLabel\">Nom de la sèrie</p>"
                        +"<input id=\"senderSerieName\" name=\"senderSerieName\" class=\"textForm\" type=\"text\" required>"
                        
                        +"<p id=\"labelLink\" class=\"contactLabel\">Link</p>"
                        +"<input id=\"senderLink\" name=\"senderLink\" class=\"textForm\" type=\"text\" placeholder=\"Exemple: https://www.youtube.com/watch?v=ECk94zr3oBI\" required>"
                        
                        +"<p id=\"labelSerie\" class=\"contactLabel\">Informació addicional</p>"
                        +"<textarea class=\"textArea\" id=\"senderMessageSerie\" name=\"senderMessageSerie\" rows=\"6\"></textarea>"
                      +"</div>");
                }
                else if (str == "error")
                {
                  $("#contactContent").html("");
                  $("#contactContent").append(""
                      +"<div id=\"divError\">"
                        +"<p id=\"labelError\" class=\"contactLabel\">Quin error has trobat?</p>"
                        +"<textarea class=\"textArea\" id=\"senderMessageError\" name=\"senderMessageError\" rows=\"6\" required></textarea>"
                      +"</div>");
                }
                else if (str == "altres")
                {
                  $("#contactContent").html("");
                  $("#contactContent").append(""
                    +"<div id=\"divAltres\">"
                      +"<p id=\"labelAltres\" class=\"contactLabel\">Què ens vols comentar?</p>"
                      +"<textarea class=\"textArea\" id=\"senderMessageAltres\" name=\"senderMessageAltres\" rows=\"6\" required></textarea>"
                    +"</div>");
                }
                $("#contactContent").append(""
                      +"<div id=\"divSubmit\" style=\"text-align:center;\">" 
                        +"<input class=\"submitButton\" type=\"submit\" value=\"Enviar\">"
                      +"</div>");
            });
          </script>
          
          <div id="contactContent"></div>
        </form>
      </div>
    </div>
  </section>
</section>
  
</body>
</html>
