<?php
require_once __DIR__ . '/config.php';

// Obtiene todos los estudiantes
$stmt = $pdo->query("SELECT id, nombre, email FROM estudiantes ORDER BY id ASC");
$estudiantes = $stmt->fetchAll();
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Listado de Estudiantes</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: .5rem;
            text-align: left
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: .5rem;
            align-items: end
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: .4rem
        }

        button {
            padding: .5rem 1rem
        }

        .msg {
            background: #f0f0f0;
            padding: .6rem;
            margin-bottom: 1rem
        }
    </style>
</head>

<body>
    <h1>Estudiantes</h1>

    <?php if (!empty($_GET['ok'])): ?>
        <div class="msg">Estudiante añadido correctamente.</div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($estudiantes): ?>
                <?php foreach ($estudiantes as $e): ?>
                    <tr>
                        <td><?= htmlspecialchars($e['id']) ?></td>
                        <td><?= htmlspecialchars($e['nombre']) ?></td>
                        <td><?= htmlspecialchars($e['email']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay estudiantes aún.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Añadir estudiante</h2>
    <form method="post" action="insert.php">
        <label>
            <div>Nombre</div>
            <input type="text" name="nombre" required maxlength="100">
        </label>
        <label>
            <div>Email</div>
            <input type="email" name="email" required maxlength="200">
        </label>
        <button type="submit">Guardar</button>
    </form>

</body>

</html>