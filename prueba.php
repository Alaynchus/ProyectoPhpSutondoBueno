<?php
    require_once 'conexion.php';

    $sql = "SELECT id, name_es FROM recipes where id=50 and state='approved'";

// Ejecutar la consulta y obtener los resultados
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
                            <h1>Calendario de Productos</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vulputate eros laoreet, facilisis odio vitae, sagittis mauris. Nam facilisis neque nec felis consequat gravida.</p>
                        </div>
                    </div>
                </div>
        </header>
            
        <main>
            <div class="d-flex justify-content-center">
                <div class="row d-flex gap-3 column-gap-0 m-5 w-75 card-deck">
                    <?php 
                    if ($result->num_rows > 0) {
                        // Iterar sobre cada fila de datos
                        while ($row = $result->fetch_assoc()) {
                            // Acceder a los datos de cada columna
                            echo' 
                            <div class="col-4 col-lg-3">
                                <div id="'.$row["id"].'" class="card w-75">
                                    <img src="img/platoGenerico.jpg" class="card-img-top"
                                        alt="Hollywood Sign on The Hill" />
                                    <div class="card-body">
                                        <h5 class="card-title">'. $row["name_es"] .'</h5>
                                        <a href="receta.php?id='.$row["id"].'" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div> ';
                        }
                    } else {
                        echo "No se encontraron resultados.";
                    }?>
                    
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
<?php 
    $conn->close();    
?>