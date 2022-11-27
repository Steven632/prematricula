<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['submit'])){
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
                            header('location: admin/index.php');
                        }
                        else{
                            header('location: users/index.php');
                        }
                    }
                }
                else{
                    echo '<h3>Asegurase de entarar su password correctamemte. <br/> vuelve a intentarlo.... <a href="login.php">login</a></h3>';
                }
                $dbc->close();
            }
        }else
            echo "hola";
        
    }
    ?>


    <h1>Log in</h1>
    <form action="login.php" method="POST">
        <table>
            <tr>
                <td>student id</td>
                <td><input type="text" name="numEst" maxlength=9 required placeholder ="840270000"></td>
            </tr>
            <tr>
                <td>password</td>
                <td><input type="text" name="password" minlength=8 required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="formbutton" name="submit" value="Login" /></td>
            </tr>
        </table>
    </form>
</body>
</html>