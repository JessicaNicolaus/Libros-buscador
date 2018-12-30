<?= form_open('asignatura/update', array('class'=>'form-horizontal')); ?>
	<legend> Asignaturas - Actualizar Registro </legend>

	<?= my_validation_errors(validation_errors()); ?>

	<div class="control-group">
		<?= form_label('ID', 'id', array('class'=>'control-label')); ?>
		<span class="uneditable-input"> <?= $registro->id; ?> </span>
		<?= form_hidden('id', $registro->id); ?>
	</div>

	<div class="control-group">
		<?= form_label('Nombre', 'nombre', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'value'=>$registro->nombre)); ?>
	</div>

	<div class="control-group">
		<?= form_label('Semestre', 'semestre', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'semestre', 'id'=>'semestre', 'value'=>$registro->semestre)); ?>
	</div>
       
        <div class="control-group">
		<?= form_label('Plan_estudio', 'plan_estudio_id', array('class'=>'control-label')); ?>
		<?= form_dropdown('plan_estudio_id', $planes, $registro->plan_estudio_id); ?>
	</div>
     

	<div class="form-actions">
		<?= form_button(array('type'=>'submit', 'content'=>'Guardar', 'class'=>'btn btn-primary')); ?>
		<?= anchor('asignatura/index', 'Cancelar', array('class'=>'btn')); ?>	
		<?= anchor('asignatura/delete/'.$registro->id, 'Eliminar', array('class'=>'btn btn-warning', 'onClick'=>"return confirm('Esto eliminará a todos los jugadores registrados con este club.')")); ?>
	</div>

<?= form_close(); ?>