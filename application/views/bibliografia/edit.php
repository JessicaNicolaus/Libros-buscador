
<?= form_open('bibliografia/update', array('class'=>'form-horizontal')); ?>
	<legend> bibliografias - Actualizar Registro </legend>

	<?= my_validation_errors(validation_errors()); ?>

	<div class="control-group">
		<?= form_label('ID', 'id', array('class'=>'control-label')); ?>
		<span class="uneditable-input"> <?= $registro->id; ?> </span>
		<?= form_hidden('id', $registro->id); ?>
	</div>

	<div class="control-group">
		<?= form_label('Titulo', 'titulo', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'titulo', 'id'=>'titulo', 'value'=>$registro->titulo)); ?>
	</div>

	<div class="control-group">
		<?= form_label('Autor1', 'autor1', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'autor1', 'id'=>'autor1', 'value'=>$registro->autor1)); ?>
	</div>
        
       <div class="control-group">
		<?= form_label('Autor2', 'autor2', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'autor2', 'id'=>'autor2', 'value'=>$registro->autor2)); ?>
	</div>
        
        <div class="control-group">
		<?= form_label('Volumen', 'volumen', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'volumen', 'id'=>'volumen', 'value'=>$registro->volumen)); ?>
	</div>
        
	<div class="form-actions">
		<?= form_button(array('type'=>'submit', 'content'=>'Guardar', 'class'=>'btn btn-primary')); ?>
		<?= anchor('bibliografia/index', 'Cancelar', array('class'=>'btn')); ?>	
		<?= anchor('bibliografia/delete/'.$registro->id, 'Eliminar', array('class'=>'btn btn-warning', 'onClick'=>"return confirm('Esto eliminará el registro.')")); ?>
	</div>

 

 
<?= form_close(); ?>