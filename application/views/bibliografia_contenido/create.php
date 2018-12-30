<?= form_open('bibliografia_contenido/insert', array('class'=>'form-horizontal')); ?>
	<legend> Crear nuevo registro de peso </legend>

	<?= my_validation_errors(validation_errors()); ?>

	<div class="control-group">
		<?= form_label('Peso', 'peso', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'peso', 'id'=>'peso', 'value'=>set_value('peso'))); ?>
	</div>


	<div class="control-group">
		<?= form_label('Contenido', 'contenido_id', array('class'=>'control-label')); ?>
		<?= form_dropdown('contenido_id', $contenidos); ?>
	</div>

	<div class="control-group">
		<?= form_label('Bibliografia', 'bibliografia_id', array('class'=>'control-label')); ?>
		<?= form_dropdown('bibliografia_id', $bibliografias); ?>
	</div>

	<div class="form-actions">
		<?= form_button(array('type'=>'submit', 'content'=>'Guardar', 'class'=>'btn btn-primary')); ?>
		<?= anchor('bibliografia_contenido/index', 'Cancelar', array('class'=>'btn')); ?>
	</div>

<?= form_close(); ?>