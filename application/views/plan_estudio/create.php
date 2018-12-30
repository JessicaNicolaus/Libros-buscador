<?= form_open('plan_estudio/insert', array('class'=>'form-horizontal')); ?>
	<legend> Registrar nuevo país </legend>

	<?= my_validation_errors(validation_errors()); ?>

	<div class="control-group">
		<?= form_label('Plan', 'plan', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'plan', 'id'=>'plan', 'value'=>set_value('plan'))); ?>
	</div> 

	<div class="form-actions">
		<?= form_button(array('type'=>'submit', 'content'=>'Guardar', 'class'=>'btn btn-primary')); ?>
		<?= anchor('plan_estudio/index', 'Cancelar', array('class'=>'btn')); ?>	
	</div>

<?= form_close(); ?>
