<?php
session_start();
?>

<!DOCTYPE html>
<html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Educational</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../style/styles/layout.css" type="text/css" />
<script type="text/javascript" src="../style/scripts/jquery.min.js"></script>
<!--<script type="text/javascript" src="../style/scripts/jquery.slidepanel.setup.js"></script>-->
<script type="text/javascript" src="../style/scripts/jquery.ui.min.js"></script>
<!--<script type="text/javascript" src="../style/scripts/jquery.tabs.setup.js"></script>-->
</head>
<body>
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
        <br><br>
        <h1>Portal de administrador de pre-matrícula </h1>
    </div>

    <div style="padding-right: 250px" class="fl_right">
     <img style="width: 600px; height: 120px" src="../style/images/logo_upra2.png">
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="topnav">
    <ul>
      <li class="active"><a href="cursos.php">Cursos</a>
      <li><a href="estudiantes.php">Ver Estudiantes</a>
          <ul style="height: 100px">
        </ul>
      </li><li>
        <a href="prematricula.php">Informe Matrícula</a>
          <ul style="height: 100px">
        </ul>
      </li>
      <li><a href="logout.php">Logout</a>
      </li>
        <li><a href="#"><?php echo $_SESSION['name'] ?></a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<?php
include("../db_info.php");


//echo "<p>Conexión exitosa al servidor.</p>";
if (isset($_GET['submit']))// procesar formulario
{
	// CRUD usando mysqli con objetos...
    
    $nombre= $_GET['title'];
    $course_id= $_GET['course_id'];
    $creditos= $_GET['credits'];
    $section=$_GET['section_id'];
    $capacidad= $_GET['capacity'];
    $query = "UPDATE course (title, course_id, credits) VALUES ($nombre, '$course_id', $creditos)"; 
    // --  INSERT INTO course (title, course_id, credits)
    // --          		VALUES ('$nombre', '$course_id', $creditos)";
    //                 --    INSERT INTO section ( course_id, section_id, capacity) VALUES ( '$course_id', '$section', $capacidad)
    
    // echo "<p>Insert query: ".$query."</p>";

    if ($dbc->query($query) === TRUE) 
    {
        	// $last_id = $dbc->insert_id;
        	print "<h3>El curso ha sido creado con éxito.</h3>";
    }
    else
        	print'<h3 style="color:red;">No se pudo crear el curso. Error: '.$dbc->error.'</h3>';
	}
?>

<!—Formulario solicitando datos del estudiante de honor -->
<!-- <a href="crear_secciones.php"> -->
<form id='form1' name='form1' method='get' action='editar_curso.php'></a>
  <table width='349' border='0'>
    <tr>
      <td width="200" align='right'>Nombre del curso</td>
      <td width="200" align='left'><input name='title' type='text' required /></td>
    </tr>
    <tr>
      <td align='right'>Código del curso</td>
      <td align='left'><input name='course_id' type='text' required method='post'/></td>
    </tr>
    <tr>
      <td align='right'>Creditos</td>
      <td align='left'><input name='credits' type='text' /></td>
    </tr>
    <tr>
      <td align='right'>Sección</td>
      <td align='left'><input type="text" name="section_id" required/></td>
    </tr>
    <tr>
      <td align='right'>Capacidad</td>
      <td align='left'><input type="number" name='capacity' required/></td>
    </tr>
    
    <tr>
   <td colspan='2' align='center'> <input type='submit' name='submit' class="formbutton" value='Insertar' /> </td>
    </tr> 
  </table>
</form>
<h3><a href="cursos.php"> Ver cursos </a></h3>
</div>
<div class="wrapper col1"><br><br><br><br><br><br><br><br><br><br><br><br><br></div>
<!-- ####################################################################################################### -->

<!-- ####################################################################################################### -->
<div class="wrapper col5">
  <div id="footer">
    <div id="newsletter">
      <h2>CCOM4019</h2>
        <h2>Programación Web con PHP/MySQL</h2>
        <h3>2022</h3>
      
    </div>
    <div class="footbox">
      <h2>Javier L. Quiñones Galán</h2>
      <ul>
        <li><a href="#">javier.quinones3@upr.edu</a></li>
        <li><a href="#">5to año</a></li>
      </ul>
    </div>
      <div class="footbox">
      <h2>Steven Rodríguez-De Jesús</h2>
      <ul>
        <li><a href="#">steven.rodriguez18@upr.edu</a></li>
        <li><a href="#">6to año</a></li>
      </ul>
    </div>
      <div class="footbox">
      <h2>Yadiel Cruzado Rodríguez</h2>
      <ul>
        <li><a href="#">yadiel.cruzado@upr.edu</a></li>
        <li><a href="#">5to año</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->

</body>
</html>
