<?php
include("db.php");


if(isset($_GET['id_movimiento'])){
    $id = $_GET['id_movimiento'];

    $query = "DELETE FROM movimientos WHERE id_mov = $id";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query failed: " . mysqli_error($conn)); // Muestra un mensaje de error si la consulta falla
    }

    $_SESSION['message'] = 'Registro eliminado con éxito';
    $_SESSION['message_type'] = 'danger';
    
    header("Location: index.php"); // Redirige de nuevo a la página principal después de eliminar
} else {
    die("ID de movimiento no proporcionado"); // Manejo de caso en que no se proporciona el ID
}


?>





















