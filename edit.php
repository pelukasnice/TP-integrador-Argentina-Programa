<?php
include("db.php");

if(isset($_GET['id_movimiento'])){
    $id = $_GET['id_movimiento'];
    $query = "SELECT * FROM movimientos WHERE id_mov = $id";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);
        $tipo = $row['tipo'];
        $descripcion = $row['descripcion'];
        $monto = $row['monto'];
        $formaPago = $row['forma_de_pago'];
    }

}

if (isset($_POST['update_task'])){
    $id = $_GET['id_movimiento'];
    $tipo = $_POST['tipoMov'];
    $formaPago = $_POST['formaPago'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];
    
    $query = "UPDATE movimientos set tipo = '$tipo', forma_de_pago = '$formaPago', descripcion = '$descripcion', monto = '$monto' WHERE id_mov = $id";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Registro actualizado satisfactoriamente';
    $_SESSION['message_type'] = 'warning';

    header("Location: index.php");
}
 


?>


<?php  include("includes/header.php")?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php?id_movimiento=<?php echo $_GET['id_movimiento']; ?>" method = "POST">
                <h3>Actualizar registro ID = <?php echo $id ?></h3>
                    <div class="form-group">
                    <label for="tipoMov"><h6>Tipo de movimiento:</h6></label>
                    <select id="tipoMov" name="tipoMov" class="form-control" required>
                        <option value="">--Seleccionar--</option>
                        <option value="ingreso" <?php if ($tipo === 'ingreso') echo 'selected'; ?>>Ingreso</option>
                        <option value="egreso" <?php if ($tipo === 'egreso') echo 'selected'; ?>>Egreso</option>
                    </select>

                    <label for="FormaPago"><h6>Forma de pago: </h6></label>
                    <select id="FormaPago" name="formaPago" class="form-control" required>
                        <option value="">--Seleccionar--</option>
                        <option value="efectivo" <?php if ($formaPago === 'efectivo') echo 'selected'; ?>>Efectivo</option>
                        <option value="tarjeta de credito" <?php if ($formaPago === 'tarjeta de crédito') echo 'selected'; ?>>Tarjeta Credito</option>
                        <option value="transferencia bancaria" <?php if ($formaPago === 'transferencia bancaria') echo 'selected'; ?>>Transferencia</option>
                        <option value="cheque" <?php if ($formaPago === 'cheque') echo 'selected'; ?>>Cheque</option>
                    </select>

                    <h6>Monto:</h6>
                    <div class="form-group mb-3">
                        <input type="text" name="monto" class="form-control" value="<?php echo $monto; ?>">
                    </div>

                    <h6>Descripcion:</h6>
                    <div class="form-group mb-3">
                        <textarea name="descripcion" rows="2" class="form-control"><?php echo $descripcion; ?></textarea>
                    </div>

                    <input type="submit" class="btn btn-primary btn-block" name="update_task" value="Actualizar">

                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

<?php include("includes/footer.php") ?>



