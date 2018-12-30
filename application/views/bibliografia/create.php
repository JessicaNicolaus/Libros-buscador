<?= form_open('bibliografia/insert', array('class'=>'form-horizontal')); ?>
	<legend> Registrar nueva bibliografia </legend>
	
	<?= my_validation_errors(validation_errors()); ?>

	<div class="control-group">
		<?= form_label('Titulo', 'titulo', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'titulo', 'id'=>'titulo', 'value'=>set_value('titulo'))); ?>
	</div>

	<div class="control-group">
		<?= form_label('Autor1', 'autor1', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'autor1', 'id'=>'autor1', 'value'=>set_value('autor1'))); ?>
	</div> 
        
        <div class="control-group">
		<?= form_label('Autor2', 'autor2', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'autor2', 'id'=>'autor2', 'value'=>set_value('autor2'))); ?>
	</div> 
        
         <div class="control-group">
		<?= form_label('Volumen', 'volumen', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'volumen', 'id'=>'volumen', 'value'=>set_value('volumen'))); ?>
	</div> 

	<div class="form-actions">
		<?= form_button(array('type'=>'submit', 'content'=>'Guardar', 'class'=>'btn btn-primary')); ?>
		<?= anchor('bibliografia/index', 'Cancelar', array('class'=>'btn')); ?>	
	</div>

<?= form_close(); ?><?php
