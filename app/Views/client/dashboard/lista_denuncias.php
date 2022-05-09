<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card text-center overflow-auto">
                <div class="card-body p-0 py-3 p-sm-5">
                    <h1 class="card-title">MIS DENUNCIAS</h1>
                    <table class="table table-striped table-hover mt-5">
                        <thead>
                            <tr>
                                <th scope="col">Folio</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Delito</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < 20; $i++) { ?>
                                <tr>
                                    <th scope="row">123456789</th>
                                    <td>Otoniel Flores</td>
                                    <td>Robo</td>
                                    <td>En investigación</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>