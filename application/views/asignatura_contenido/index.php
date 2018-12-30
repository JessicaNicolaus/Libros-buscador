<div class="page-header">
	<h1> <small> mantenimiento de registros </small> </h1>
</div>


<?= form_open('asignatura_contenido/search', array('class'=>'form-search')); ?>
	<?= form_input(array('type'=>'text', 'name'=>'buscar', 'id'=>'buscar', 'placeholder'=>'Buscar por nombre de perfil...', 'class'=>'input-medium search-query')); ?>
	<?= form_button(array('type'=>'submit', 'content'=>'<i class="icon-search"> </i>', 'class'=>'btn')); ?>
	<?= anchor('asignatura_contenido/create', 'Agregar', array('class'=>'btn btn-primary')); ?>
<?= form_close(); ?>


<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th> ID </th>
			<th> Asignatura </th>

			<th> Temas </th>
		
		</tr>
	</thead>

	<tbody>
        
		<?php foreach ($query as $registro): ?>
		<tr>
			<td> <?= anchor('asignatura_contenido/edit/'.$registro->id, $registro->id); ?> </td>
			<td> <?= $registro->asignatura_nombre ?> </td>
                        
                        <td> <?= $registro->contenido_tema ?> </td>
			
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
