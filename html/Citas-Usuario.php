        <div id="layoutSidenav_content" style="margin-left: 250px; padding: 20px;">
            <main>
                <h2 style="margin: 25px;">Listado de Citas</h2>
                <div class="table-responsive">

            <table class="tabla-clientes" style="padding: 20px; border-collapse: separate; border-spacing: 20px 0;">
                <thead class ="bg-gray-50">
                    <tr>

                        <th class = "p-4"style="padding-right: 30px;" scope="col-6">ID </th>
                        <th style="padding-right: 30px" scope="col-">Fecha</th>
                        <th style="padding-right: 30px" scope="col-">Hora</th>
                        <th style="padding-right: 30px" scope="col-">Servicio</th>
                        <th style="padding-right: 30px" scope="col-">Barbero</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../php/conexion.php';
                    $sql = $conn->query("SELECT * FROM cita");
                    while($datos = $sql->fetch_object()) {      
                    ?>

                    <tr>
                        <td class ="text-center"><?= $datos->idcita?></td>
                        <td><?= $datos->Fecha ?? $datos->Fecha ?? '' ?></td>
                        <td><?= $datos->Hora ?? $datos->Hora ?? '' ?></td>
                        <td><?= $datos->Servicio ?? $datos->Servicio ?? '' ?></td>
                        <td><?= $datos->Barbero ?? $datos->Barbero ?? '' ?></td>

                        <td>
                            <form class="Baja-Empleado-Form" id="Baja-Empleado-Form" action="../Admin-Dashboard/ABML-Cita/Baja-Cita.php" method="POST" style="display:inline;">
                                <input type="hidden" name="idcita" value="<?= $datos->idcita ?>" />
                                <button type="submit" class="btn btn-small btn-warning" onclick="return confirm('¿Está seguro de cancelar esta cita?');">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
            </tbody>
                    
            </table>
            </div> 
            </main>
        </div>
    </div>