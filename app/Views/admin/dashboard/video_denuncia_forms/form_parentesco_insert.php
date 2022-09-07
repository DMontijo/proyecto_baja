<form id="form_parentesco_insert" action="" method="post" class="row p-0 m-0 needs-validation" novalidate>

	<div class="col-12">
		<p class="font-weight-bold text-center mt-3">PARENTESCO</p>
	</div>
	<hr>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="personaFisica1_I" class="form-label font-weight-bold">Persona fisica 1</label>
		<select class="form-control" id="personaFisica1_I" name="personaFisica1_I"required>
			<?php foreach ($body_data->personafisica as $index => $personafisica) {?>
				<option value="<?= $personafisica->PERSONAFISICAID ?>"> <?= $personafisica->NOMBRE . ' ' . $personafisica->SEGUNDOAPELLIDO ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="parentesco_mf_I" class="form-label font-weight-bold">Parentesco</label>
		<select class="form-control" id="parentesco_mf_I" name="parentesco_mf_I" required>
			<?php
			foreach ($body_data->parentesco as $index => $parentesco) { ?>
				<option value="<?= $parentesco->PERSONAPARENTESCOID ?>"> <?= $parentesco->PERSONAPARENTESCODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="personaFisica2_I" class="form-label font-weight-bold">Persona fisica 2</label>
		<select class="form-control" id="personaFisica2_I" name="personaFisica2_I" required>
			<option selected value=""></option>
			
		</select>
	</div>

	<div class="col-12 mb-3 text-center">
		<button type="submit" id="insertParentesco" name="insertParentesco" class="btn btn-primary font-weight-bold">AGREGAR PARENTESCO</button>
	</div>

</form>
<script>
	let personaFisica1_I = document.getElementById("personaFisica1_I")
	let personaFisica2_I = document.getElementById("personaFisica2_I")

	//recorrer hijos del segundo select

	// function selectBonito() {
	// 	//const index = personaFisica1_I.selectedIndex;
	// 	var datos = {
	// 		"id": personaFisica1_I.value
	// 	}
	// 	console.log(datos);
	// 	$.ajax({
	// 		method: 'POST',
	// 		url: "<?= base_url('/data/get-personafisicofiltro') ?>",
	// 		data: datos,
	// 		dataType: 'JSON',
	// 		//data: {nombre:n},
	// 		success: function(response) {
	// 			$("#respa").val(d[0]); // ID de la 1era caja de texto
	// 			$("#respa2").html('<option value="' + d[1] + '">' + d[1] + '</option>'); // ID de la 2da caja de texto

	// 		}

	// 	});
	// }


	// personaFisica1_I.addEventListener("change", function() {



	// 	// let arregloFinal = arreglo.filter(arreglo=> arreglo.PERSONAFISICAID != personaFisica1_I.value);
	// 	// alert(arreglo);
	// 	// alert(arregloFinal);
	// 	// for (let i = personaFisica2_I.options.length; i>=0; i--) {
	// 	// personaFisica2_I.remove(i);			
	// 	// }
	// 	// arregloFinal.forEach(function(value, index) {

	// 	// 	let option = document.createElement('option');
	// 	// 	option.value = arregloFinal[index].PERSONAFISICAID;
	// 	// 	option.text = arregloFinal[index].NOMBRE;
	// 	// 	personaFisica2_I.appendChild(option);
	// 	// });
	// 	// alert(personaFisica2_I);
	// });
</script>