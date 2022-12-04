<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width,
						initial-scale=1.0">
	<title>GeeksforGeeks</title>
	<link rel="stylesheet" href="./style/styles/index.css">
</head>

<body>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['submit1'])){
                if((!empty($_POST['numEst'])) && (!empty($_POST['password'])))
                {
                    include_once("db_info.php");
                    $numEst = $_POST['numEst'];
                    $password = $_POST['password'];
        
                    $query = " SELECT * FROM student WHERE student_id = '$numEst'";
                    $result = $dbc->query($query);
                    if($result->num_rows==1)
                    {
                        $row = $result->fetch_assoc();
                        $hash = $row['password'];
                        if(password_verify($password,$hash))
                        {
                            session_start();
                            $_SESSION['name']=$row['name'];
                            $_SESSION['numEst']=$numEst;
                            $_SESSION['year']=$row['year_of_study'];
                            if($row['year_of_study'] == 0){
                                header('location: admin/prematricula.php');
                            }
                            else{
                                
                                $queryCheck = "SELECT * FROM checker LIMIT 1";
                                if($result = $dbc->query($queryCheck))
                                {
                                    while($row = $result->fetch_assoc())
                                    {
                                        $checker = $row['bool'];
                                    }
                                }
                                
                                if($checker == 0)
                                    header('location: users/index.php');
                                else
                                    header('location: users/matricula.php');
                            }
                        }
                        else{
                            echo '<h3>Asegurase de entarar su password correctamemte. <br/> vuelve a intentarlo....</h3>';
                        }
                    }
                    else{
                        echo '<h3>Por favor registrarse o comunicarse con un admin</h3>';
                    }
                    $dbc->close();
                }
            }else if(isset($_POST['submit2'])){
                include_once("db_info.php");
                $nombre =  htmlspecialchars($_POST['nombre'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', false);
                $password = htmlspecialchars($_POST['password'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', false);
                $numEst = htmlspecialchars($_POST['numEst'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', false);
                $year = filter_input(INPUT_POST, 'Year', FILTER_VALIDATE_FLOAT); 
                    if ($year <=1 or $year>5 or !is_numeric($year))
                        $year = 1;

                $q = "SELECT * FROM student WHERE student_id = '$numEst'";
                $s=$dbc->query($q);

                $hash = password_hash($password, PASSWORD_DEFAULT);
                
                if ($s->num_rows==1)
                    print "<h3 style='color:red;'>ERROR: NO se puede insertar ese estudiante ya que <br/> en la base de datos ya existe el número de estudiante ($numEst).</h3>";
                else{
                    $query = "INSERT INTO student (name, password, student_id, year_of_study)value ('$nombre', '$hash', $numEst, $year)";

                    try{
                        $statement = $dbc->prepare($query);
                    }
                    catch (Exception $e){
                        $errorCode = $e->getCode();
                        $error = $e->getMessage();
                        print "<p style='color:red;'>Error en el query: $query <br/>Error: $errorCode, $error.<br/>Comuníquese con el administrador. </p>";
                        exit;
                    }
                    if ($statement->execute()){
                        
                        print "<h3>El estudiante ha sido insertado con éxito.</h3>";
                    }
                    else
                        print'<h3 style="color:red;">No se pudo insertar el estudiante. Comuníquese con el administrador.</h3>';
                }
            }
        }
    ?>



	<header>
		<h1 class="heading">PORTAL DE PRE-MATRÍCULA</h1>
	</header>

	<!-- container div -->
	<div class="container">

		<!-- upper button section to select
			the login or signup form -->
		<div class="slider"></div>
		<div class="btn">
			<button class="login">Login</button>
			<button class="signup">Register</button>
		</div>

		<!-- Form section that contains the
			login and the signup form -->
		<div class="form-section">

			<!-- login form -->
            <form action="index.php" method="POST">
                <div class="login-box">
                    <input type="text" name="numEst" maxlength=9 required
                        class="email ele"
                        placeholder="Número de Estudiante">
                    <input type="password" name="password" minlength=8 required
                        class="password ele"
                        placeholder="Password">
                    <button class="clkbtn">Login</button>
                    <input type="hidden" name="submit1" value="">
                </div>
            </form>

			<!-- signup form -->
            <form action="index.php" method="POST">
                <div class="signup-box">
                    <input type="text" name="nombre" required
                        class="name ele"
                        placeholder="Nombre Completo">
                    <input type="password" name="password" minlength=8 required
                        class="password ele"
                        placeholder="Password">
                    <input type="text" name="numEst" maxlength=9 required 
                        class="email ele"
                        placeholder ="Número de Estudiante">
                    <input type="number" name="Year" maxlength=1 required
                        class="password ele"
                        placeholder = "Año de Estudio">
                    <button class="clkbtn">Register</button>
                    <input type="hidden" name="submit2" value="">
                </div>
            </form>
		</div>
	</div>
	<script src="./style/scripts/index.js"></script>
</body>

</html>
