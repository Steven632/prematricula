<?php

    session_start();
    if(!isset($_SESSION['nombre'])){
      print '<h3 style="color:red;">Esta pagina ha sido accedida por equivocacion. haga<a href="../index.php">login</a></h3>';
      die();
      exit;
  }
     include("../db_info.php");

    
    if(isset($_POST['submit']))
    {
        $query1 = "SELECT * FROM enrollment JOIN student 
                    WHERE enrollment.student_id = student.student_id
                    ORDER BY year_of_study DESC, timestamp ASC";
        if($result = $dbc->query($query1))
        {
            while($row = $result->fetch_assoc())
            {
                $s_id = $row['section_id'];
                $c_id = $row['course_id'];
                $student_id = $row['student_id'];
                $query2 = "SELECT * FROM section WHERE section_id='$s_id'";
                if($result2 = $dbc->query($query2))
                {
                    while($row2 = $result2->fetch_assoc())
                    {
                        if($row2['available'] > 0)
                        {
                             $avail = $row2['available'] - 1;
                            $query3 = "UPDATE section SET available = $avail WHERE course_id = '$c_id' AND section_id = '$s_id'";
                            $dbc->query($query3);

                            $query4 = "UPDATE enrollment SET status = 1 WHERE student_id = '$student_id' AND course_id = '$c_id'";
                            $dbc->query($query4);
                        }
                        else
                        {
                            $query5 = "UPDATE enrollment SET status = 2 WHERE student_id = '$student_id' AND course_id = '$c_id'";
                            $dbc->query($query5);
                        }
                       
                    }
                }
            }
        }
        
        $query6 = "UPDATE checker SET bool = 1 WHERE bool = 0";
        $dbc->query($query6);
    }
    
    else{ //not set el post, asi que vamos para ver la matricula hecha
        $query3 = "SELECT * FROM enrollment JOIN course JOIN section
                    WHERE enrollment.course_id = course.course_id 
                    AND course.section_id = section.section_id";
    }

    $queryCheck = "SELECT * FROM checker LIMIT 1";
    if($result = $dbc->query($queryCheck))
    {
        while($row = $result->fetch_assoc())
        {
            $checker = $row['bool'];
        }
    }
    if(isset($_POST['submit2']))
    {
    $query7 = "UPDATE checker SET bool = 0 WHERE bool = 1";
        $dbc->query($query7);
    $query8 = "DELETE FROM enrollment";
    $dbc->query($query8);
    $query9 = "UPDATE section set available = capacity";
      $dbc->query($query9);
    
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
    <style>
    .student_link{
        color: black;
        
    }
    
    .student_link:hover{
       color: darkred;
    }
    
</style>
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
          <ul style="height: 100px">
        </ul>
      </li>
         <li><a href="estudiantes.php">Estudiantes</a>
          <ul style="height: 100px">
        </ul>
      </li>
         <li class="active"><a href="prematricula.php">Informe Matrícula</a>
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
    <h1 style="font-size: 48px">Matrícula</h1>
    <br><br>
</div>
    
    
<?php 
    $user = $_SESSION['numEst'];
    $query = "SELECT * FROM enrollment
                WHERE enrollment.student_id = $user";
    if($result = $dbc->query($query))
    {
        while($row = $result->fetch_assoc())
        {
           
        }
    }
    
?>
    
    <div class="wrapper col3 style='display: flex; align-content: center">
  <div id="container">
    <div style="float:none; display:block; width:1000px" id="content">
        <?php 
        
            if($checker == 0)
            {
               echo'<form action"prematricula" method="post" id="form1">
                <input type="submit" name="submit" form="form1" value="Submit">Procesar Prematricula</input>
                </form>';
              
            }
        
            else
            {
                $rowColor = 0;
                $prev = 'no';
                echo'<table style="text-aling:center" cellpadding="0" cellspacing="0">
                <thead>
                  <tr>
                    <th>Curso</th>
                    <th>Seccion</th>
                    <th>Capacidad</th>
                    <th>Cantidad Disponible</th>
                    <th>Matriculados</th>
                  </tr>
                </thead><tbody>';
                
                $query3 = "SELECT DISTINCT title, course.course_id, section.section_id, capacity, available
                FROM enrollment NATURAL JOIN section NATURAL JOIN course
                    ORDER BY enrollment.course_id ASC, enrollment.section_id ASC";
                 if($result3 = $dbc->query($query3))
                {
                    while($row3 = $result3->fetch_assoc())
                    {
                        if($rowColor % 2 == 0)
                            echo"<tr class='light' style='text-align:center'>";

                        else
                            echo"<tr class='dark' style='text-align:center'>";
                        
                        if($row3['course_id'] == $prev)
                            echo"<td></td>";
                        else
                            echo"<td>".$row3['title']."</td>";


                        echo"<td>".$row3['course_id']."-".$row3['section_id']."</td>
                            <td>".$row3['capacity']."</td>
                            <td>".$row3['available']."</td>
                            <td><a title='Ver los matriculados' class='student_link' href='ver_matriculados.php?course=".$row3['course_id']."&section=".$row3['section_id']."'>Ver estudiantes</a></td>";


                        $rowColor++;
                        $prev = $row3['course_id'];
                    }
                }
                
                 

            }
            if($checker == 1)
            {
               echo'<form action"prematricula" method="post" id="form1">
                <input type="submit" name="submit2" form="form1" value="Submit">Volver a abrir prematricula</input>
                </form>';
              
            }
            echo"</table";
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