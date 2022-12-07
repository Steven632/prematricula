<?php
    session_start();
    if(!isset($_SESSION['name'])){
      print '<h3 style="color:red;">Esta pagina ha sido accedida por equivocacion. haga<a href="../index.php">login</a></h3>';
      die();
      exit;
  }
     include("../db_info.php");
        
    //numEst, name, year
   
    $insert = 'not yet';
    
    if(isset($_POST['course_id']) && isset($_POST['section_id']))
    {
      $c_id = $_POST['course_id'];
        $s_id = $_POST['section_id'];
        $student_num = $_SESSION['numEst'];
        
        
        //INSERT QUERY
        $timestamp = date("Y-m-d H:i:s");
        $status = 0;
        $queryInsert = "INSERT INTO enrollment
        VALUES('$student_num', '$c_id', '$s_id', $status, '$timestamp')";
        
        if ($dbc->query($queryInsert) === TRUE)  {
            $insert = true;
        }
        

        else{
        	//print'<h3 style="color:red;">No se pudo pre-matricular el curso correctamente. Error: '.$dbc->error.'</h3>'; 
            $insert = false;
        }
        //END INSERT QUERY
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

    .input1{
        color: red;
    }
    
    input[type=submit] {

    background:url("../style/styles/images/file.png") top right no-repeat transparent;
    height: 50px;
    width: 50px;
    float: right;
    }

    input[type=submit]:hover{
        background:url("../style/styles/images/file2.png") top right no-repeat transparent;
    }
    
</style>    
    
    
</head>
<body>
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
        <br><br>
        <h1>Portal de pre-matrícula</h1>
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
      <li class="active"><a href="index.php">Solicitar Cursos</a>
        <ul style="height: 100px">
          <li><form action="#" method="post">
        <fieldset>
            <?php
            if(isset($_POST['course']))
                echo '<input style="height:30px;" type="text" name="course" placeholder="'.$_POST['course'].'" />';
            else
                echo ' <input style="height:30px;" type="text" name="course" placeholder="Escriba el ID del curso&hellip;" />';
            ?>
          <input id='search_submit' type="submit" name="submit2" id="news_go" value="Search" />
        </fieldset>
      </form></li>
          </ul>
        </li>
        <li><a href="prematricula.php">Ver Pre-Matrícula</a></li>
               
      <li><a href="logout.php">Logout</a>
      </li>
        <li><a href="#"><?php echo $_SESSION['name'] ?></a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div style="text-align: center"class="wrapper col1">
    <br>
    <h1 style="font-size: 48px">Cursos</h1>
    <?php 
        
        if($insert == 'true')
            echo"<h2>El curso fue añadido!</h2>";
        else if($insert == 'false')
            echo"<h2>El curso no fue añadido!</h2>";
    ?>
    <br><br>
</div>
    
<div class="back">
<div class="col4 flex-container">    
    
     <?php
    
        $courses = array();
        $user = $_SESSION['numEst'];
                $queryfirst = "SELECT course_id FROM enrollment
                WHERE enrollment.student_id = $user";
                if($result = $dbc->query($queryfirst))
                {
                    while($row = $result->fetch_assoc())
                    {
                       array_push($courses, $row['course_id']);
                    }
                }
                $formid = 1;
                
                if(isset($_POST['submit3']) && isset($_POST['course']))
                {
                    $course = $_POST['course'];
                    $query = "SELECT * FROM course JOIN section
                            WHERE course.course_id = section.course_id
                            AND course.course_id LIKE '%$course%'
                            ORDER BY course.course_id, section.section_id";
                }
                else if(isset($_POST['submit2']))
                {
                    $course = $_POST['course'];
                    $query = "SELECT * FROM course JOIN section
                            WHERE course.course_id = section.course_id
                            AND course.course_id LIKE '%$course%'
                            ORDER BY course.course_id, section.section_id";
                }
                else
                {
                    $query = "SELECT * FROM course JOIN section
                          WHERE course.course_id = section.course_id
                          ORDER BY course.course_id, section.section_id";   
                }

                
                $count = 0;
                $check = false;
                
                if($result = $dbc->query($query)){
                    while($row = $result->fetch_assoc())
                    {
                        
                        if($count != 0)
                        {
                            
                            if($row['course_id'] == $previd){
                                //SAME COURSE, DIFFERENT SECTION
                                
                                if($check == true)
                                {
                                    echo'<form>';
                                      if(isset($_POST['course']))
                                        echo' <input type="hidden" name="course" value="'.$_POST['course'].'">';
                                    echo'<input type="hidden" name="course_id" value="'.$row['course_id'].'">
                                    <input type="hidden" name="section_id" value="'.$row['section_id'].'">
                                    <li><a style="color:#591434" title="El curso ya fue añadido!" href="#">'.$row['course_id'].'-'.$row['section_id'].'
                                    </a></li>
                                    </form>';
                                    $formid++;
                                }
                                else{
                                    echo'<form id="form'.$formid.'" action="index.php" method="POST">';
                                          if(isset($_POST['course']))
                                        echo' <input type="hidden" name="course" value="'.$_POST['course'].'">';
                                        echo'<input type="hidden" name="course_id" value="'.$row['course_id'].'">
                                         <input type="hidden" name="section_id" value="'.$row['section_id'].'">
                                        <li><a title="Añadir curso" href="#">'.$row['course_id'].'-'.$row['section_id'].'
                                        <input type="submit" class="submit" name="submit3" value=""></a></li>
                                        </form>';
                                        $formid++;
                                }
                            }
                            else{
                                //DIFFERENT COURSE
                                //SAME COURSE, DIFFERENT SECTION
                                $check = false;
                                foreach($courses as $course)
                                {
                                    if($row['course_id'] == $course)
                                        $check = true;
                                }
                                if($check == true)
                                {
                                    echo' </ul>
                                      </div>
                                    </div>
                                       <div id="featured_slide" class="flex-child">
                                  <div class="Y"><h1>'.$row['course_id'].'</h1></div>
                                <div id="featured_wrap">
                                    <ul id="featured_tabs">
                                    <form>';
                                              if(isset($_POST['course']))
                                            echo' <input type="hidden" name="course" value="'.$_POST['course'].'">';
                                            echo'<input type="hidden" name="course_id" value="'.$row['course_id'].'">
                                            <input type="hidden" name="section_id" value="'.$row['section_id'].'">
                                            <li><a style="color:#591434" title="El curso ya fue añadido!" href="#">'.$row['course_id'].'-'.$row['section_id'].'
                                           </a></li>
                                    </form> ';
                                    $formid++;
                                }
                                else
                                {
                                    echo' </ul>
                                      </div>
                                    </div>
                                       <div id="featured_slide" class="flex-child">
                                  <div class="Y"><h1>'.$row['course_id'].'</h1></div>
                                <div id="featured_wrap">
                                    <ul id="featured_tabs">
                                    <form id="form'.$formid.'" action="index.php" method="POST">';
                                              if(isset($_POST['course']))
                                            echo' <input type="hidden" name="course" value="'.$_POST['course'].'">';
                                            echo '<input type="hidden" name="course_id" value="'.$row['course_id'].'">
                                            <input type="hidden" name="section_id" value="'.$row['section_id'].'">
                                            <li><a title="Añadir curso" href="#">'.$row['course_id'].'-'.$row['section_id'].'
                                            <input class="submit" type="submit" name="submit3" value=""></a></li>
                                    </form> ';
                                    $formid++;
                                }
                            }
                    }
                    else
                    {
                        //FIRST COURSE IN LIST
                        $check = false;
                        foreach($courses as $course)
                        {
                            if($row['course_id'] == $course)
                                $check = true;
                        }
                        if($check == true)
                        {
                            echo' <div id="featured_slide" class="flex-child">
                              <div class="Y"><h1>'.$row['course_id'].'</h1></div>
                            <div id="featured_wrap">
                                <ul id="featured_tabs">
                                <form>';
                                     if(isset($_POST['course']))
                                        echo' <input type="hidden" name="course" value="'.$_POST['course'].'">';

                               echo'<input type="hidden" name="course_id" value="'.$row['course_id'].'">
                                <input type="hidden" name="section_id" value="'.$row['section_id'].'">
                                <li><a style="color:#591434" title="El curso ya fue añadido!" href="#">'.$row['course_id'].'-'.$row['section_id'].'
                                </a></li>
                                </form> ';
                                $formid++;
                        }
                        else
                        {

                        echo' <div id="featured_slide" class="flex-child">
                              <div class="Y"><h1>'.$row['course_id'].'</h1></div>
                            <div id="featured_wrap">
                                <ul id="featured_tabs">
                                <form id="form'.$formid.'" action="index.php" method="POST">';
                                    if(isset($_POST['course']))
                                        echo' <input type="hidden" name="course" value="'.$_POST['course'].'">';
                                         
                                    echo '<input type="hidden" name="course_id" value="'.$row['course_id'].'">
                                    <input type="hidden" name="section_id" value="'.$row['section_id'].'">
                                    <li><a title="Añadir curso" href="#">'.$row['course_id'].'-'.$row['section_id'].'
                                    <input class="submit" type="submit" name="submit3" value=""></a></li>
                                </form> ';
                                $formid++;
                        }
                    }
                    $count++;
                    $previd = $row['course_id'];
                }
                //CLOSE DIV AFTER LAST COURSE
                echo'</ul></div></div>';
            }
            else
                echo'Query did not give results';

            ?>
    
</div>
</div>
    
    <div class="wrapper col1"><br><br><br></div>
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
    
    <script>
            function myFunction(formid) {
                var id = formid;
                var form = "form".append(formid);
                document.getElementById("form".append(formid)).submit();
            }
        </script>
</html>