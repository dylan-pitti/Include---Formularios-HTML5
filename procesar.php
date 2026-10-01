<?php
// Incluir el encabezado (el breadcrumb detectará automáticamente que estamos en procesar.php)
include 'includes/header.php';
?>

<main class="container my-4">
    <section class="card shadow p-4 mx-auto" style="max-width: 600px;">
        <h2 class="mb-3 text-center text-primary">Resultado del Registro</h2>

        <?php
        // Verificar si los datos fueron enviados por POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // 1. Saneamiento y Limpieza básica (Seguridad contra XSS)
            $nombre = ucwords(strtolower(trim(strip_tags($_POST['nombre']))));
            $apellido = ucwords(strtolower(trim(strip_tags($_POST['apellido']))));
            $identificacion = strtoupper(trim(strip_tags($_POST['identificacion'])));
            $fechaNacimiento = $_POST['fecha_nacimiento'];
            $sexo = $_POST['sexo'];

            // 2. Validación de Edad (18 a 70 años)
            $fechaActual = new DateTime();
            $nacimiento = new DateTime($fechaNacimiento);
            $edad = $fechaActual->diff($nacimiento)->y;

            if ($edad < 18 || $edad > 70) {
                echo '<div class="alert alert-danger" role="alert">Error: La edad del aspirante es de ' . $edad . ' años. Debe estar entre 18 y 70 años para ser admitido.</div>';
                echo '<a href="index.php" class="btn btn-secondary w-100">Regresar al Formulario</a>';
            } else {
                // 3. Procesamiento de la Fotografía
                $directorioSubida = 'uploaded_files/';
                
                // Asegurar que la carpeta exista
                if (!is_dir($directorioSubida)) {
                    mkdir($directorioSubida, 0755, true);
                }

                $nombreArchivo = basename($_FILES['foto']['name']);
                $rutaDestino = $directorioSubida . time() . '_' . $nombreArchivo; // Evitar nombres duplicados con time()
                $tipoArchivo = strtolower(pathinfo($rutaDestino, PATHINFO_EXTENSION));

                // Extensiones permitidas
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($tipoArchivo, $extensionesPermitidas)) {
                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
                        
                        // Mostrar los datos procesados con éxito
                        echo '<div class="alert alert-success">¡Aspirante registrado y validado con éxito!</div>';
                        echo '<p><strong>Nombre completo:</strong> ' . $nombre . ' ' . $apellido . '</p>';
                        echo '<p><strong>Identificación:</strong> ' . $identificacion . '</p>';
                        echo '<p><strong>Edad calculada:</strong> ' . $edad . ' años</p>';
                        echo '<p><strong>Sexo:</strong> ' . $sexo . '</p>';
                        echo '<div class="text-center my-3"><img src="' . $rutaDestino . '" class="img-thumbnail" width="150" alt="Foto Aspirante"></div>';
                        echo '<a href="index.php" class="btn btn-primary w-100 mt-3">Registrar otro aspirante</a>';

                    } else {
                        echo '<div class="alert alert-danger">Hubo un error al subir la fotografía al servidor.</div>';
                        echo '<a href="index.php" class="btn btn-secondary w-100">Regresar</a>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Formato de imagen no permitido. Solo se aceptan JPG, JPEG, PNG, GIF o WEBP.</div>';
                    echo '<a href="index.php" class="btn btn-secondary w-100">Regresar</a>';
                }
            }
        } else {
            // Si intentan entrar directamente por la URL sin pasar por el formulario
            echo '<p class="text-danger text-center">Acceso no autorizado.</p>';
            echo '<a href="index.php" class="btn btn-primary w-100">Ir al Formulario</a>';
        }
        ?>
    </section>
</main>

<?php
// Incluir el pie de página
include 'includes/footer.php';
?>