<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="dist/css/fondo.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>



</head>

<body>
  <div class="contai">
    <img class="img_illus" src="dist/img/dis.gif" alt="This is background">
    <div class="content-contai">
      <h1 id="hea">S I C A F I</h1>
      <p id="subheadlin">Bienvenido</p><br>
    </div>
    <div class="field-contai" style="font-family: Arial; font-size: 15pt;">
      <form action="dist/autenticar.php" method="post" autocomplete="off">
        <fieldset class="len">
          <legend class="len2">Acceder</legend><br>
          <label for="uname">Usuario </label><br>
          <input class="input-field" type="text" id="username" name="username" required size="10"
            style="font-family: Arial; font-size: 16pt; width : 380px; heigth : 1px"><br>
          <br>
          <label for="psw">Contraseña</label><br>
          <input class="input-field" type="password" id="password" name="password" required size="10"
            style="font-family: Arial; font-size: 16pt;width : 380px; heigth : 1px"><br><br>
        </fieldset><br><br>
        <center>
        <button type="submit" class="btns btn-info" style="color: white;" id="">Iniciar Sesión</button>
          <button type="submit" class="btns btn-danger" style="color: white;">Cancelar</button><br><br><br>
          <a href="dist/RecuperarContra.php">¿Has olvidado tu contraseña?</a>
        </center>
      </form>
    </div>
  </div>
</body>
</html>
