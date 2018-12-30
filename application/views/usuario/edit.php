<?= form_open('usuario/update', array('class'=>'form-horizontal')); ?>
    <legend> Usuarios - Actualizar Registro </legend>
    
    <?= my_validation_errors(validation_errors()); ?>
    
    	<div class="control-group">
		<?= form_label('ID', 'id', array('class'=>'control-label')); ?>
		<span class="uneditable-input"> <?= $registro->id; ?> </span>
		<?= form_hidden('id', $registro->id); ?>
	</div>
    
	<div class="control-group">
		<?= form_label('Nombre', 'name', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'name', 'id'=>'name', 'value'=>$registro->name)); ?>
	</div>
    

        <div class="control-group">
            <?= form_label('Login', 'login', array('class'=>'control-label')); ?>
            <?= form_input(array('type'=>'text', 'name'=>'login', 'id'=>'login', 'value'=>$registro->login)); ?>
        </div>
    
        <div class="control-group">
            <?= form_label('eMail', 'email', array('class'=>'control-label')); ?>
            <?= form_input(array('type'=>'email', 'name'=>'email', 'id'=>'email', 'value'=>$registro->email)); ?>
        </div>
     
       <div class="control-group">
            <?= form_label('Perfil', 'perfil_id', array('class'=>'control-label')); ?>
            <?= form_dropdown('perfil_id', $perfiles, $registro->perfil_id); ?>
        </div>
       
	<div class="control-group">
		<?= form_label('Creado', 'created', array('class'=>'control-label')); ?>
		<span class="uneditable-input"> <?= date("d/m/Y - H:i", strtotime($registro->created)); ?> </span>
		<?= form_hidden('created', $registro->created); ?>
	</div> 
     
	<div class="control-group">
		<?= form_label('Modificado', 'updated', array('class'=>'control-label')); ?>
		<span class="uneditable-input"> <?= date("d/m/Y - H:i", strtotime($registro->updated)); ?> </span>
		<?= form_hidden('updated', $registro->updated); ?>
	</div>
    
    
	<div class="form-actions">
		<?= form_button(array('type'=>'submit', 'content'=>'Guardar', 'class'=>'btn btn-primary')); ?>
		<?= anchor('usuario/index', 'Cancelar', array('class'=>'btn')); ?>	
            <?= anchor('usuario/delete/'.$registro->id, 'Eliminar', array('class'=>'btn btn-warning', 'onClick'=>"return confirm('¿Está Seguro?')")); ?>
            
	</div>
    
<?= form_close(); ?>