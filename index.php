<?php
 include "conection.php";
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Prueba - Teinor</title>
        <link rel="stylesheet" type="text/css" href="estilos.css"/>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("nav").hide();
                $("#anadir").click(function(){

                        $("nav").toggle("slow");

                });
                $("#crear").click(function() {
                    titulo=$("#n_pelicula").val();
                    anyo=$("#a_pelicula").val();
                    if (anyo!=""&&anyo.length==4&&titulo!="") {
                        $.ajax({
                            method:"POST",
                            url:"ins_pelicula.php",
                            dataType:"json",
                            data:{
                                titulo:titulo,
                                anyo:anyo,
                            },
                            success:function(suc){
                                valorOrder = $("#order").val();
                                mostrar("",valorOrder);
                            }
                        });
                    }

                });

                 $("#buscador").keyup(function(){
                    datoBuscador=$("#buscador").val();
                    valorOrder = $("#order").val();
                    mostrar(datoBuscador,valorOrder);
                 });

                 $("#order").on("change",function(){
                    datoBuscador=$("#buscador").val();
                     valorOrder = $("#order").val();
                     mostrar(datoBuscador,valorOrder);
                 });


                function mostrar(texto="",orden=""){
                    // alert(texto);
                    $.ajax({
                        type:"POST",
                        url:"bus_peliculas.php",
                        dataType:'json',
                        data:{
                            texto:texto,
                            orden:orden
                        },
                        success:function(data){
                            console.log(data);
                            var datax=$.parseJSON(data);
                            // alert(datax);
                            mostrar_peliculas ='';
                            $("#tabla_body").empty();
                            // mostrar_series="";
                            $.each(datax, function(i, item) {
                                mostrar_peliculas+="<tr><td>"+item.titulo+"</td><td>"+item.anyo+"</td></tr>";
                            });
                            $("#tabla_body").append(mostrar_peliculas);
                        }
                    })
                };
                mostrar();
            });
        </script>
    </head>
    <body>
        <header>
            <button type="button" id="anadir" name="button">Añadir</button>
            <input type="text" id="buscador" name="Buscador" value="" placeholder="Buscar...">
            <select class="order" name="order" id="order">
                <option value="np">Nuevas primero</option>
                <option value="ap">Antiguas primero</option>
            </select>
        </header>
        <nav class="">
            <form method="post">
                <input type="text" name="n_pelicula" id="n_pelicula" value="" placeholder="Titulo de la pelicula" maxlength="100" required>
                <input type="text" name="a_pelicula" id="a_pelicula" value="" placeholder="Año de la pelicula" pattern="([0-9]{4})" maxlength="4" required>
                <button type="button" name="button" id="crear">Crear</button>
            </form>
        </nav>
        <section>
            <table cellspacing="0">
                <thead>
                    <tr id="header">
                        <th>Titulo</th>
                        <th>Año</th>
                    </tr>
                </thead>
                <tbody id="tabla_body">
                </tbody>
            </table>
        </section>
    </body>
</html>
