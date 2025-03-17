<?php

$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "puli_lavado";

$conexion = new mysqli($servidor, $usuario, $contraseña, $base_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

<?php
$conexion->close();
?>
