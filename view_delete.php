<?php
include("db.php");

if(isset($_GET['id_movimiento'])){
    $id = $_GET['id_movimiento'];
    $query = "SELECT 
                m.id_mov AS id_movimiento,
                m.fecha,
                m.tipo,
                m.descripcion,
                m.monto,
                m.forma_de_pago,
                f.nombre AS responsable
            FROM movimientos m
            JOIN familiares f ON m.id_familia = f.id_familia
            WHERE m.id_mov = $id"; 
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);
        $tipo = $row['tipo'];
        $descripcion = $row['descripcion'];
        $monto = $row['monto'];
        $formaPago = $row['forma_de_pago'];
        $fecha = $row['fecha'];
        $responsable = $row['responsable'];
    
    }
    
}
?>

<?php include("includes/header.php") ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="delete_task.php?id_movimiento=<?php echo $_GET['id_movimiento']; ?>" method = "POST">
                        <h4 class="card-title">Eliminar Registro</h4>
                        <p><strong>ID del Movimiento:</strong> <?php echo $id;?></p>
                        <p><strong>Responsable:</strong> <?php echo $responsable; ?></p>
                        <p><strong>Fecha:</strong> <?php echo $fecha; ?></p>
                        <p><strong>Tipo:</strong> <?php echo $tipo; ?></p>
                        <p><strong>Descripción:</strong> <?php echo $descripcion; ?></p>
                        <p><strong>Monto:</strong> <?php echo $monto; ?></p>
                        <p><strong>Forma de Pago:</strong> <?php echo $formaPago; ?></p>                   
                        
                        <input type="submit" class="btn btn-danger btn-block" name="delete_task" value="Eliminar">
                        <a href="index.php" class="btn btn-secondary btn-block">Atras</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>
