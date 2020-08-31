<?php

include "conection.php";
$texto=$_POST["texto"];
$order=$_POST["orden"];

if ($order=="np") {
    $sentencia="ORDER BY anyo";
} elseif ($order=="ap") {
    $sentencia="ORDER BY anyo DESC";
} else {
    $sentencia="";
}

$sql="SELECT * FROM peliculas WHERE titulo LIKE '".$texto."%' ".$sentencia.";";
$result = $con->query($sql);

$json="[";
while($row = $result->fetch_assoc()) {
    // $json.="{".$row['titulo'].":".$row['anyo']."}";
    $json.='{"titulo":"'.$row["titulo"].'","anyo":"'.$row["anyo"].'"},';
}
$last_char=substr($json,-1);
    if ($last_char==','){
        $json=substr($json,0,-1);
    }
$json.="]";
echo json_encode($json);
 ?>
