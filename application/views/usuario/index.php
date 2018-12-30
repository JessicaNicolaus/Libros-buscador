<div class="page-header">
	<h1> Usuarios <small> mantenimiento de registros </small> </h1>
</div>


<?= form_open('usuario/search', array('class'=>'form-search')); ?>
	<?= form_input(array('type'=>'text', 'name'=>'buscar', 'id'=>'buscar', 'placeholder'=>'Buscar por nombre...', 'class'=>'input-medium search-query')); ?>
	<?= form_button(array('type'=>'submit', 'content'=>'<i class="icon-search"> </i>', 'class'=>'btn')); ?>
	<?= anchor('usuario/create', 'Agregar', array('class'=>'btn btn-primary')); ?>
<?= form_close(); ?>


<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th> ID </th>
			<th> Nombre </th>
			<th> Login </th>
			<th> eMail </th>
			<th> Perfil </th>
			<th> Creado </th>
			<th> Modificado </th>
		</tr>
	</thead>

	<tbody>
        
		<?php foreach ($query as $registro): ?>
		<tr>
			<td> <?= anchor('usuario/edit/'.$registro->id, $registro->id); ?> </td>
			<td> <?= $registro->name ?> </td>
                        <td> <?= $registro->login ?> </td>
                        <td> <?= $registro->email ?> </td>
                        <td> <?= $registro->perfil_name ?> </td>
			<td> <?= date("d/m/Y", strtotime($registro->created)); ?> </td>
			<td> <?= date("d/m/Y", strtotime($registro->updated)); ?> </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
