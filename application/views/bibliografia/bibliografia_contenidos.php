<legend> <?=$titulo; ?> </legend>
<div class="row-fluid">

	<div class="span6">
	<table class="table table-condensed table-bordered">
		<caption> <h1> No Asignados </h1> </caption>

		<thead>
		<tr>
			<th> ID </th>
			<th> Tema </th>
			<th> </th>
		</tr>
		</thead>

		<tbody>
		<?php foreach ($query_izq as $registro): ?>
		<tr>
			<td> <?=$registro[0]; ?> </td>
			<td> <?=$registro[1]; ?> </td>
			<td> <?= anchor('bibliografia/mp_asig/'.$registro[0].'/'.$registro[2], 
                                '<i class="icon-arrow-right"></i>'); ?> </td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	</div>

	<div class="span6">
	<table class="table table-condensed table-bordered">
		<caption> <h1> Asignados </h1> </caption>

		<thead>
		<tr>
			<th> </th>
			<th> ID </th>
			<th> Tema </th>
		</tr>
		</thead>

		<tbody>
		<?php foreach ($query_der as $registro): ?>
		<tr>
			<td> <?= anchor('bibliografia/mp_noasig/'.$registro[0].'/'.$registro[2], 
                                '<i class="icon-arrow-left"></i>'); ?> </td>
			<td> <?=$registro[0]; ?> </td>
			<td> <?=$registro[1]; ?> </td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	</div>

</div>

<div class="btn-toolbar">
	<?= anchor('bibliografia/index', 'Volver', 'class="btn btn-primary"'); ?>
</div>

