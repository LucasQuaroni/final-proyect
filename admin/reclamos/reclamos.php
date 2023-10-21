<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Reclamos</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="header">
        <div class="logo">
            <a href="../index.html">
                <img src="logo-fornax-png.png">
            </a>
        </div>
        <nav class="menu">
            <div class="nav-links">
                <a href="../admin.php">Volver</a>
            </div>
            <div class="nav-links">
                <a href="../../reclamos/cliente.html">Alta manual</a>
            </div>
        </nav>
    </div>
    <div class="table-container">
        <h1>Reclamos</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DNI del denunciante</th>
                    <th class="wider-cell">Fecha de alta</th>
                    <th>Serial del producto</th>
                    <th>Descripción del reclamo</th>
                    <th>ID Admin</th>
                    <th>ID Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('consultar_reclamos.php');
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function actualizarReclamo(idReclamo) {
            // Recopila los valores de ID Admin e ID Estado desde la fila
            const idAdmin = document.getElementById(`idadmin_${idReclamo}`).value;
            const idEstado = document.getElementById(`idestado_${idReclamo}`).value;

            // Verifica si los campos están completos
            if (!idAdmin || !idEstado) {
                alert('Por favor, complete ambos campos.');
                return;
            }

            // Crea un formulario y agrega los campos
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'actualizar_reclamos.php';

            const idAdminInput = document.createElement('input');
            idAdminInput.type = 'hidden';
            idAdminInput.name = 'idadmin';
            idAdminInput.value = idAdmin;

            const idEstadoInput = document.createElement('input');
            idEstadoInput.type = 'hidden';
            idEstadoInput.name = 'idestado';
            idEstadoInput.value = idEstado;

            const reclamoIdInput = document.createElement('input');
            reclamoIdInput.type = 'hidden';
            reclamoIdInput.name = 'reclamo_id';
            reclamoIdInput.value = idReclamo;

            form.appendChild(idAdminInput);
            form.appendChild(idEstadoInput);
            form.appendChild(reclamoIdInput);

            // Agrega el formulario al cuerpo del documento y envíalo
            document.body.appendChild(form);
            form.submit();
        }

    </script>
</body>

</html>