<?php
session_start();
if(!isset($_SESSION['nombre'])){
  print '<h3 style="color:red;">Esta pagina ha sido accedida por equivocacion. haga<a href="../index.php">login</a></h3>';
  die();
  exit;
}
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
    
    // $nombre= $_GET['title'];
    $course_id= $_GET['course_id'];
    // $creditos= $_GET['credits'];
    $section=$_GET['section_id'];
    $capacidad= $_GET['capacity'];
    $query =  "INSERT INTO section ( course_id, section_id, capacity, available) VALUES ( '$course_id', '$section', $capacidad, $capacidad)";
    // "INSERT INTO course (title, course_id, credits)
    //             		VALUES ('$nombre', '$course_id', $creditos)";
                      // INSERT INTO section ( course_id, section_id, capacity) VALUES ( '$course_id', '$section', $capacidad)
    
    // echo "<p>Insert query: ".$query."</p>";

    if ($dbc->query($query) === TRUE) 
    {
        	// $last_id = $dbc->insert_id;
        	print "<div class='wrapper col1' style='text-align: center'> <h3>La sección ha sido creada con éxito.</h3><div>";
    }
    else
        	print'<div class="wrapper col1" style="text-align: center"> <h3 style="color:red;">No se pudo crear la sección del curso. Error: '.$dbc->error.'</h3></div>';
	}
?>


<div class="wrapper col1">
     <div style="text-align: center"class="wrapper col1">
                <br>
                <h1 style="font-size: 48px">Crear sección nueva</h1>
                <br><br>
            </div>
<form id='form1' name='form1' method='get' action='crear_secciones.php'>
  <table width='349' border='0'>
    
    <tr>
   <td align='right'> <label for="course_id">Código del curso</label></td>
			   <td  align='left'> <select class="form-control" id="course_id" name="course_id">
				  <option value="">---SELECT COURSE ID---</option>
				  <?php 	
					$sql = "SELECT * FROM course";
					$res = mysqli_query($dbc, $sql); 
					while ($r = mysqli_fetch_assoc($res)) {
				?>
					<option value="<?php echo $r['course_id']; ?>"><?php echo $r['course_id']; ?></option>
				<?php } ?>
				</select> </td></tr>
        <tr>
      <td align='right'>Sección</td>
      <td align='left'><input type="text" name="section_id" required/></td>
    </tr>
    <tr>
      <td align='right'>Capacidad</td>
      <td align='left'><input type="number" name='capacity' required/></td>
    </tr>
    
    <tr>
      	     <tr>
  <td ><a class="centroY" href="cursos.php"> Ver cursos</a></td>
   <td align='center'> <input style="width: 60px" type='submit' name='submit' class="formbutton" value='Insertar' /> </td>
    </tr> 
  </table>
</form>
</div>
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