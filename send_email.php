<?php
if(isset($_POST['email'])) {

    // Edita las dos líneas siguientes con tu dirección de correo y asunto personalizados

    $email_to = "albertoo.marcos@gmail.com";

    $email_subject = "Contacto pag web";

    function died($error) {

        // si hay algún error, el formulario puede desplegar su mensaje de aviso

        echo "Lo sentimos, hubo un error en sus datos y el formulario no pudo ser enviado en este momento. ";

        echo "Detalle de los errores.<br /><br />";

        echo $error."<br /><br />";

        echo "Porfavor corrija estos errores e inténtelo de nuevo.<br /><br />";
        die();
    }

    // Se valida que los campos del formulairo estén llenos

    if(!isset($_POST['name']) ||

        !isset($_POST['apellido']) ||

        !isset($_POST['telefono']) ||

        !isset($_POST['email']) ||

        !isset($_POST['message'])) {

        died('Lo sentimos pero parece haber un problema con los datos enviados.');

    }
 //En esta parte el valor "name" nos sirve para crear las variables que recolectaran la información de cada campo

    $first_name = $_POST['name']; // requerido

    $last_name = $_POST['apellido']; // requerido

    $email_from = $_POST['email']; // requerido

    $telephone = $_POST['telefono']; // no requerido

    $message = $_POST['message']; // requerido

    $error_message = "Error";

//En esta parte se verifica que la dirección de correo sea válida

   $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {

    $error_message .= 'La dirección de correo proporcionada no es válida.<br />';

  }

//En esta parte se validan las cadenas de texto

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$first_name)) {

    $error_message .= 'El formato del nombre no es válido<br />';

  }

  if(!preg_match($string_exp,$last_name)) {

    $error_message .= 'el formato del apellido no es válido.<br />';

  }

  if(strlen($message) < 2) {

    $error_message .= 'El formato del texto no es válido.<br />';

  }

  if(strlen($error_message) > 0) {

    died($error_message);

  }

//A partir de aqui se contruye el cuerpo del mensaje tal y como llegará al correo

    $email_message = "Contenido del Mensaje.\n\n";



    function clean_string($string) {

      $bad = array("content-type","bcc:","to:","cc:","href");

      return str_replace($bad,"",$string);

    }



    $email_message .= "Nombre: ".clean_string($first_name)."\n";

    $email_message .= "Apellido: ".clean_string($last_name)."\n";

    $email_message .= "Email: ".clean_string($email_from)."\n";

    $email_message .= "Teléfono: ".clean_string($telephone)."\n";

    $email_message .= "Mensaje: ".clean_string($message)."\n";


//Se crean los encabezados del correo

$headers = 'From: '.$email_from."\r\n".

'Reply-To: '.$email_from."\r\n" .

'X-Mailer: PHP/' . phpversion();

@mail($email_to, $email_subject, $email_message, $headers);

?>



<!— incluye aqui tu propio mensaje de Éxito-->

Gracias! Nos pondremos en contacto contigo a la brevedad


<?php

}

?>