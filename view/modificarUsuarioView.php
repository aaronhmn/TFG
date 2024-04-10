<?php
namespace view;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Modificar Usuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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

<body style="background-color: #e6e6fa">
<br>
<form method="POST" action="../controller/modificarUsuarioController.php" style="display: flex; justify-content: center; align-items: center;">
    <div class="container">
        <div class="row" style="margin: 0; display: flex; align-items: center; justify-content: center;">
        <div style="border: 2px solid #8350f2; display: flex; align-items: center; justify-content: center;" class="col-md-6 p-6 shadow-lg rounded-4">
        
            <div class="col-lg-9 col-sm-9"><br><br>
              
                <h2 style="color: #8350F2; text-align: center;">Modificar Usuarios</h2><br>

                <div style="display: flex; flex-direction: column;">
                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="nombre" style="color: #5f5f5f; margin-bottom: 5px;"><b>Nombre:</b></label>
                        <input type="text" style="border: 1px solid #5f5f5f;" class="form-control" id="nombre" name="nombre" value='<?=(isset($usuario)?$usuario["nombre"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="primer_apellido" style="color: #5f5f5f; margin-bottom: 5px;"><b>Primer Apellido:</b></label>
                        <input type="text" style="border: 1px solid #5f5f5f;" class="form-control" id="primer_apellido" name="primer_apellido" value='<?=(isset($usuario)?$usuario["primer_apellido"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="segundo_apellido" style="color: #5f5f5f; margin-bottom: 5px;"><b>Segundo Apellido:</b></label>
                        <input type="text" style="border: 1px solid #5f5f5f;" class="form-control" id="segundo_apellido" name="segundo_apellido" value='<?=(isset($usuario)?$usuario["segundo_apellido"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="dni" style="color: #5f5f5f; margin-bottom: 5px;"><b>DNI:</b></label>
                        <input type="text" style="border: 1px solid #5f5f5f;" class="form-control" id="dni" name="dni" value='<?=(isset($usuario)?$usuario["dni"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="email" style="color: #5f5f5f; margin-bottom: 5px;"><b>Email:</b></label>
                        <input type="email" style="border: 1px solid #5f5f5f;" class="form-control" id="email" name="email" value='<?=(isset($usuario)?$usuario["email"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="nombre_usuario" style="color: #5f5f5f; margin-bottom: 5px;"><b>Nombre de usuario:</b></label>
                        <input type="text" style="border: 1px solid #5f5f5f;" class="form-control" id="nombre_usuario" name="nombre_usuario" value='<?=(isset($usuario)?$usuario["nombre_usuario"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="codigo_postal" style="color: #5f5f5f; margin-bottom: 5px;"><b>Código Postal:</b></label>
                        <input type="number" style="border: 1px solid #5f5f5f;" class="form-control" id="codigo_postal" name="codigo_postal" value='<?=(isset($usuario)?$usuario["codigo_postal"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="calle" style="color: #5f5f5f; margin-bottom: 5px;"><b>Nombre de la calle o avenida:</b></label>
                        <input type="text" style="border: 1px solid #5f5f5f;" class="form-control" id="calle" name="calle" value='<?=(isset($usuario)?$usuario["calle"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="numero_bloque" style="color: #5f5f5f; margin-bottom: 5px;"><b>Número del bloque o casa:</b></label>
                        <input type="number" style="border: 1px solid #5f5f5f;" class="form-control" id="numero_bloque" name="numero_bloque" value='<?=(isset($usuario)?$usuario["numero_bloque"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="piso" style="color: #5f5f5f; margin-bottom: 5px;"><b>Piso:</b></label>
                        <input type="text" style="border: 1px solid #5f5f5f;" class="form-control" id="piso" name="piso" value='<?=(isset($usuario)?$usuario["piso"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="telefono" style="color: #5f5f5f; margin-bottom: 5px;"><b>Teléfono:</b></label>
                        <input type="tel" style="border: 1px solid #5f5f5f;" class="form-control" id="telefono" name="telefono" value='<?=(isset($usuario)?$usuario["telefono"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="activacion" style="color: #5f5f5f; margin-bottom: 5px;"><b>Activación:</b></label>
                        <input type="number" style="border: 1px solid #5f5f5f;" class="form-control" id="activacion" name="activacion" value='<?=(isset($usuario)?$usuario["activacion"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="activo" style="color: #5f5f5f; margin-bottom: 5px;"><b>Activo:</b></label>
                        <input type="number" style="border: 1px solid #5f5f5f;" class="form-control" id="activo" name="activo" value='<?=(isset($usuario)?$usuario["activo"]:"") ?>' />
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 10px;">
                        <label for="rol" style="color: #5f5f5f; margin-bottom: 5px;"><b>Rol:</b></label>
                        <input type="number" style="border: 1px solid #5f5f5f;" class="form-control" id="rol" name="rol" value='<?=(isset($usuario)?$usuario["rol"]:"") ?>' />
                    </div>

                    <!--Añadimos un campo oculto con el identificador del usuario para poder modificar el registro en Bd-->
                    <input type="hidden" name="idUsuario" value='<?=(isset($usuario)?$usuario["idusuario"]:"") ?>' />

                    <button type="submit" name="modificar" value="true" class="btn mb-sm-2 shadow p-3 mb-5 px-3 py-2" style="background-color: #8350F2; color: #fff; margin-top: 20px;">Modificar</button>

                    <div style="text-align: center; margin-top: 10px;">
                        <p>¿Volver? <a href="../controller/usuariosAdminController.php" class="fw-bold" style="color: #8350F2;">Volver a usuarios</a></p>
                    </div><br>
                </div>
            </div>
            </div>
        </div>
    </div>
</form><br>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>