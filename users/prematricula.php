<?php

    session_start();
     include("../db_info.php");
    $delete = 'NO';

    if(isset($_POST['course_id']))
    {
        //echo"YES";
        $c_id = $_POST['course_id'];
        //echo $c_id;
        $user = $_SESSION['numEst'];
        //echo $user;
    
        $queryDel = "DELETE FROM enrollment
                WHERE course_id = '$c_id' AND student_id = '$user' ";
        
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
        <h1>Portal de prematricula</h1>
    </div>

    <div style="padding-right: 250px" class="fl_right">
     <img style="width: 600px; height: 120px" src="../style/images/logo_upra2.png">
    </div>
    <br class="clear" />
  </div>
</div>
<!-- #######
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="topnav">
    <ul>
      <li><a href="index.php">Solicitar Cursos</a>
        <ul style="height: 100px">
          <li><form action="#" method="post">
        <fieldset>
          <input style="height:30px;" type="text" name="course" placeholder="Enter Course Here&hellip;" />
          <input id='search_submit' type="submit" name="submit2" id="news_go" value="Search" />
        </fieldset>
      </form></li>
        </ul>
      </li>
      <li class="active"><a href="prematricula.php">Ver Pre-Matrícula</a>
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
    <h1 style="font-size: 48px">Pre-Matrícula</h1>
    <?php 
        
        if($delete == 'true')
            echo"<h2>El curso fue removido!</h2>";
        else if($delete == 'false')
            echo"<h2>El curso no fue removido!</h2>";
    ?>
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
        $user = $_SESSION['numEst'];
        $query = "SELECT * FROM enrollment
                    WHERE enrollment.student_id = $user";
        $rowColor = 0;
        echo'<table style="text-aling:center" cellpadding="0" cellspacing="0">
        <thead>
          <tr>
            <th>Curso</th>
            <th>Sección</th>
            <th>Status</th>
            <th>Remover Curso</th>
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
                  
                
                echo"<td>".$row['course_id']."</td>
                    <td>".$row['section_id']."</td>";
                
                if($row['status'] == 0)
                    echo"<td>Procesando</td>";
                else if($row['status'] == 1)
                    echo"<td>Matriculado</td>";
                else if($row['status'] == 2)
                    echo"<td>Cancelado por cupo</td>";
                
                echo"<td>
                <form action='prematricula.php' method='post'>
                <input type='hidden' name='course_id' value=' ".$row['course_id']." '>
                <input title='Eliminar ".$row['course_id']."-".$row['section_id']."' style='width: 30px; height: 30px' 
                type='image' style='background-color: transparent' name='submit' src='../style/images/trash_can.png' border='0' alt='Submit' />
                </form>
                </td>
                 </tr>";
                
                $rowColor++;
            }
        }
        
        echo"</tbody></table>";

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
      <h2>Stay In The Know !</h2>
      <p>Please enter your email to join our mailing list</p>
      <form action="#" method="post">
        <fieldset>
          <legend>News Letter</legend>
          <input type="text" value="Enter Email Here&hellip;"  onfocus="this.value=(this.value=='Enter Email Here&hellip;')? '' : this.value ;" />
          <input type="submit" name="news_go" id="news_go" value="GO" />
        </fieldset>
      </form>
      <p>To unsubscribe please <a href="#">click here &raquo;</a></p>
    </div>
    <div class="footbox">
      <h2>Lacus interdum</h2>
      <ul>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li class="last"><a href="#">Praesent et eros</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Lacus interdum</h2>
      <ul>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li class="last"><a href="#">Praesent et eros</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Lacus interdum</h2>
      <ul>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li class="last"><a href="#">Praesent et eros</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col6">
  <div id="copyright">
    <p class="fl_left">Copyright &copy; 2014 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    <br class="clear" />
  </div>
</div>
</body>
</html>