<?php require_once "header.php" ?>

<?php




$conn = Container::getBanco();




$crianca1 = new Crianca;


$crud = new CrudCrianca($conn, $crianca1);

echo "</pre>";

?>


<div class="ui vertical stripe segment">

	<div class="ui grid container">



		<table class="ui celled table" id="dataTableCrianca">
			<thead>
				<tr>

					<th>Data Inscrição</th>
					<th>Renda Per Capita</th>

					<th>Código</th>

					<th>Horário Atual</th>
					<th>Horário Desejado</th>
					<th>Turma</th>
					<th>Responsavel</th>
					<th>CEI</th>
					<th>Status</th>
				</tr>
			</thead>
			<tfoot>
				<tr>

					<th>Data Inscrição</th>
					<th>Renda Per Capita</th>
					<th>Código</th>
					<th>Horário Atual</th>
					<th>Horário Desejado</th>
					<th>Turma</th>

					<th>Responsavel</th>
					<th>CEI</th>
					<th>Status</th>
				</tr>
			</tfoot>
			<tbody>
				<?php
				//if ($cei_cod>0){
				$lista = $crud->listAtivosPorCei($cei_cod);
				//	}else{
				//		$lista = $crud->listAtivos();
				//	}
				?>

				<?php foreach ($lista as $key => $value) {   ?>
					<tr>

						<td><?php echo $value->getDataCad()  ?></td>
						<td>R$ <?php echo $value->getPerCapita()  ?></td>
						<td><?php echo $value->getCodigo()  ?></td>
						<td><?php echo $value->getHorarioAtualDescricao()  ?></td>
						<td><?php echo $value->getHorarioDesejadoDescricao()  ?></td>
						<td><?php echo $value->getTurma()  ?></td>
						<td><?php echo $value->getNomeResponsavelMask()   ?></td>
						<td><?php echo $value->getAllCeis()  ?></td>
						<td><?php if ($value->getConfirmado() == 1) {  ?>
								Aprovado na 1° Fase
								<?php } else {
								if ($value->getConfirmado() == 5) { ?>
									Desistência


									<?php } else {
									if ($value->getConfirmado() == 0) { ?>
										Aguardando Análise
										<?php } else {
										if ($value->getConfirmado() == 3) { ?>
											Aprovado na 2° Fase

											<?php } else {
											if ($value->getConfirmado() == 4) { ?>
												Aguardando Atualizar de Documentação

											<?php   } else {

											?>
												Negado:
												<?php echo $value->getMotivoNegado();
											}
										}
									}
								}
							} ?>


						</td>


					</tr>

				<?php  } ?>


			</tbody>
		</table>


	</div>
</div>


<!-- /.container-fluid -->
<!-- Bootstrap core JavaScript-->
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		var table = $('#dataTableCrianca').DataTable({
			"language": {
				"lengthMenu": "Número de Registros  _MENU_  Por Páginas",
				"zeroRecords": "Nenhum registro encontrado",
				"info": "Vocês está na página  _PAGE_ de _PAGES_",
				"infoEmpty": "Nenhum registro encontrado",
				"infoFiltered": "(registros filtrados _MAX_ no total)",
				"search": "Pesquisar",
				"Previous": "Voltar",
				"Next": "Próximo",

			},
			"lengthChange": false,
			"buttons": ['copy', 'excel', 'pdf', 'colvis'],
			"buttons": [
				'excel',
				'pdf',
				'print',
				'colvis'
			],
			"pageLength": 50,
			"order": [
				[1, 'asc']
			]
		});
		table.buttons().container()
			.appendTo($('div.eight.column:eq(0)', table.table().container()));

		var table1 = $('#dataTableCrianca1').DataTable({
			lengthChange: false,
			buttons: ['copy', 'excel', 'pdf', 'colvis']
		});

		table1.buttons().container()
			.appendTo($('div.eight.column:eq(0)', table.table().container()));
	});
</script>


<?php require_once "footer.php" ?>