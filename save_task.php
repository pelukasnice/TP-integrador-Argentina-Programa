<?php

include("db.php");

if (isset($_POST['save_task'])){
    $id = $_POST['id'];
    $tipoMov = $_POST['tipoMov'];
    $formaPago = $_POST['formaPago'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];

    $query = "INSERT INTO movimientos(fecha, id_familia, tipo, forma_de_pago, monto, descripcion) VALUES(CURDATE(), '$id', '$tipoMov', '$formaPago', '$monto', '$descripcion')";

    $resultado = mysqli_query($conn, $query);
    if(!$resultado){
        die("Query Failed");
    }

    $_SESSION['message'] = 'Registro creado con éxito.';
    $_SESSION['message_type'] = 'success';

    header("Location: index.php");
}
?>