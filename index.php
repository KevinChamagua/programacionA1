<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proyecto final</title>
              <!-- llamado de los metodos bootstrap y css  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/estilos.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">
    <link rel="stylesheet" href="public/alertifyjs/css/alertify.min.css">
    
</head> 
          <!-- diseño del navbar -->
  <nav class="navbar navbar background-color navbar-dark navbar-expand-sm" style="background-color: #632305;">
      <a class="navbar-brand" href="#">El Espacio Del Lector</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">   <!-- items que se mostraran en pantalla al lado del navbar -->

            <a class="nav-link" href="#">  <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link mostrar-chat" data-modulo="chat" data-form="chat" href="#">Comentanos tus dudas (Chat)</a>
        </li >
        <li class="nav-item">
            <a class="nav-link mostrar-chat" data-modulo="sudoku" href="public\vistas\sudoku\sudoku.html" href="#">Sudoku!</a>
        </li >
        <li class="nav-item">
        <a class="nav-link mostrar-login1" data-modulo="login" href="public\vistas\login1\login1.html" href="#">Iniciar sesion</a>
      </li>
      <li class="nav-item">
      <a class="nav-link mostrar-registros" data-modulo="registros" href="public\vistas\registros\registros.php" href="#">Registrate</a>
      </li>
        </ul>
      </div>
    </nav>
    <div class="container">     <!-- llamado de las forms -->
      <div id="modulos">
        <div class="modulos" id="vistas-alumnos"></div>
        <div class="modulos" id="vistas-buscar-prestamos"></div>
        <div class="modulos" id="vistas-chat"></div>
        <div class="modulos" id="vistas-login1"></div>
        <div class="modulos" id="vistas-registros"></div>
        <div class="modulos" id="vistas-sudoku"></div>
      </div>
    </div>
    <body>
      <!-- Creacion de la tabla -->
      <div style="text-align:center;">
      <h2>Descarga o Alquila los Libro Disponibles</h2>
      <table border="1" style="max-width: 24rem; background-color: #f19947;">
      <tr>
        <td>Id</td>
        <td>Libros</td>
        <td>Descargas</td>
        <td>Alquila</td>
      </tr>

      <tr>
        <td>1</td><!-- Id manual del contenido -->
        <td>  <img src="https://i.pinimg.com/originals/42/bd/81/42bd819758fab194eee515a6efb9391a.jpg" width="300" height="300"><!-- Configuracion de la imagen -->
        </td>
        <td>
          <a href="public\Libros\CUADERNO-DE-LA-HUERTA-ECOLÓGICA.pdf" download="Cuaderno de la huerta ecologica">Descargar</a> <!-- funcion de descargado de contenido -->
        </td>
        <td>
          <a class="nav-link mostrar-prestamos" data-modulo="prestamos" data-form="prestamos" href="#">Alquila</a>
        </td>
    
      </tr>

      <tr>
        <td>2</td><!-- Id manual del contenido -->
        <!-- enlace a imagen de referencia del libro-->
        <td>  <img src="https://img.freepik.com/vector-gratis/fondo-dibujos-animados-pizarra-matematicas_23-2148154590.jpg?size=338&ext=jpg" width="300" height="300"><!-- Configuracion de la imagen -->
        </td>
        
        <td>
          <a href="public\Libros\operaciones-y-problemas-tercero y segundo-de-primaria.pdf" download="Operaciones y problemas tercero y segundo de primaria">Descargar</a> <!-- funcion de descargado de contenido -->
        </td>
        <td>
          <a class="nav-link mostrar-prestamos" data-modulo="prestamos" data-form="prestamos" href="#">Alquila</a>
        </td>
      </tr>

      
      </table>
    
      </div>
      <div>
        <!-- Codigo proporcionado por https://www.contadorvisitasgratis.com/step_3.php para hacer la cuentas de visitas-->
        <p style="color:#FFFFFF";>Bienvenido visitante numero:</p>

        <div id="sfc5js78yfynrf7xy1qsghk5rt13ksayupw"></div>
        <script type="text/javascript" src="https://counter11.stat.ovh/private/counter.js?c=5js78yfynrf7xy1qsghk5rt13ksayupw&down=async" async></script>
        <noscript><a href="https://www.contadorvisitasgratis.com" title="contador de visitas para joomla 3.0"><img src="https://counter11.stat.ovh/private/contadorvisitasgratis.php?c=5js78yfynrf7xy1qsghk5rt13ksayupw" border="0" title="contador de visitas para joomla 3.0" alt="contador de visitas para joomla 3.0"></a></noscript>
      </div>
  </body>
  <!-- dirección URL del recurso al cual se quiere acceder a las librerias -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="public/js/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/vue-select@3.0.0"></script>
    <script src="public/alertifyjs/alertify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.dev.js"></script>
    <script src="public/js/app.js"></script>
    <script src="public/js/notificaciones.js"></script>
    <script src="public/js/push.js"></script>
</body>
</html>



