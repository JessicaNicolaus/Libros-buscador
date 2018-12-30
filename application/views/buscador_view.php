<!DOCTYPE html>
<html>
	
	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet" media="screen">
		<link href="<?= base_url('css/bootstrap-responsive.css') ?>" rel="stylesheet">
		<link href="<?= base_url('css/micss.css') ?>" rel="stylesheet">
                <link href="<?= base_url('style.css')?>" rel="stylesheet">
                <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
                <title> BUSCADOR </title>
	</head>
	
      
</html>
<body>
    
    
<div class="container-fluid">
    <?php $atributos = array('class' => 'formulario') ?>
    <?php echo form_open('buscador/index',$atributos) ?>
    <div class="span5">
		<h2>Buscador</h2>
		
		

			<?php echo form_label('Tema') ?>
			
                        <?= form_input(array('type'=>'text', 'name'=>'tema', 'id'=>'tema', 'value'=>set_value('tema'), 'class'=>'contenido_id')); ?>
			
	</div>
    
        <div class="span5" >
		
			<?php echo form_label('Plan de estudio') ?>	
                        <?php echo form_dropdown('plan_id', $planes, set_value('plan_id'),$js); ?>
				
		
	</div>	
   
        <div class="span5">
		
			<?php echo form_label('Asignatura') ?>	
                        <?php echo form_dropdown('asignatura_id', $asignaturas, set_value('asignatura_id')); ?>
       			
		
	</div>

    
      

         <div class="span5" >
		
			<!--este es nuestro autocompletado-->
                        <?php echo form_label('Semestre') ?>
			<?= form_input(array('type'=>'number', 'name'=>'semestre', 'id'=>'semestre', 'value'=>set_value('semestre'), 'class'=>'poblacion')); ?>
			
                        <!--este es nuestro autocompletado
                        <input type="text" autocomplete="off" onpaste="return false" name="tema" 
			id="tema" class="tema" placeholder="tema" /> -->
     
	</div>
    
    
        <div class="span5">
		
			
            <div class="muestra_temas"></div>
				
			<?php echo form_submit('buscar','Buscar'); ?>
			
		
		
	</div>	

       	
    
    
    
    
    
	
        <?php echo form_close() ?>
	
        <?php //si hay resultados los mostramos

	if(is_array($resultados) && !is_null($resultados))
	{
	?>
	
        <div class="span5" id="buscador_multipe">
				
            <div class="muestra_temas">Lista de libros (<?php echo count($resultados); ?>)</div>
		
	</div>    
    
    
 
  <table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <th> ID </th>
            <th> Titulo </th>
            <th> Autor1 </th>
            <th> Autor2 </th>
            <th> Volumen/año </th>
                         
        </tr>
    </thead>
  <tbody>
        <?php foreach ($resultados as $registro): ?>
        <tr>
            <td> <?= anchor('bibliografia/edit/'.$registro->id, $registro->id); ?> </td>
            <td> <?= $registro->titulo ?> </td>
            <td> <?= $registro->autor1 ?> </td>
            <td> <?= $registro->autor2 ?> </td>
            <td> <?= $registro->volumen ?> </td>
            <td> <?= anchor('buscador/calificar/'.$registro->id, 'calificar'); ?> </td>
                       
        </tr>
        <?php endforeach; ?>
</tbody>
</table>
 
 
 
 
	<?php
	}
	?>	
</div>
</body>
</html>