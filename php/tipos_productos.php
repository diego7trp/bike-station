<?php
header('Content-Type: application/json');
require_once 'conexion.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : (isset($_POST['accion']) ? $_POST['accion'] : '');

switch ($accion) {
    case 'listar':
        listarTipos($conn);
        break;
    case 'obtener':
        obtenerTipo($conn);
        break;
    case 'crear':
        crearTipo($conn);
        break;
    case 'actualizar':
        actualizarTipo($conn);
        break;
    case 'eliminar':
        eliminarTipo($conn);
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
}

function listarTipos($conn) {
    $sql = "SELECT * FROM tipos_productos ORDER BY id DESC";
    $resultado = mysqli_query($conn, $sql);
    
    $tipos = array();
    if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $tipos[] = $fila;
        }
    }
    
    echo json_encode($tipos);
}

function obtenerTipo($conn) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tipos_productos WHERE id = $id";
    $resultado = mysqli_query($conn, $sql);
    
    if ($fila = mysqli_fetch_assoc($resultado)) {
        echo json_encode($fila);
    } else {
        echo json_encode(['success' => false, 'message' => 'Tipo no encontrado']);
    }
}

function crearTipo($conn) {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    
    $sql = "INSERT INTO tipos_productos (nombre, descripcion) 
            VALUES ('$nombre', '$descripcion')";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Tipo creado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear tipo: ' . mysqli_error($conn)]);
    }
}

function actualizarTipo($conn) {
    $id = $_POST['id'];
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    
    $sql = "UPDATE tipos_productos SET 
            nombre = '$nombre', 
            descripcion = '$descripcion' 
            WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Tipo actualizado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar tipo: ' . mysqli_error($conn)]);
    }
}

function eliminarTipo($conn) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tipos_productos WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Tipo eliminado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar tipo: ' . mysqli_error($conn)]);
    }
}

mysqli_close($conn);
?>