<?php
    if (isset($_GET['id'])) {
        $idSeleccionado = $_GET['id'];
    } 
    require_once 'conexion.php';
    //Recoger nombre, elaboracion, famlias y si es vegano y vegetariano
    $sql = "SELECT name_es, description_es, family_id, vegan, vegetarian FROM recipes where id=".$idSeleccionado;

    // Ejecutar la consulta y obtener los resultados
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $description=$row["description_es"];
    $name=$row["name_es"];
    $vegan=$row["vegan"];
    $vegetarian=$row["vegetarian"];
    $familyId=$row["family_id"];
    
    //Recoger nombre de la familia
    if($familyId != null){
        $sql = "SELECT name_es FROM families where item_type='recipe' and id=".$familyId;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $familyName = $row['name_es'];
    }
    else{
        $familyName = "No especificada";
    }

    $sql = "SELECT ingredients.id, ingredients.name_es, recipe_items.quantity, recipe_id FROM ingredients, recipe_items
    WHERE recipe_id=50 and ingredients.id=recipe_items.item_id
    ";
    $result = $conn->query($sql);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Calendario de productos</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
        
        <link href="fontawesome/css/brands.css" rel="stylesheet">
        <link href="fontawesome/css/solid.css" rel="stylesheet">
        <link href="fontawesome/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/calendario.css">
    </head>
    <body>
        <header>
                <div id="superior" class="row  d-flex justify-content-center text-center">
                    <nav class="row bg-white bg-opacity-25">
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active text-body" href="#">Calendario productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-body" href="#">Cuidados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-body" href="#">Usos gastronomicos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-body" href="#">Recetas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-body">Vídeos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-body">Blog</a>
                            </li>
                        </ul>
                    </nav>
        
                    <div id="logos_principal" class="row m-5 mb-4">
                        <div class="col-2 m-0 foto">
                            <img src="img/logo_gamarra_footer.png" alt="logo_gamarra">
                        </div>
                        <div class="col-2 m-0 foto">
                            <img src="img/arkaute.png" alt="logo_arkaute">
                        </div>
                        <div class="col-6">
                            <h1>Recetas</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vulputate eros laoreet, facilisis odio vitae, sagittis mauris. Nam facilisis neque nec felis consequat gravida.</p>
                        </div>
                    </div>
                </div>
        </header>
            
        <main>
            <div class="container  m-5">
                <div class="row justify-content-center column-gap-5">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-12">
                                <?php 
                                    echo '<h3>'.$name.'</h3>'
                                ?>
                                
                            </div>
                        </div>
                        <div class="row">    
                            <div class="col-12 mt-2">
                                Familia: <?php echo $familyName ?> <br>
                                <hr>
                                Vegano: 
                                <?php 
                                    if($vegan==1){
                                        echo'<img src="img/check.jpg" width="20px" height="20px"> ';
                                    }
                                    else{
                                        echo'<img src="img/cross.png" width="20px" height="20px">';
                                    
                                    }
                                ?>
                                Vegetariano
                                <?php 
                                    if($vegetarian==1){
                                        echo'<img src="img/check.jpg" width="20px" height="20px">';
                                    }
                                    else{
                                        echo'<img src="img/cross.png" width="20px" height="20px"> ';
                                    
                                    }
                                ?>
                                <hr>
                                Alergenos<br>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <img src="img/wok_de_verduras_salteadas_con_salsa_de_soja.jpg" class="h-100 w-100"  >
                    </div>
                </div>
                <div class="row justify-content-center column-gap-5">
                    <div id="elaboracion" class="col-4 mt-5">
                        <p>Elaboraci&oacute;n</p>
                        <hr>
                        <?php
                            
                            echo $description;
                        ?>    
                    </div>
                    <div class="col-4">
                        <div id="divListado" class="p-3">
                            <div class="row mb-2">
                                <h5><strong>Ingredientes para 5 raciones/unidades</strong></h5>
                            </div>
                            <div id="listadoIngredientes" class="row justify-content-center">                               
                                <div class="col-6">
                                    <?php
                                    if ($result->num_rows > 0) {
                                        // Iterar sobre cada fila de datos
                                        
                                        if(($result->num_rows % 2) == 0){
                                            $numMitadFilas = ($result->num_rows)/2;
                                        }
                                        else{
                                            $numMitadFilas = ($result->num_rows)/2 +0.5;
                                        }
                                        $numIngreEscri = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            if ($numIngreEscri < $numMitadFilas){
                                                echo ' 
                                                <p><span>'.$row["name_es"].'</span>   2.0 ud</p>
                                                <hr>
                                                ';
                                                $numIngreEscri++;
                                                if($numIngreEscri == $numMitadFilas){
                                                    echo '
                                                    </div> 
                                                    <div class="col-6 row-gap-1">';
                                                }
                                            }
                                            else{                                             
                                                echo '
                                                    <p><span>'.$row["name_es"].'</span>   2.0 ud</p>
                                                    <hr>
                                                ';
                                            }                                      
                                        }
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                        </div>
                        <?php 
                            $sql ="SELECT sum(energy), sum(proteins), sum(carbohydrates), sum(fiber), sum(lipids),  sum(saturated), sum(monounsaturated), sum(polyunsaturated), sum(cholesterol), sum(calcium), sum(iron), sum(zinc), sum(vitamin_a), sum(vitamin_c), sum(folic_acid), sum(salt), sum(sugar)
                                    FROM nutritional_infos 
                                    where ingredient_id in 
                                        (select item_id from recipe_items 
                                        where recipe_id=".$idSeleccionado.");";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();

                        ?>
                        <div class="row justify-content-center mt-4">
                            <div class="text-center">
                                <div class="">
                                    <h5><strong>Informacion nutricional (1 raci&oacute;n)</strong></h5>
                                    <p>Energia: <strong><?php echo $row["sum(energy)"] ?>kcal</strong></p>
                                    <p>Carbohidratos: <strong><?php echo $row["sum(carbohydrates)"] ?>g</strong></p>
                                    <p>Proteinas: <strong><?php echo $row["sum(proteins)"] ?>g</strong></p>
                                    <p>Grasas: <strong><?php echo $row["sum(lipids)"] ?>g</strong></p>
                                </div>
                            </div>   
                        </div>
                        <div id="infoNutri" class="row">
                            <div class="col-6">
                                <table>
                                    <tr>
                                        <td><strong>Acidos grasos saturados</strong></td>
                                        <td><?php echo $row["sum(saturated)"] ?>g</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Acidos grasos polisaturados</strong></td>
                                        <td><?php echo $row["sum(polyunsaturated)"] ?>g</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Calcio</strong></td>
                                        <td><?php echo $row["sum(calcium)"] ?>mg</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Zinc</strong></td>
                                        <td><?php echo $row["sum(zinc)"] ?>mg</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Vitamina</strong></td>
                                        <td><?php echo $row["sum(vitamin_c)"] ?>22</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Sal (Sodio)</strong></td>
                                        <td><?php echo $row["sum(salt)"] ?>mg</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <table>
                                    <tr>
                                        <td><strong>Fibra</strong></td>
                                        <td><?php echo $row["sum(fiber)"] ?>g</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Acidos grasos monoinsaturados</strong></td>
                                        <td><?php echo $row["sum(monounsaturated)"] ?>g</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Colesterol</strong></td>
                                        <td><?php echo $row["sum(cholesterol)"] ?>mg</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Hierro</strong></td>
                                        <td><?php echo $row["sum(iron)"] ?>mg</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Vitamina</strong></td>
                                        <td><?php echo $row["sum(vitamin_a)"] ?>ug</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Acido folico</strong></td>
                                        <td><?php echo $row["sum(folic_acid)"] ?>ug</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Azucares</strong></td>
                                        <td><?php echo $row["sum(sugar)"] ?>g</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div id="logos_footer" class="row">
                <div class="col-4">
                    <img width="50%"  class="logo_footer" src="img/GobiernoVasco_Educacion.jpg" alt="logo_Govierno_Vasco">
                </div>
                <div class="col-4">
                    <img width="50%" class="logo_footer" src="img/Lanbide_heziketa.jpg" alt="logo_lanbide_heziketa">
                </div>
                <div class="col-4">
                    <img width="50%" class="logo_footer" src="img/TKNIKA.jpg" alt="logo_tknika">
                </div>
            </div>
        </main>
        <footer>
            <div class="row mt-5">
                <div class="col-6 izquierda mt-3">
                    <p>&#169 hosteleria gamarra</p>
                </div>
                <div class="col-6 derecha mt-3">
                    <p>Aviso Legal y Política de Privacidad - Política de Cookies</p>
                </div>
            </div>
        </footer>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>