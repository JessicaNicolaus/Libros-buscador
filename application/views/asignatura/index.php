<div class="page-header">
	<h1> Asignaturas <small> Registro de asignaturas </small> </h1>
</div>

<?= form_open('asignatura/search', array('class'=>'form-search')); ?>
	<?= form_input(array('type'=>'text', 'name'=>'buscar', 'id'=>'buscar', 'placeholder'=>'Buscar por nombre...', 'class'=>'input-medium search-query')); ?>
	<?= form_button(array('type'=>'submit', 'content'=>'<i class="icon-search"> </i>', 'class'=>'btn')); ?>
	<?= anchor('asignatura/create', 'Agregar', array('class'=>'btn btn-primary')); ?>
<?= form_close(); ?>

<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th> ID </th>
			<th> Nombre </th>
			<th> Semestre </th>
                        <th> Plan de estudio </th>
                        <th> Temas </th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($query as $registro): ?>
		<tr>
			<td> <?= anchor('asignatura/edit/'.$registro->id, $registro->id); ?> </td>
			<td> <?= $registro->nombre ?> </td>
			<td> <?= $registro->semestre ?> </td>
                        <td> <?= $registro->plan_estudio_plan ?> </td>
                        <td> <?= anchor('asignatura/asignatura_contenidos/'.$registro->id, '<i class="icon-lock"></i>'); ?> </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
