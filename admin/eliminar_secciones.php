<?php

    session_start();
    if(!isset($_SESSION['name'])){
      print '<h3 style="color:red;">Esta pagina ha sido accedida por equivocacion. haga<a href="../index.php">login</a></h3>';
      die();
      exit;
  }
     include("../db_info.php");
//     echo '<pre>';
//     print_r($_SESSION);
//     echo '</pre>';
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
    <h1 style="font-size: 48px">Eliminar Sección</h1>
    <br><br>
</div>
    
    
        
    <div class="wrapper col3 style='display: flex; align-content: center">
  <div id="container">
    <div style="float:none; display:block; width:1000px" id="content">
        <?php 
         if(isset($_GET['section_id']))
          {
                $section_id = $_GET['section_id'];
                // $section_id = $_GET['section_id'];

               $query = "SELECT * FROM section WHERE section_id = '$section_id'";

                 echo'<table style="text-aling:center" cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                           
                            <th>Course ID</th>
                            <th>Sección</th>
                            
                          </tr>
                        </thead><tbody>';
                if($result = $dbc->query($query))
                {
                        $rowColor = 0;
                        while($row = $result->fetch_assoc())
                        {
                            if($rowColor % 2 == 0)
                                echo"<tr class='light' style='text-align:center'>";
                            else
                                echo"<tr class='dark' style='text-align:center'>";


                            echo"
                                <td>".$row['course_id']."</td>
                                <td>".$row['section_id']."</td>";

                            $rowColor++;

                        }
                       
                  }
             
                  else
                    print'<h3 style="color:red;">Error, la sección no se encontró en la tabla</h3>';


              echo'<div class="wrapper col1"><h3><a href="eliminar_secciones.php?del='.$section_id.'"> Borrar? </a></h3></div>';
             echo"</tbody></table";
             $dbc->close();
            }
            
            elseif(isset($_GET['del']) )
            {
                 //borrar est confirmado
                $section = $_GET['del'];
                 $query = "DELETE FROM section WHERE section_id='$section' LIMIT 1";
                 if ($dbc->query($query) === TRUE) 
                   echo '<h3>La sección ha sido eliminado con éxito. </h3>';
                 else 
                   print '<h3 style="color:red;">No se pudo eliminar la sección porque:<br />' . $dbc->error. '</h3>';
                
                $dbc->close();
             } 
             else
                    print '<h3 style="color:red;">Esta página ha sido accedida con error</h3>';
            
            ?>
        
            <div class="wrapper col1">
            <h3><a href="cursos.php"> Ver cursos </a></h3>
        </div> 

        
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