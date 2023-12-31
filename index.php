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
                    <option value="">--Seleccionar--</option>
                    <option value="1">Damian</option>
                    <option value="2">Julia(mama)</option>
                    <option value="3">Alberto</option>
                    <option value="4">Julia</option>
                    <option value="5">Delia</option>          
                </select>

                <label for="tipoMov"><h6>Tipo de movimiento:</h6></label>
                <select id="tipoMov"  name="tipoMov" class="form-control" required>
                    <option value="">--Seleccionar--</option>
                    <option value="ingreso">Ingreso</option>
                    <option value="egreso">Egreso</option>                           
                </select>

                <label for="FormaPago"><h6>Forma de pago:</h6></label>
                <select id="FormaPago" name="formaPago" class="form-control" required>
                    <option value="">--Seleccionar--</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjetaCredito">Tarjeta Credito</option>
                    <option value="transferencia">Transferencia</option>
                    <option value="cheque">Cheque</option>          
                </select>

                    <h6>Monto:</h6>
                    <div class="form-group mb-3">
                        <input type="text" name="monto" class="form-control" required>
                    </div>

                    <h6>Descripcion:</h6>
                    <div class="form-group mb-3">
                        <textarea name="descripcion" id="" rows="2" class="form-control" required></textarea>
                    </div>

                    <input type="submit" class="btn btn-success btn-block" name="save_task" value="Crear Registro">

                </form>

            </div>

        </div>

        <div class="col-md-8">
            <div class="table-responsive overflow-auto" style="max-height: 620px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="col-2">Fecha</th>
                            <th>Tipo</th>
                            <th>Descripcion</th>
                            <th>Monto($)</th>
                            <th>Forma pago</th>
                            <th>Responsable</th>
                            <th class="col-4">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $query = "SELECT 
                        m.id_mov AS id_movimiento,
                        DATE_FORMAT(m.fecha, '%d - %m - %Y') AS fecha_format,
                        m.tipo,
                        m.descripcion,
                        m.monto,
                        m.forma_de_pago,
                        f.nombre AS responsable
                    FROM movimientos m
                    JOIN familiares f ON m.id_familia = f.id_familia
                    ORDER BY m.fecha DESC;";
                        $result_movimientos = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_array($result_movimientos)){ ?>
                            <tr>
                                <td><?php echo $row['id_movimiento'] ?> </td>
                                <td><?php echo $row['fecha_format'] ?> </td>
                                <td><?php echo $row['tipo'] ?> </td>
                                <td><?php echo $row['descripcion'] ?> </td>
                                <td><?php echo $row['monto'] ?> </td>
                                <td><?php echo $row['forma_de_pago'] ?> </td>
                                <td><?php echo $row['responsable'] ?> </td>
                                <td>
                                    <a href="view.php?id_movimiento=<?php echo $row['id_movimiento']?>"class="me-3 btn btn-sm btn-secondary" >
                                    <i class="fa-solid fa-eye"></i>

                                    <a href="edit.php?id_movimiento=<?php echo $row['id_movimiento']?>"class="me-3 btn btn-sm btn-secondary">
                                    <i class="fa-solid fa-pen"class="fa-solid fa-eye"></i>
                                    </a> 

                                    <a href="view_delete.php?id_movimiento=<?php echo $row['id_movimiento']?>"class="me-3 btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                    </a>
                                    
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <div>
                   
        </div>
    </div>

</div>

<?php include("includes/footer.php") ?>