<?php

    include "conection.php";

    $titulo=$_POST['titulo'];
    $anyo=$_POST['anyo'];

    $sql="INSERT INTO peliculas (titulo, anyo) VALUES ('".$titulo."','".$anyo."');";

    if ($con->query($sql)) {
    echo true;
    }
 ?>
