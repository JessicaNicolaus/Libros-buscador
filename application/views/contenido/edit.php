<?= form_open('contenido/update', array('class'=>'form-horizontal')); ?>
	<legend> Temas - Actualizar Registro </legend>

	<?= my_validation_errors(validation_errors()); ?>

	<div class="control-group">
		<?= form_label('ID', 'id', array('class'=>'control-label')); ?>
		<span class="uneditable-input"> <?= $registro->id; ?> </span>
		<?= form_hidden('id', $registro->id); ?>
	</div>

	<div class="control-group">
		<?= form_label('Tema', 'tema', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'tema', 'id'=>'tema', 'value'=>$registro->tema)); ?>
	</div>
        
 

	<div class="form-actions">
		<?= form_button(array('type'=>'submit', 'content'=>'Guardar', 'class'=>'btn btn-primary')); ?>
		<?= anchor('contenido/index', 'Cancelar', array('class'=>'btn')); ?>	
			<?= anchor('contenido/delete/'.$registro->id, 'Eliminar', array('class'=>'btn btn-warning', 'onClick'=>"return confirm('Esto eliminará todo jugador registrado con este país')")); ?>
	</div>
	
<?= form_close(); ?>