<?php

    session_start();
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
      <li class="active"><a href="eliminar_curso.php">Cursos</a>
      <li><a href="cursos.php">Cursos</a>
      <li><a href="estuiantes.php">Ver Estudiantes</a>
          <ul style="height: 100px">
        </ul>
      </li>
        <li>
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
<div style="text-align: center"class="wrapper col1">
    <br>
    <h1 style="font-size: 48px">Estudiantes</h1>
    <br><br>
</div>
    
    
    <div class="wrapper col3 style='display: flex; align-content: center">
  <div id="container">
    <div style="float:none; display:block; width:1000px" id="content">
        <?php 
         if(isset($_GET['course_id']) && is_numeric($_GET['course_id']))
      {

         
       $query = "SELECT * FROM course";
        if($result->num_rows==1)
        {
          $row = $result->fetch_assoc();      
        $rowColor = 0;
        echo'<table style="text-aling:center" cellpadding="0" cellspacing="0">
        <thead>
          <tr>
            <th>Curso</th>
            <th>Course ID</th>
            <th>Créditos</th>
          </tr>
        </thead><tbody>';
        
        if($result = $dbc->query($query))
        {
            while($row = $result->fetch_assoc())
            {
                if($rowColor % 2 == 0)
                    echo"<tr class='light' style='text-align:center'>";
                   
                else
                    echo"<tr class='dark' style='text-align:center'>";
                  
                
                echo"<td>".$row['title']."</td>
                    <td>".$row['course_id']."</td>
                    <td>".$row['credits']."</td>";
                    
                    
                
               
                
                $rowColor++;
            
        }
        
        echo"</table";
      }
      else
        print'<h3 style="color:red;">Error, el estudiante no se encontró en la tabla</h3>';
      }
      else
       print'<h3 style="color:red;">Error en el query: '.$dbc->error.'</h3>';
    }
    elseif(isset($_POST['estID']) && is_numeric($_POST['estID']))
    {
     //borrar est confirmado
     $query = "DELETE FROM estudiante WHERE estID={$_POST['estID']} LIMIT 1";
     if ($dbc->query($query) === TRUE) 
       echo '<h3>El récord del estudiante ha sido eliminado con éxito. </h3>';
     else 
       print '<h3 style="color:red;">No se pudo eliminar al estudiante porque:<br />' . $dbc->error. '</h3>';
     } 
     else
       print '<h3 style="color:red;">Esta página ha sido accedida con error</h3>';
     $dbc->close();
    ?>
    <h3><a href="cursos.php"> Ver cursos </a></h3>

        

     
      
   
      
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
=
</body>
</html>