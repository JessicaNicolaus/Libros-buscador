<?= form_open('contenido/insert', array('class'=>'form-horizontal')); ?>
	<legend> Registrar nuevo tema </legend>

	<?= my_validation_errors(validation_errors()); ?>

	<div class="control-group">
		<?= form_label('Tema', 'tema', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'tema', 'id'=>'tema', 'value'=>set_value('tema'))); ?>
	</div> 

	<div class="form-actions">
		<?= form_button(array('type'=>'submit', 'content'=>'Guardar', 'class'=>'btn btn-primary')); ?>
		<?= anchor('contenido/index', 'Cancelar', array('class'=>'btn')); ?>
            
	</div>
        

<?= form_close(); ?>