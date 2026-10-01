<?php
// index.php
include 'includes/header.php';
?>

<main class="container my-4">
    <section class="card shadow p-4 mx-auto" style="max-width: 600px;">
        <h2 class="mb-3 text-center">Formulario de Registro de Aspirantes</h2>
        
        <!-- El formulario debe apuntar a procesar.php y usar enctype para las fotos -->
        <form action="procesar.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre (Requerido):</label>
                <input type="text" name="nombre" class="form-control" required placeholder="Ej. Juan">
            </div>

            <div class="mb-3">
                <label class="form-label">Apellido (Requerido):</label>
                <input type="text" name="apellido" class="form-control" required placeholder="Ej. Pérez">
            </div>

            <div class="mb-3">
                <label class="form-label">Identificación (Requerido):</label>
                <input type="text" name="identificacion" class="form-control" required placeholder="Ej. 8-123-456">
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Nacimiento (Requerido):</label>
                <input type="date" name="fecha_nacimiento" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Sexo (Requerido):</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" value="Hombre" required>
                    <label class="form-check-label">Hombre</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" value="Mujer" required>
                    <label class="form-check-label">Mujer</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Fotografía del Aspirante (png, jpg, jpeg, gif):</label>
                <input type="file" name="foto" class="form-control" accept=".png, .jpg, .jpeg, .gif" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrar Aspirante</button>
        </form>
    </section>
</main>

<?php
include 'includes/footer.php';
?>