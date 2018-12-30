<?= form_open('asignatura/insert', array('class'=>'form-horizontal')); ?>
	<legend> Registrar nueva asignatura </legend>
	
	<?= my_validation_errors(validation_errors()); ?>

	<div class="control-group">
		<?= form_label('Nombre', 'nombre', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'value'=>set_value('nombre'))); ?>
	</div>

	<div class="control-group">
		<?= form_label('Semestre', 'semestre', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'semestre', 'id'=>'semestre', 'value'=>set_value('semestre'))); ?>
	</div> 
        
         <div class="control-group">
            <?= form_label('Plan_estudio', 'plan_estudio_id', array('class'=>'control-label')); ?>
            <?= form_dropdown('plan_estudio_id', $planes, 0); ?>
        </div>
       

	<div class="form-actions">
		<?= form_button(array('type'=>'submit', 'content'=>'Guardar', 'class'=>'btn btn-primary')); ?>
		<?= anchor('asignatura/index', 'Cancelar', array('class'=>'btn')); ?>	
	</div>

<?= form_close(); ?>