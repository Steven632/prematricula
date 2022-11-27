<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
</head>
<body>
    <?php
        include("db_info.php");

        if($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
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
    ?>

    <h1>Register</h1>
    <form action="register.php" method="POST">
        <table>
            <tr>
                <td>Name</td>
                <td><input type="text" name="nombre" required></td>
            </tr>
            <tr>
                <td>password</td>
                <td><input type="text" name="password" minlength=8 required></td>
            </tr>
            <tr>
                <td>student id</td>
                <td><input type="text" name="numEst" maxlength=9 required placeholder ="840270000"></td>
            </tr>
            <tr>
                <td>student year</td>
                <td><input type="number" name="Year" maxlength=1 required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="formbutton" name="submit" value="Entrar!" /></td>
            </tr>
        </table>
    </form>
</body>
</html>