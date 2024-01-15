<?php
namespace views;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Añadir Usuario nuevo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
            crossorigin="anonymous"></script>
            <style>
                input:focus, select:focus, select, input.form-control:focus {
                    outline: 2px solid #8350F2;
                    outline-width: 1 !important;
                    box-shadow: none;
                    -moz-box-shadow: none;
                    -webkit-box-shadow: none;
                } 
            </style>
    </head>

    <body style="background-color: #e6e6fa"><br><br>
        <div class="d-flex justify-content-center align-items-center">
            <div style="border: 2px solid #8350f2;" class="col-md-4 p-5 shadow-lg rounded-4">
                <h2 style="color: #8350F2;" class="text-center mb-4">Datos del usuario nuevo</h2>

                <form method="POST" action="../controller/insertarUsuariosAdminController.php">

                    <div class="mb-3">
                        <label style="color: #5f5f5f;" for="inputNombre" class="form-label"><b>Nombre:</b></label>
                        <input style="border: 1px solid #5f5f5f;" type="text" class="form-control" name="inputNombre" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label style="color: #5f5f5f;" for="inputNombre" class="form-label"><b>Primer Apellido:</b></label>
                        <input style="border: 1px solid #5f5f5f;"  type="text" class="form-control" name="inputPrimerApellido" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label style="color: #5f5f5f;" for="inputNombre" class="form-label"><b>Segundo Apellido:</b></label>
                        <input style="border: 1px solid #5f5f5f;"  type="text" class="form-control" name="inputSegundoApellido" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label style="color: #5f5f5f;" for="inputEdad" class="form-label"><b>Telefono:</b></label>
                        <input style="border: 1px solid #5f5f5f;"  type="tel" class="form-control" name="inputTelefono" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label style="color: #5f5f5f;" for="inputFechaNac" class="form-label"><b>DNI:</b></label>
                        <input style="border: 1px solid #5f5f5f;"  type="text" class="form-control" name="inputDNI" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label style="color: #5f5f5f;" for="inputSexo" class="form-label"><b>Dirección:</b></label>
                        <input style="border: 1px solid #5f5f5f;"  type="text" class="form-control" name="inputDireccion" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label style="color: #5f5f5f;" for="inputEmail" class="form-label"><b>Email:</b></label>
                        <input style="border: 1px solid #5f5f5f;"  type="email" class="form-control" name="inputEmail" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label style="color: #5f5f5f;" for="inputEmail" class="form-label"><b>Nombre de usuario:</b></label>
                        <input style="border: 1px solid #5f5f5f;"  type="text" class="form-control" name="inputUsuario" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label style="color: #5f5f5f;" for="inputPassword" class="form-label"><b>Contraseña:</b></label>
                        <input style="border: 1px solid #5f5f5f;"  type="password" class="form-control" name="inputPassword">
                    </div>

                    <div class="mb-3">
                        <label style="color: #5f5f5f;" for="inputPassword2" class="form-label"><b>Repetir Contraseña:</b></label>
                        <input style="border: 1px solid #5f5f5f;"  type="password" class="form-control" name="inputPassword2">
                    </div>

                    <div class="d-grid">
                        <button style="background-color: #8350F2; color: #fff" class="btn" type="submit"><b>Crear</b></button>
                    </div>
                </form>
                <div class="mt-3">
                    <p class="mb-0  text-center">¿Volver? <a href="../controller/usuariosAdminController.php"
                            style="color: #8350F2;"
                            class="fw-bold">Volver a usuarios
                            </a></p>
                </div>
            </div>
        </div><br><br>
    </body>

</html>