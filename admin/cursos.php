<?php

    session_start();
     include("../db_info.php");
     if(isset($_POST['course_id']))
    {
        //echo"YES";
        $c_id = $_POST['course_id'];
        echo $c_id;
       
    
        $queryDel = "DELETE FROM course WHERE course_id = $c_id LIMIT  1 ";
        
        if($dbc->query($queryDel) === TRUE){
           // echo"<br>Curso fue removido!";
            $delete = true;
        }
            
        else{
            echo"<br>".$dbc->error;
            $delete = false;
        }
    }
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
    <?php 
        
        if($delete == 'true')
            echo"<h2>El curso fue removido!</h2>";
        else if($delete == 'false')
            echo"<h2>El curso no fue removido!</h2>";
    ?> <?php 
        
    if($delete == 'true')
        echo"<h2>El curso fue removido!</h2>";
    else if($delete == 'false')
        echo"<h2>El curso no fue removido!</h2>";
?>

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
      </li>
    <li><a href="prematricula.php">Informe Matrícula</a>
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
       
       $query = "SELECT * FROM course JOIN section WHERE course.course_id=section.course_id";
                    
        $rowColor = 0;
        echo'<table style="text-aling:center" cellpadding="0" cellspacing="0">
        <thead>
          <tr>
            <th>Curso</th>
            <th>Course ID</th>
            <th>Créditos</th>
            <th>Sección</th>
           
            <th>Eliminar curso</th>
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
                  
                
                print"<tr>
                    <td>".$row['title']."</td>
                    <td>".$row['course_id']."</td>
                    <td>".$row['credits']."</td>
                    <td>".$row['section_id']."</td>
                    <td><form action='cursos.php' method='post'>
                    <input type='hidden' name='course_id' value=' ".$row['course_id']." '>
                    <input title='Eliminar ".$row['course_id']."' style='width: 30px; height: 30px' 
                    type='image' style='background-color: transparent' name='submit' src='../style/images/trash_can.png' border='0' alt='Submit' />
                    </form></td>
                    </tr>";
                    
                
               
                
                $rowColor++;
            }
        }
        
        echo"</table";

        ?>
       <h1><a href="crear_curso.php">Crear curso nuevo</a></h1>
     
      
   
      
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