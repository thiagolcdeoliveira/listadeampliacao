<?php require_once "header.php"; ?>
<?php

$conn = Container::getBanco();




$crianca1 = new Crianca;


$crud = new CrudCrianca($conn, $crianca1);

//echo "</pre>";

 ?>

<?php require_once "header.php"?>
<div class="ui vertical stripe segment">

<div class="ui grid container">

  
  
<table class="ui celled table" id="dataTableCriancaCordenacao"  >
					<thead>
						<tr>
						    <th>Posição Geral</th>
						    <th>Data Inscrição</th>
							<th>Código</th>
							<th>Nome</th>
							<th>Data Nasc</th>
							<th>Turma Desejada</th>
							<th>Periódo Desejada</th>
							<th>Responsavel</th>
							<th>Endereço</th>
							<th>CEIs Desejados</th>
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
							<th>Periódo</th>
							<th>Responsavel</th>
							<th>Endereço</th>
							<th>CEIs Desejados</th>
							<th>Status</th>
							<th>Ações</th>
						</tr>
					</tfoot>
					<tbody>
					<?php if  (isset($_SESSION['u'])){ ?>		
					<?php foreach ($crud->list() as $key => $value){   ?>
						<tr>
						    <td><?php echo $value->getId() ?> </td>
							<td><?php echo $value->getDataCad()  ?></td>
							<td><?php echo $value->getCodigo()  ?></td>
						    <td><?php echo $value->getNome()." ".$value->getSobrenome()  ?></td>
							<td><?php echo $value->getDataNasc()  ?></td>
							<td><?php echo $value->getTurma()  ?></td>
							<td><?php echo $value->getAllPeriodo()   ?></td>
							<td><?php echo $value->getNomeResponsavel()   ?></td>
							<td><?php echo $value->getTelefone()   ?>  <?php echo $value->getEmail()   ?>   </td>
							<td><?php echo $value->getAllCeis()  ?></td>
							<!--<td><?php //echo if($value->getStatus()){  ?>-->
								<td><?php  if($value->getStatus()==0){  ?>
									<?php echo $value->getMotivo()  ?>
								
								<?php } else{?>
									Ativo 

								<?php }?>
							</td>
							<td><a href="delete.php?id=<?php echo $value->getId() ?>" > <i class="ui icon trash"></i> </td>
						</tr>
						<?php  } ?>
					<?php } ?>	
					
					</tbody>
				</table>


	</div>
</div>
			
	
<!-- /.container-fluid -->
 <!-- Bootstrap core JavaScript-->
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
 
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

	var table = $('#dataTableCriancaCordenacao').DataTable( {
	"language": {
            "lengthMenu": "Número de Registros  _MENU_  Por Páginas",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Vocês está na página  _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro encontrado",
            "infoFiltered": "(registros filtrados _MAX_ no total)",
			"search" : "Pesquisar",
			"Previous": "Voltar",
			"Next" : "Próximo",
        },
		"lengthChange": false,
        "buttons": [ 'copy', 'excel', 'pdf', 'colvis' ],
    	"buttons": [
			{ 'extend': 'pdfHtml5',
                'orientation': 'landscape',
                'pageSize': 'LEGAL'
				
			},
			'excel',
			'csv',
			'pdf',
            'print',
			'colvis'
			
    ],
	"pageLength" : 50,
});
table.buttons().container()
        .appendTo( $('div.eight.column:eq(0)', table.table().container()) );

    var table1 = $('#dataTableCrianca11').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table1.buttons().container()
        .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
} );
</script>


<?php require_once "footer.php"?>