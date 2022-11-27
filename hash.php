<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8" />

    <title>LOGIN - Estudiantes de Honor UPRA</title>

    <link rel="stylesheet" href="styles.css" type="text/css" />

</head>

 

<body>

<div id="contenido">

    <h1>Estudiantes de Honor - UPRA</h1>

    <h2>Autenticarse</h2>

 

<?php 

        //este código encripta password de récord indicado de tabla de admins

        include_once "db_info.php";

        //traigo el récord del usuario al que quiero encriptar su password

        //eojo... el campo del password debe ser de tamaño 60

        $query = "SELECT * FROM student WHERE student_id='840211111'";

        echo $query;

        if($result = $dbc->query($query))

        {

            if ($result->num_rows==1)

            { 

                $row = $result->fetch_assoc();

                $id = $row['student_id'];

                $pass = '12345678';

                $hash = password_hash($pass, PASSWORD_DEFAULT);

                echo "<p>id: $id</p>";

                echo "<p>pass: $pass</p>";

                echo "<p>hash: $hash</p>";

 

                $query2="UPDATE student SET password='$hash' WHERE student_id=$id";

                echo "<p>$query2</p>";

                if ($dbc->query($query2) === TRUE)

                    print "<p>Tabla de admins ha sido actualizada exitosamente para id: $id </p>";

                  else   

                    print '<p style="color:red;">No se pudo actualizar tabla de admins porque:<br />' . mysqli_error($dbc);

            }

        }

        $dbc->close(); 

    ?>

    </body>

</html>