<?php require_once "header.php"; ?>
<?php

$conn = Container::getBanco();




$crianca1 = new Crianca;


$crud = new CrudCrianca($conn, $crianca1);

//echo "</pre>";

?>

<?php require_once "header.php" ?>
<div class="ui vertical stripe segment">

	<div class="ui grid container">
		<form class="ui form" id="formID" action="lista_coordenacao.php?cei=<?php echo $cei_cod; ?>" method="GET">
			<h3> Filtro por Data</h3>
			<h4 class="ui dividing header"> <?php echo $cei_nome;  ?></h4>

			<div class="four fields">
			<div class="field">
					<label>Horário Atual</label>
					<Select  name="horario_atual">
					<option value="0">Todos</option>
					<option value="1">Matutino</option>
					<option value="2">Vespetino</option>
					</Select>
				</div>
				<div class="field">
					<label>Horário Desejado</label>
					<select  name="horario_desejado">

					<option value="0">Todos</option>
					<option value="1">7h às 15h</option>
					<option value="2">8h às 16h</option>
					<option value="3">9h às 17h</option>

					</select>
				</div>
				<div class="field">
					<label>Data Início da Inscrição</label>
					<input type="Date" name="data_inicio" oninput="mascaradata(this)" placeholder="Data de Nascimento" required>
				</div>
				<div class="field ">

					<label>Data Final da Inscrição</label>
					<div class=" ui  fluid action input">
						<input type="Date" name="data_fim" oninput="mascaradata(this)" placeholder="Data de Nascimento" required>
						<button type="submit" class="ui button">Pesquisar</button>
					</div>
				</div>
				<input type="hidden" name="cei" value="<?php echo $cei_cod;  ?>">
				<!--		<div class="field">
                        <label>Filtar</label>
                        <input class="ui button fluid" type="submit" value="Pesquisar">
                    </div>-->
			</div>


			<table class="ui celled table" id="dataTableCriancaCordenacao">
				<thead>
					<tr>
						<th>Posição Geral</th>
						<th>Data Inscrição</th>
						<th>Código</th>
						<th>Nome</th>
						<th>Data Nasc</th>
						<th>Turma Desejada</th>
						<th>Responsavel</th>
						<th>Endereço</th>
						<th>CEI</th>

						<th>Parecer</th>
						<th>Status</th>
						<th>Ações</th>

					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Posição Geral</th>
						<th>Data Inscrição</th>
						<th>Código</th>
						<th>Nome</th>
						<th>Data Nasc</th>
						<th>Turma</th>
						<th>Responsavel</th>
						<th>Endereço</th>
						<th>CEI</th>

						<th>Parecer</th>
						<th>Status</th>
						<th>Ações</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					$data_filtro = False;
					if (
						array_key_exists('data_inicio', $_GET) == 1 and
						array_key_exists('data_fim', $_GET) == 1
					) {
						$data_inicio = $_GET["data_inicio"];
						$data_fim = $_GET["data_fim"];
					} else {
						$data_inicio = 0;
						$data_fim = 0;
					}

					if (
						array_key_exists('horario_desejado', $_GET) == 1 
					) {
						$horario_desejado = $_GET["horario_desejado"];
					} else {
						$horario_desejado = 0;
					}

					if (
						array_key_exists('horario_atual', $_GET) == 1 
					) {
						$horario_atual = $_GET["horario_atual"];
					} else {
						$horario_atual = 0;
					}
					?>

					<?php if (isset($_SESSION['u']) and isset($_SESSION['c'])) { ?>
						<?php foreach ($crud->list($_SESSION['c'], $data_inicio, $data_fim, $horario_desejado, $horario_atual) as $key => $value) {   ?>


							<tr>
								<td><?php echo $value->getId() ?> </td>
								<td><?php echo $value->getDataCad()  ?></td>
								<td><?php echo $value->getCodigo()  ?></td>
								<td><?php echo $value->getNome() . " " . $value->getSobrenome()  ?></td>
								<td><?php echo $value->getDataNasc()  ?></td>
								<td><?php echo $value->getTurma()  ?></td>
								<td><?php echo $value->getNomeResponsavel()   ?></td>
								<td><?php echo $value->getTelefone()   ?> <?php echo $value->getEmail()   ?> </td>
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
														Refazer Cadastro

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
								<td>
									<?php if ($value->getStatus() == 0) {  ?>
										<?php echo $value->getMotivo()  ?>

									<?php } else { ?>
										Ativo

									<?php } ?>
								</td>

								<td>
									<div class="ui  ">
										<a class="ui " href="delete.php?id=<?php echo $value->getId() ?>"> <i class="ui icon minus circle"></i></a>
										<a class="ui " href="confirme.php?id=<?php echo $value->getId() ?>"> <i class="ui icon gavel circle "></i> </a>
									</div>



								</td>
							</tr>
						<?php  } ?>
					<?php } ?>

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

		var table = $('#dataTableCriancaCordenacao').DataTable({
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
			"buttons": [{
					'extend': 'pdfHtml5',
					'orientation': 'landscape',
					'pageSize': 'LEGAL'

				},
				'excel',
				'csv',
				'pdf',
				'print',
				'colvis'

			],
			"pageLength": 50,
		});
		table.buttons().container()
			.appendTo($('div.eight.column:eq(0)', table.table().container()));

		var table1 = $('#dataTableCrianca11').DataTable({
			lengthChange: false,
			buttons: ['copy', 'excel', 'pdf', 'colvis']
		});

		table1.buttons().container()
			.appendTo($('div.eight.column:eq(0)', table.table().container()));
	});
</script>


<?php require_once "footer.php" ?>