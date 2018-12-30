<div class="page-header">
	<h1> Planes <small> Registro de planes </small> </h1>
</div>

<?= form_open('plan_estudio/search', array('class'=>'form-search')); ?>
	<?= form_input(array('type'=>'text', 'name'=>'buscar', 'id'=>'buscar', 'placeholder'=>'Buscar por nombre...', 'class'=>'input-medium search-query')); ?>
	<?= form_button(array('type'=>'submit', 'content'=>'<i class="icon-search"> </i>', 'class'=>'btn')); ?>
	<?= anchor('plan_estudio/create', 'Agregar', array('class'=>'btn btn-primary')); ?>
<?= form_close(); ?>

<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th> ID </th>
			<th> Plan </th>

		</tr>
	</thead>

	<tbody>
		<?php foreach ($query as $registro): ?>
		<tr>
			<td> <?= anchor('plan_estudio/edit/'.$registro->id, $registro->id); ?> </td>
			<td> <?= $registro->plan ?> </td>

		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
