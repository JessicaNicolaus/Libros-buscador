<?= form_open('asignatura_contenido/insert', array('class'=>'form-horizontal')); ?>
    <legend>  Crear Registro </legend>
    
    <?= my_validation_errors(validation_errors()); ?>
    
       <div class="control-group">
            <?= form_label('Asignatura', 'asignatura_id', array('class'=>'control-label')); ?>
            <?= form_dropdown('asignatura_id', $asignaturas, 0); ?>
        </div>

       <div class="control-group">
            <?= form_label('Contendido', 'contenido_id', array('class'=>'control-label')); ?>
            <?= form_dropdown('contenido_id', $contenidos, 0); ?>
        </div>
   
   
	<div class="form-actions">
		<?= form_button(array('type'=>'submit', 'content'=>'Guardar', 'class'=>'btn btn-primary')); ?>
		<?= anchor('asignatura_contenido/index', 'Cancelar', array('class'=>'btn')); ?>	
	</div>
    
<?= form_close(); ?>