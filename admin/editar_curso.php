<?php
session_start();
// echo '<pre>';
//      print_r($_SESSION);
//      echo '</pre>';
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
	if(isset($_GET['course_id'])) //viene del index.php
	{
 		$query = "SELECT * FROM course WHERE course_id={$_GET["course_id"]}";
 		echo "<p>Query para seleccionar curso del récord a editar: ".$query."</p>";

if($result = $dbc->query($query))
{
if ($result->num_rows==1)
{	
  	$row = $result->fetch_assoc();
	//mostrar datos en formulario
 print '<div>
 
 <form action="editar_curso.php" method="post">
 <table border=0>
 <tr>
  <td>Titulo del curso: </td><td>
  <input type="text" name="titulo" id="titulo" value="' .$row['title'].'" /></td>
 </tr> 
 <tr>
  <td>Código: </td><td>
  <input type="text" name="course_id" value="' .$row['course_id'].'" /></td>
 
 
</tr>
 	<td>Créditos: </td><td>
  	<input type="text" name="credits" value="' .$row['credits'].'" /></td>
</tr>

<tr>
  	<td>Curso: </td><td>
  	<select name="course_id" >';

	$query2 ="SELECT * FROM departamento JOIN section";
  echo "<p>Query para seleccionar curso del récord a editar: ".$query2."</p>";
	$result2 = $dbc->query($query2);
	while($row2 = $result2->fetch_assoc())
	{
		print "<option value=".$row2['course_id'];
		if($row2['course_id']==$row['course_id']) 
			print" selected >";
		else 
			print ">";
		print $row2['course_id']."</option>";
	}
	print '</select></td>
</tr>
  	<td>Sección: </td><td>
  	<input type="text" name="section_id" value="'. $row['section_id'].'" /></td>
</tr>
 <tr>
 
	<td><input type="submit" name="Editar" id="Editar" class="formbutton" value="Editar" /></td>
 </tr>
</table>
</form>
</div>'; 
						}
						else
 print '<h3 style="color:red;">No se pudo traer la información del estudiante. Error:<br />' . $dbc->error . '</h3>';
					}  
	else
          	print'<h3 style="color:red;">Error en el query: '.$dbc->error.'</h3>';
}
else if(isset($_POST["course_id"]))//formulario sometido
{
 $titulo = $_POST['title'];
 $course_id = $_POST['course_id'];
 $credits = $_POST['credits'];
//  $email = $_POST['email'];
 $section_id = $_POST['section_id'];
//  $prom = $_POST['promedio']; 
 
 include("../dbinfo.php");
 //echo "<p>Conexión exitosa al servidor.</p>";
 
	$query = "UPDATE course JOIN section 
	SET	title='$titulo', 
	course_id='$course_id', 
	credits='$credits', 
	section_id='$section_id', 
	-- promedio=$prom, 
	-- deptoID=$departamento
	WHERE course_id={$_POST["course_id"]}";
 //echo "<p>update query: ".$query."</p>";
 
 if ($dbc->query($query) === TRUE)
  	print '<h3>El estudiante ha sido actualizado exitosamente</h3>';
 else
  	print '<h3 style="color:red;">No se pudo actualizar el estudiante porque:<br />'.$dbc->error.'</h3>';
}
else
 	print '<h3 style="color:red;">Esta página ha sido accedida con error</h3>';	 	

$dbc->close();
?>
<h3><a href="cursos.php"> Ver cursos</a></h3>
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
