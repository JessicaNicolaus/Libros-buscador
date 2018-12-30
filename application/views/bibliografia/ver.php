
<?= form_open('buscador/calificado', array('class'=>'form-horizontal')); ?>
	<legend> bibliografias </legend>

	<?= my_validation_errors(validation_errors()); ?>

	<div class="control-group">
		<?= form_label('ID', 'id', array('class'=>'control-label')); ?>
		<span class="uneditable-input"> <?= $registro->id; ?> </span>
		<?= form_hidden('id', $registro->id); ?>
                
                <?= form_hidden('tema', $parametrobuscar["tema"]); ?>
                <?= form_hidden('plan_id', $parametrobuscar["plan_id"]); ?>
                <?= form_hidden('asignatura_id', $parametrobuscar["asignatura_id"]); ?>
                <?= form_hidden('semestre', $parametrobuscar["semestre"]); ?>
	</div>

	<div class="control-group">
		<?= form_label('Titulo', 'titulo', array('class'=>'control-label')); ?>
            <span class="uneditable-input"> <?= $registro->titulo; ?> </span>
            <?= form_hidden('titulo', $registro->titulo); ?>
			</div>

	<div class="control-group">
		<?= form_label('Autor1', 'autor1', array('class'=>'control-label')); ?>
		 <span class="uneditable-input"> <?= $registro->autor1; ?> </span>
            <?= form_hidden('autor1', $registro->autor1); ?>	</div>
        
       <div class="control-group">
		<?= form_label('Autor2', 'autor2', array('class'=>'control-label')); ?>
		 <span class="uneditable-input"> <?= $registro->autor2; ?> </span>
            <?= form_hidden('autor2', $registro->autor2); ?>
	</div>
        
        <div class="control-group">
		<?= form_label('Volumen', 'volumen', array('class'=>'control-label')); ?>
		 <span class="uneditable-input"> <?= $registro->volumen; ?> </span>
            <?= form_hidden('volumen', $registro->volumen); ?>
	</div>
       
          <div class="control-group">
		<?= form_label('Calificación', 'calificacion', array('class'=>'control-label')); ?>
		<?= form_dropdown('calificacion', $calificacion=array('1','2','3','4','5')); ?>
	</div>
        
            <div class="form-actions">
<?= form_button(array('type'=>'submit', 'content'=>'Guardar', 'class'=>'btn btn-primary')); ?>
<?= anchor('buscador', 'Cancelar', array('class'=>'btn')); ?>
</div>
 
<?= form_close(); ?>

