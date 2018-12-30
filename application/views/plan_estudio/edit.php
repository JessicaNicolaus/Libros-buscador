<?= form_open('plan_estudio/update', array('class'=>'form-horizontal')); ?>
	<legend> Países - Actualizar Registro </legend>

	<?= my_validation_errors(validation_errors()); ?>

	<div class="control-group">
		<?= form_label('ID', 'id', array('class'=>'control-label')); ?>
		<span class="uneditable-input"> <?= $registro->id; ?> </span>
		<?= form_hidden('id', $registro->id); ?>
	</div>

	<div class="control-group">
		<?= form_label('Plan', 'plan', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'plan', 'id'=>'plan', 'value'=>$registro->plan)); ?>
	</div>

	<div class="form-actions">
		<?= form_button(array('type'=>'submit', 'content'=>'Guardar', 'class'=>'btn btn-primary')); ?>
		<?= anchor('plan_estudio/index', 'Cancelar', array('class'=>'btn')); ?>	
			<?= anchor('plan_estudio/delete/'.$registro->id, 'Eliminar', array('class'=>'btn btn-warning', 'onClick'=>"return confirm('Esto eliminará todo jugador registrado con este país')")); ?>
	</div>
	
<?= form_close(); ?>