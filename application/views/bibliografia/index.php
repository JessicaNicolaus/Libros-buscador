<div class="page-header">
	<h1> bibliografia <small> Registro de bibliografia </small> </h1>
</div>

<?= form_open('bibliografia/search', array('class'=>'form-search')); ?>
	<?= form_input(array('type'=>'text', 'name'=>'buscar', 'id'=>'buscar', 'placeholder'=>'Buscar por nombre...', 'class'=>'input-medium search-query')); ?>
	<?= form_button(array('type'=>'submit', 'content'=>'<i class="icon-search"> </i>', 'class'=>'btn')); ?>
	<?= anchor('bibliografia/create', 'Agregar', array('class'=>'btn btn-primary')); ?>
<?= form_close(); ?>

<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th> ID </th>
			<th> Titulo </th>
			<th> Autor1 </th>
                        <th> Autor2 </th>
                        <th> Volumen/año </th>
                         <th> Temas </th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($query as $registro): ?>
		<tr>
			<td> <?= anchor('bibliografia/edit/'.$registro->id, $registro->id); ?> </td>
			<td> <?= $registro->titulo ?> </td>
			<td> <?= $registro->autor1 ?> </td>
                        <td> <?= $registro->autor2 ?> </td>
                        <td> <?= $registro->volumen ?> </td>
                        <td> <?= anchor('bibliografia/bibliografia_contenidos/'.$registro->id, '<i class="icon-lock"></i>'); ?> </td>
                       
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

