<?php
// Declara que el código siguiente está escrito en PHP.
namespace model;
// Define un espacio de nombres para organizar el código, en este caso 'model'.

use \PDO;
use \PDOException;
// Importa las clases PDO y PDOException del espacio de nombres global para la gestión de bases de datos y manejo de excepciones.

class Utils
// Define una clase llamada 'Utils' que contiene utilidades generales.

{
  //Funcion que se conecta a la BD y nos devuelve una conexion PDO activa
  public static function conectar()
  // Declara un método estático 'conectar' para crear y devolver una conexión a la base de datos.

  {
    $DB_SERVER = "127.0.0.1";
    $DB_PORT = 3306;
    $DB_USER = "root";
    $DB_PASSWD = "";
    $DB_SCHEMA = "genesis";
    // Define las credenciales y detalles de la base de datos.

    $conPDO = null;
    // Inicializa la variable $conPDO para almacenar la conexión.

    try {
      require_once("../config/database/global.php");
      // Incluye un archivo externo solo una vez, en este caso una configuración global de la base de datos.

      $conPDO = new PDO("mysql:host=" . $DB_SERVER . ";port=" . $DB_PORT . ";dbname=" . $DB_SCHEMA, $DB_USER, $DB_PASSWD);
      // Intenta establecer una conexión a la base de datos utilizando PDO y guarda la instancia en $conPDO.

      return $conPDO;
      // Devuelve la conexión si es exitosa.

    } catch (PDOException $e) {
      print "¡Error al conectar!: " . $e->getMessage() . "<br/>";
      // Captura cualquier excepción de PDO y muestra el mensaje de error.

      return $conPDO;
      // Devuelve la conexión, que será null si la conexión falló.

      die();
      // Termina el script abruptamente.
    }
  }

  public static function limpiar_datos($data)
  // Método estático para limpiar los datos de entradas potencialmente peligrosas.

  {
    $data = trim($data);
    // Elimina espacios al inicio y al final de la cadena.

    $data = stripslashes($data);
    // Elimina las barras invertidas de la cadena.

    $data = htmlspecialchars($data);
    // Convierte caracteres especiales en entidades HTML para evitar la inyección de código.

    return $data;
    // Devuelve los datos limpios.
  }

  public static function generar_salt($tam)
  // Método estático que genera una 'salt' o cadena aleatoria de longitud definida por $tam.

  {
    $letras = "abcdefghijklmnopqrstuvwxyz1234567890*-.,";

    $salt = "";
    // Inicializa la cadena $salt.

    for ($i = 0; $i < $tam; $i++) {
      $salt .= $letras[rand(0, strlen($letras) - 1)];
      // Añade un carácter aleatorio del string $letras a $salt, repetidamente hasta alcanzar la longitud $tam.
    }

    return $salt;
    // Devuelve la cadena aleatoria.
  }

  public static function generar_codigo_activacion()
  // Método estático para generar un código de activación de 4 dígitos aleatorio.

  {
    return rand(1111, 9999);
    // Devuelve un número aleatorio entre 1111 y 9999.
  }

  public static function correo_registro($usuario)
  // Método estático para enviar un correo electrónico de registro.

  {
    $to = $usuario["email"];
    // Define el destinatario del correo.

    $subject = "Confirma tu Cuenta";
    // Define el asunto del correo.

    $message = "<b>Bienvenido a esta Web " . $usuario["nombre"] . "</b>";
    $message .= "<h1>Por favor confirma tu email</h1>";
    // Construye el cuerpo del mensaje en formato HTML.

    $header = "From:prueba@somedomain.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    // Establece las cabeceras para el formato del correo, incluyendo el remitente y el tipo de contenido.

    $retval = mail($to, $subject, $message, $header);
    // Envía el correo y guarda el resultado de la operación en $retval.

    if ($retval == true) {
      echo "Message sent successfully...";
      // Informa si el mensaje fue enviado exitosamente.
    } else {
      echo "Message could not be sent...";
      // Informa si el mensaje no pudo ser enviado.
    }
  }

  public function cambiarContrasena($idUsuario, $contrasenaNueva, $conexPDO)
  // Método para cambiar la contraseña de un usuario en la base de datos.

  {
    if ($conexPDO != null && isset($idUsuario)) {
      // Verifica que la conexión a la base de datos y el ID de usuario existan.

      try {
        $salt = self::generar_salt(10); // Genera una nueva 'salt'.
        $hash = password_hash($contrasenaNueva . $salt, PASSWORD_DEFAULT); // Combina la nueva contraseña y la salt y hashea el resultado.

        $sentencia = $conexPDO->prepare("UPDATE genesis.usuario SET contrasena = ?, salt = ? WHERE idusuario = ?");
        // Prepara una sentencia SQL para actualizar la contraseña y la salt del usuario en la base de datos.

        $sentencia->bindParam(1, $hash);
        $sentencia->bindParam(2, $salt);
        $sentencia->bindParam(3, $idUsuario, PDO::PARAM_INT);
        // Vincula los parámetros a la sentencia preparada.

        return $sentencia->execute();
        // Ejecuta la sentencia y devuelve el resultado.

      } catch (PDOException $e) {
        print("Error al cambiar la contraseña: " . $e->getMessage());
        // Captura y muestra cualquier error durante la actualización.
      }
    }
    return false;
    // Devuelve falso si la conexión o el ID de usuario no son válidos.
  }
}
