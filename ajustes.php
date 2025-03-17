<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "puli_lavado";

$conexion = new mysqli($servidor, $usuario, $contraseña, $base_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Registrar cliente
    if (!empty($_POST['nombre_cliente']) && !empty($_POST['telefono_cliente']) && !empty($_POST['email_cliente'])) {
        $nombre_cliente = $conexion->real_escape_string($_POST['nombre_cliente']);
        $telefono_cliente = $conexion->real_escape_string($_POST['telefono_cliente']);
        $email_cliente = $conexion->real_escape_string($_POST['email_cliente']);

        $sql_cliente = "INSERT INTO clientes (nombre, telefono, email) VALUES ('$nombre_cliente', '$telefono_cliente', '$email_cliente')";
        if ($conexion->query($sql_cliente) === TRUE) {
            echo "<p>Cliente registrado exitosamente.</p>";
        } else {
            echo "<p>Error al registrar cliente: " . $conexion->error . "</p>";
        }
    }

    // Registrar vehículo
    if (!empty($_POST['marca_vehiculo']) && !empty($_POST['modelo_vehiculo'])) {
        $marca_vehiculo = $conexion->real_escape_string($_POST['marca_vehiculo']);
        $modelo_vehiculo = $conexion->real_escape_string($_POST['modelo_vehiculo']);

        $sql_vehiculo = "INSERT INTO vehiculos (marca, modelo) VALUES ('$marca_vehiculo', '$modelo_vehiculo')";
        if ($conexion->query($sql_vehiculo) === TRUE) {
            echo "<p>Vehículo registrado exitosamente.</p>";
        } else {
            echo "<p>Error al registrar vehículo: " . $conexion->error . "</p>";
        }
    }

    // Registrar servicio
    if (!empty($_POST['descripcion_servicio']) && !empty($_POST['precio_servicio'])) {
        $descripcion_servicio = $conexion->real_escape_string($_POST['descripcion_servicio']);
        $precio_servicio = $conexion->real_escape_string($_POST['precio_servicio']);

        $sql_servicio = "INSERT INTO servicios (descripcion, precio) VALUES ('$descripcion_servicio', '$precio_servicio')";
        if ($conexion->query($sql_servicio) === TRUE) {
            echo "<p>Servicio registrado exitosamente.</p>";
        } else {
            echo "<p>Error al registrar servicio: " . $conexion->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Unificado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        header {
            background: #35424a;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }
        form {
            margin: 20px 0;
            padding: 20px;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #35424a;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Registro Unificado</h1>
    </header>

    <form method="POST">
        <!-- Registrar Cliente -->
        <h2>Registrar Cliente</h2>
        <input type="text" name="nombre_cliente" placeholder="Nombre del Cliente">
        <input type="text" name="telefono_cliente" placeholder="Teléfono del Cliente">
        <input type="email" name="email_cliente" placeholder="Email del Cliente">

        <!-- Registrar Vehículo -->
        <h2>Registrar Vehículo</h2>
        <input type="text" name="marca_vehiculo" placeholder="Marca del Vehículo">
        <input type="text" name="modelo_vehiculo" placeholder="Modelo del Vehículo">

        <!-- Registrar Servicio -->
        <h2>Registrar Servicio</h2>
        <input type="text" name="descripcion_servicio" placeholder="Descripción del Servicio">
        <input type="number" name="precio_servicio" step="0.01" placeholder="Precio del Servicio">

        <!-- Botón de envío -->
        <button type="submit">Registrar Todo</button>
    </form>
</body>
</html>

<?php
// Cerrar conexión
$conexion->close();
?>
