<?php
namespace model;
use \PDO;
use \PDOException;

class Utils {
    //Funcion que se conecta a la BD y nos devuelve una conexion PDO activa
    public static function conectar()
    {
        $DB_SERVER = "127.0.0.1";
        $DB_PORT = 3306;
        $DB_USER = "root";
        $DB_PASSWD = "";
        $DB_SCHEMA = "genesis";
        
        $conPDO=null;
        try 
        {
            require_once("../global.php");
            $conPDO = new PDO("mysql:host=".$DB_SERVER.";port=".$DB_PORT.";dbname=".$DB_SCHEMA, $DB_USER, $DB_PASSWD);
            return $conPDO;
         } 
         catch (PDOException $e) 
         {
            print "¡Error al conectar!: " . $e->getMessage() . "<br/>";
            return $conPDO;
            die();
        }
      
    }

    /**
     * Limpiamos el contenido de las variables
     */

    public static function limpiar_datos($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


      /**
       * Funcion que genera una cadena aleatoria
       */
      public static function generar_salt($tam)
      {

        //Definimos un array de caracteres
        $letras = "abcdefghijklmnopqrstuvwxyz1234567890*-.,";

        $salt="";
        //Vamos añadiendo $tam caracteres aleatorios a la salt
        for ($i=0;$i<$tam;$i++)
        {
            $salt.=$letras[rand(0,strlen($letras)-1)];
        } 

        //devolvemos la salt
        return $salt;

      }

      //La funcion genera un codigo número de 4 digitos aleatorio
      public static function generar_codigo_activacion()
      {
        return rand(1111,9999);
      }

      //Funcion que envia el correo de registro
      public static function correo_registro($usuario)
      {
        $to = $usuario["email"];
        $subject = "Confirma tu Cuenta";
        
        $message = "<b>Bienvenido a esta Web ".$usuario["nombre"]."</b>";
        $message .= "<h1>Por favor confirma tu email</h1>";
        
        $header = "From:prueba@somedomain.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        
        $retval = mail ($to,$subject,$message,$header);
        
        if( $retval == true ) {
           echo "Message sent successfully...";
        }else {
           echo "Message could not be sent...";
        }
      }

      //Funcion que envia el correo de registro
      /*public static function correo_registro($usuario)
      {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gfg.com;';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'user@gfg.com';
            $mail->Password   = 'password';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587; 

            $mail->setFrom('from@gfg.com', 'Name');
            $mail->addAddress('receiver1@gfg.com');
            $mail->addAddress('receiver2@gfg.com', 'Name');

            $mail->isHTML(true);
            $mail->Subject = 'Subject';
            $mail->Body    = 'HTML message body in <b>bold</b> ';
            $mail->AltBody = 'Body in plain text for non-HTML mail clients';
            $mail->send();
            echo "Mail has been sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
      }
      */
}


?>