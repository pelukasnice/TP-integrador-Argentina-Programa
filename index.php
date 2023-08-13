<?php include("db.php") ?>
<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">

        <div class="col-md-4">

            <?php if(isset($_SESSION['message'])) { ?>
                
                <div class="alert alert-<?= $_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
                 <?= $_SESSION['message'] ?>   
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php session_unset();} ?> <!-- limpia los datos que hay en session, se cierra el mensaje verde, sino esta siempre desplegado -->

            <div class="card card-body">
                <form action="save_task.php" method="POST">

                <label for="nombre"><h6>Nombre:</h6></label>
                <select id="nombre" name="id" class="form-control" required>
                    <option value="1">Damian</option>
                    <option value="2">Julia(mama)</option>
                    <option value="3">Alberto</option>
                    <option value="4">Julia</option>
                    <option value="5">Delia</option>          
                </select>

                <label for="tipoMov"><h6>Tipo de movimiento:</h6></label>
                <select id="tipoMov"  name="tipoMov" class="form-control" required>
                    <option value="ingreso">Ingreso</option>
                    <option value="egreso">Egreso</option>                           
                </select>

                <label for="FormaPago"><h6>Forma de pago:</h6></label>
                <select id="FormaPago" name="formaPago" class="form-control" required>
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjetaCredito">Tarjeta Credito</option>
                    <option value="transferencia">Transferencia</option>
                    <option value="cheque">Cheque</option>          
                </select>

                    <h6>Monto:</h6>
                    <div class="form-group mb-3">
                        <input type="text" name="monto" class="form-control">
                    </div>

                    <h6>Descripcion:</h6>
                    <div class="form-group mb-3">
                        <textarea name="descripcion" id="" rows="2" class="form-control"></textarea>
                    </div>

                    <input type="submit" class="btn btn-success btn-block" name="save_task" value="Guardar">

                </form>

            </div>

        </div>

        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Descripcion</th>
                        <th>Monto($)</th>
                        <th>Forma pago</th>
                        <th>Responsable</th>
                        <th class="col-2">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = "SELECT 
                    m.id_mov AS id_movimiento,
                    m.fecha,
                    m.tipo,
                    m.descripcion,
                    m.monto,
                    m.forma_de_pago,
                    f.nombre AS responsable
                FROM movimientos m
                JOIN familiares f ON m.id_familia = f.id_familia;
                ";
                    $result_movimientos = mysqli_query($conn, $query);

                    while($row = mysqli_fetch_array($result_movimientos)){ ?>
                        <tr>
                            <td><?php echo $row['id_movimiento'] ?> </td>
                            <td><?php echo $row['fecha'] ?> </td>
                            <td><?php echo $row['tipo'] ?> </td>
                            <td><?php echo $row['descripcion'] ?> </td>
                            <td><?php echo $row['monto'] ?> </td>
                            <td><?php echo $row['forma_de_pago'] ?> </td>
                            <td><?php echo $row['responsable'] ?> </td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['tipo']?>">
                                <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="delete_task.php?id=<?php echo $row['responsable']?>">
                                <i class="fa-solid fa-trash"></i>
                                </a>
                                <a href="view.php?id=<?php echo $row['responsable']?>">
                                <i class="fa-solid fa-pen"></i>
                                </a>
                        </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include("includes/footer.php") ?>