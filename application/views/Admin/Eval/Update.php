
 <div class="content-wrapper">
        <!-- Main content -->
        <section class="content" style="height: 90vh;">
        <div class="box box-default color-palette-box">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Evaluaciones</h3>
              </div>
             <div class="box-body">
				<br><br>
                    <?php 

                     if($this->input->get('op')=='success' || $this->input->get('op') =="1"){
                        echo "<div class='alert alert-success'>La eliminacion se realizo correctamente.</div>";
                     }
                ?>
					<a href="<?=base_url()?>admin/addeval" class="btn btn-success pull-right">Nueva Evaluacón</a>
				<br>
             
             
             	<?php if ($consulta->num_rows()>0): ?>
             		<table class="table table-striped table-hover">
             		<thead>
             			<tr><th>Estado</th>
						<th>Título de la evaluación.</th>
						<th class="text-center">Vista previa</th>
						<th class="text-center">Resultados</th>
						<th class="text-center">Preguntas</th>
						<th class="text-center">Gestionar</th>
						</tr>
             		</thead>
             			<tbody>
             			<?php foreach ($consulta->result() as $f): ?>
             				
             			
             				<tr>
             					<td><a href="" class="btn">
             						<?php if ($f->eva_sta == 1): ?>
             							<a class="btn btn-success">Abierta</a>
             						<?php else: ?>
             							<a class="btn btn-danger">Cerrada</a>
             						<?php endif ?>
             					</a></td>
             					<td><?=$f->eva_tit?></td>
             					<td class="text-center"><a href=""><i class="fa fa-2x fa-search-plus"></i></a></td>
								<td class="text-center"><a href="<?=base_url()?>admin/resultado_qt/<?=$f->id_eva?>"><i class="fa fa-2x fa-pie-chart"></i></a></td>
								<td class="text-center"><?=$f->preguntas?></td>
             					<td>
             						<div class="btn-group pull-right">
										<button type="button" class="btn btn-inline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu dropdown-menu-right">
											<li></li>
											<li><a href="<?=base_url()?>admin/addeval?edit=<?=$f->id_eva?>"><i class="fa fa-copy"></i>Modificar Datos
											</a></li>
											<li>
											<?php if ($f->preguntas ==0): ?>
												<a href="<?=base_url()?>admin/addqt?test=<?=$f->id_eva?>">	<i class="is-lista"> </i>  Agregar preguntas</a>
											<?php else: ?>
												<a href="<?=base_url()?>admin/addqt?test=<?=$f->id_eva?>">	<i class="is-lista"> </i>  Modificar preguntas</a>
											<?php endif ?>
												
											</li>
											<li role="separator" class="divider"></li>
											<li><a class="text-danger" href="<?=base_url()?>admin/delete_eval/<?=$f->id_eva?>"> <i class="fa fa-fw fa-trash-o"></i> Eliminar Evaluación
											</a></li>
										</ul>
									</div>
             					</td>
             				</tr>
             				<?php endforeach ?>
             			</tbody>
             		</table>
             	<?php else: ?>
             		<div class="Alert">Aun no se han agregado evaluaciones...</div>
             	<?php endif ?>
             </div>
          </div>
          </section>
  </div>