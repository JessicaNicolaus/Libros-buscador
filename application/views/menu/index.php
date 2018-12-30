<div class="page-header">
	<h1> Menu <small> mantenimiento de registros </small> </h1>
</div>


<?= form_open('menu/search', array('class'=>'form-search')); ?>
	<?= form_input(array('type'=>'text', 'name'=>'buscar', 'id'=>'buscar', 'placeholder'=>'Buscar por nombre...', 'class'=>'input-medium search-query')); ?>
	<?= form_button(array('type'=>'submit', 'content'=>'<i class="icon-search"> </i>', 'class'=>'btn')); ?>
	<?= anchor('menu/create', 'Agregar', array('class'=>'btn btn-primary')); ?>
<?= form_close(); ?>


<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th> ID </th>
			<th> Nombre </th>
                        <th> Controlador </th>
                        <th> Accion </th>
                        <th> Url </th>
			<th> Creado </th>
			<th> Modificado </th>
                        <th> Accesos </th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($query as $registro): ?>
		<tr>
			<td> <?= anchor('menu/edit/'.$registro->id, $registro->id); ?> </td>
			<td> <?= $registro->name ?> </td>
                        <td> <?= $registro->controlador ?> </td>
                        <td> <?= $registro->accion ?> </td>
                        <td> <?= $registro->url ?> </td>
			<td> <?= date("d/m/Y", strtotime($registro->created)); ?> </td>
			<td> <?= date("d/m/Y", strtotime($registro->updated)); ?> </td>
                        <td> <?= anchor('menu/menu_perfiles/'.$registro->id, '<i class="icon-lock"></i>'); ?> </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
