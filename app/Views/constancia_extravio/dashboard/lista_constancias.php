	<?= $this->extend('constancia_extravio/templates/dashboard_template') ?>

	<?= $this->section('title') ?>
	<?php echo $header_data->title ?>
	<?= $this->endSection() ?>

	<?= $this->section('content') ?>
	<div class="row" style="min-height:83vh;">
	    <div class="col-12">
	        <div class="card text-center overflow-auto shadow rounded">
	            <div class="card-body p-0 py-3 p-sm-5">
	                <h1 class="card-title fw-bold">MIS SOLICITUDES DE CONSTANCIAS DE EXTRAVÍO</h1>
	                <?php if (count($body_data->constancias) > 0) { ?>
	                <table class="table table-striped table-hover mt-5">
	                    <thead>
	                        <tr>
	                            <th scope="col">FOLIO</th>
	                            <th scope="col">AÑO</th>
	                            <th scope="col">TIPO DE EXTRAVÍO</th>
	                            <th scope="col">ESTADO</th>
	                            <th scope="col"></th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php foreach ($body_data->constancias as $index => $constancia) { ?>
	                        <tr>
	                            <th scope="row"><?= $constancia->CONSTANCIAEXTRAVIOID  ?></th>
	                            <td><?= $constancia->ANO ?></td>
	                            <td><?= $constancia->EXTRAVIO == 'DOCUMENTOS'
												? $constancia->TIPODOCUMENTO
												: $constancia->EXTRAVIO ?></td>
	                            <td><?= $constancia->STATUS ?></td>
	                            <?php if ($constancia->STATUS == 'FIRMADO') { ?>
	                            <td class="text-center">
	                                <form class="d-inline-block" method="POST"
	                                    action="<?php echo base_url('constancia_extravio/dashboard/download_constancia_pdf') ?>">
	                                    <input type="text" class="form-control" id="folio" name="folio"
	                                        value="<?= $constancia->CONSTANCIAEXTRAVIOID ?>" hidden>
	                                    <input type="text" class="form-control" id="year" name="year"
	                                        value="<?= $constancia->ANO ?>" hidden>
	                                    <button type="submit" class="btn btn-primary mb-3">
	                                        PDF
	                                    </button>
	                                </form>
	                                <form class="d-inline-block" method="POST"
	                                    action="<?php echo base_url('constancia_extravio/dashboard/download_constancia_xml') ?>">
	                                    <input type="text" class="form-control" id="folio" name="folio"
	                                        value="<?= $constancia->CONSTANCIAEXTRAVIOID ?>" hidden>
	                                    <input type="text" class="form-control" id="year" name="year"
	                                        value="<?= $constancia->ANO ?>" hidden>
	                                    <button type="submit" class="btn btn-primary mb-0 mb-sm-3">
	                                        XML
	                                    </button>
	                                </form>
	                            </td>
	                            <?php } ?>
	                            <?php if ($constancia->STATUS != 'FIRMADO') { ?>
	                            <td>EL DOCUMENTO NO HA SIDO FIRMADO</td>
	                            <?php } ?>
	                        </tr>
	                        <?php } ?>
	                    </tbody>
	                </table>
	                <?php } else { ?>
	                <p class="mt-5 text-yellow fw-bolder"> <i class="bi bi-archive"></i> Aún no haz levantado ninguna
	                    solicitud de constancia de extravío</p>
	                <?php } ?>
	            </div>
	        </div>
	    </div>
	</div>
	<?= $this->endSection() ?>