<?php
header('Content-Type: application/json');
require_once 'conexion.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : (isset($_POST['accion']) ? $_POST['accion'] : '');

switch ($accion) {
    case 'listar':
        listarProductos($conn);
        break;
    case 'obtener':
        obtenerProducto($conn);
        break;
    case 'crear':
        crearProducto($conn);
        break;
    case 'actualizar':
        actualizarProducto($conn);
        break;
    case 'eliminar':
        eliminarProducto($conn);
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
}

function listarProductos($conn) {
    $sql = "SELECT p.id, p.nombre, p.precio, t.nombre as tipo 
            FROM productos p 
            LEFT JOIN tipos_productos t ON p.tipo_producto_id = t.id 
            ORDER BY p.id DESC";
    $resultado = mysqli_query($conn, $sql);
    
    $productos = array();
    if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $productos[] = $fila;
        }
    }
    
    echo json_encode($productos);
}

function obtenerProducto($conn) {
    $id = $_GET['id'];
    $sql = "SELECT p.*, p.tipo_producto_id as tipo_id FROM productos p WHERE p.id = $id";
    $resultado = mysqli_query($conn, $sql);
    
    if ($fila = mysqli_fetch_assoc($resultado)) {
        echo json_encode($fila);
    } else {
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
    }
}

function crearProducto($conn) {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $precio = $_POST['precio'];
    $tipo_id = $_POST['tipo'];
    
    $sql = "INSERT INTO productos (nombre, precio, tipo_producto_id) 
            VALUES ('$nombre', $precio, $tipo_id)";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Producto creado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear producto: ' . mysqli_error($conn)]);
    }
}

function actualizarProducto($conn) {
    $id = $_POST['id'];
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $precio = $_POST['precio'];
    $tipo_id = $_POST['tipo'];
    
    $sql = "UPDATE productos SET 
            nombre = '$nombre', 
            precio = $precio, 
            tipo_producto_id = $tipo_id 
            WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Producto actualizado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar producto: ' . mysqli_error($conn)]);
    }
}

function eliminarProducto($conn) {
    $id = $_POST['id'];
    $sql = "DELETE FROM productos WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Producto eliminado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar producto: ' . mysqli_error($conn)]);
    }
}

mysqli_close($conn);
?>