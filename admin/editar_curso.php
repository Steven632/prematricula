<?php
session_start();
if(!isset($_SESSION['name'])){
  print '<h3 style="color:red;">Esta pagina ha sido accedida por equivocacion. haga<a href="../index.php">login</a></h3>';
  die();
  exit;
}
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
<div class="wrapper col1">
<?php
	include("../db_info.php");
  

	//echo "<p>Conexión exitosa al servidor.</p>";
	if(isset($_GET['course_id'])) //viene del index.php
	{
        
        echo'<div style="text-align: center"class="wrapper col1">
                <br>
                <h1 style="font-size: 48px">Información de '.$_GET['course_id'].'</h1>
                <br><br>
            </div>';
    $course_id= $_GET['course_id'];
 		$query = "SELECT * FROM course WHERE course_id= '$course_id'";
 		//echo "<p>Query para seleccionar curso del récord a editar: ".$query."</p>";

if($result = $dbc->query($query))
{
if ($result->num_rows==1)
{	
  	$row = $result->fetch_assoc();
	//mostrar datos en formulario
 print '<div>
 
 <form action="editar_curso.php" method="post">
 <table <table width="349" border="0">
 <tr>
  <td width="800" align="right">Titulo del curso: </td><td>
  <input width="800" type="text" name="new_title" value="' .$row['title'].'" /></td>
 </tr> 
 <tr>
  <td width="800" align="right">Código: </td><td>
  <input width="800" type="text" name="new_id" value="' .$row['course_id'].'" /></td>
 
 
</tr>
 	<td width="800" align="right">Créditos: </td><td>
  	<input width="800" type="number" name="new_creds" value="' .$row['credits'].'" /></td>
</tr>

<input type="hidden" name="old_id" value="' .$row['course_id'].'" />





 <tr>
  <td ><a class="centroY" href="cursos.php"> Ver cursos</a></td>
	<td colspan="2"><input  type="submit" name="Editar" id="Editar" class="formbutton" value="Editar" /></td>
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
else if(isset($_POST['Editar']))//formulario sometido
{
 $title = $_POST['new_title'];
 $new_id = $_POST['new_id'];
 $credits = $_POST['new_creds'];
 $old_id = $_POST['old_id'];
 
 
 include("../db_info.php");
 //echo "<p>Conexión exitosa al servidor.</p>";
 
	$query = "UPDATE course 
	SET	title = '$title', 
	course_id = '$new_id', 
	credits = $credits
    WHERE course_id = '$old_id';";
 //echo "<p>update query: ".$query."</p>";
 
 if ($dbc->query($query) === TRUE)
  	print '<h3>El curso ha sido actualizado exitosamente</h3>';
 else
  	print '<h3 style="color:red;">No se pudo actualizar el curso porque:<br />'.$dbc->error.'</h3>';
}
else
 	print '<h3 style="color:red;">Esta página ha sido accedida con error</h3>';	 	

$dbc->close();
?>
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