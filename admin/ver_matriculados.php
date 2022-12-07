<?php
    session_start();
    if(!isset($_SESSION['name'])){
      print '<h3 style="color:red;">Esta pagina ha sido accedida por equivocacion. haga<a href="../index.php">login</a></h3>';
      die();
      exit;
  }
     include("../db_info.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Template Name: Educational
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
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
<!-- ####################################################################################################### -->
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
      <li><a href="cursos.php">Cursos</a>
      <li><a href="estudiantes.php">Ver Estudiantes</a>
          <ul style="height: 100px">
        </ul>
      </li>
        <li><a href="prematricula.php">Informe Matrícula</a>
          <ul style="height: 100px">
        </ul>
      </li>
      <li><a href="logout.php">Logout</a>
      </li>
        <li><a href="#"> <?php echo $_SESSION['name'] ?> </a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div style="text-align: center"class="wrapper col1">
    <br>
    
<?php
    if(isset($_GET['course']) && isset($_GET['section']))
    {
        $course = $_GET['course'];
        $section = $_GET['section'];
        
        echo"<h1 style='font-size: 48px'>Matrícula de $course-$section</h1>";
            
    }
    
?>
    <br><br>
</div>
    
    <div class="wrapper col3 style='display: flex; align-content: center">
  <div id="container">
    <div style="float:none; display:block; width:1000px" id="content">
        
<?php 
       if(isset($_GET['course']) && isset($_GET['section']))
        {
            $course = $_GET['course'];
            $section = $_GET['section'];
           
           $query2 = "SELECT * FROM enrollment JOIN student
            WHERE enrollment.student_id = student.student_id
            AND course_id = '$course'
            AND section_id = '$section'
            ORDER BY year_of_study DESC, timestamp ASC";

            $rowColor = 0;
            echo'<table style="text-aling:center" cellpadding="0" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Número de Estudiante</th>
                <th>Año de Estudio</th>
                <th>Status</th>
                <th>Timestamp</th>
              </tr>
            </thead><tbody>';

            if($result2 = $dbc->query($query2))
            {
                while($row2 = $result2->fetch_assoc())
                {
                    if($rowColor % 2 == 0)
                        echo"<tr class='light' style='text-align:center'>";

                    else
                        echo"<tr class='dark' style='text-align:center'>";


                    echo"<td>".$row2['name']."</td>
                        <td>".$row2['student_id']."</td>
                        <td>".$row2['year_of_study']."</td>";

                    if($row2['status'] == 0)
                        echo"<td>Pendiente</td>";
                    else if($row2['status'] == 1)
                        echo"<td>Matriculado</td>";
                    else if($row2['status'] == 2)
                        echo"<td>Cancelado por cupo</td>";

                    echo "<td>".$row2['timestamp']."</td>";



                    $rowColor++;
                }
            }

            echo"</table";
       }

?>
      
      </div>
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