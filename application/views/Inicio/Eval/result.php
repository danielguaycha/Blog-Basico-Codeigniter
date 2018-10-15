<section class="contenido">
		<div class="art">
			<div class="row">
				<div class="col-md-12" style="margin: 0 auto;">
						<div class="content">
							<h3><?=$eval->eva_tit?></h3>
							<table class="table table-striped table-hover" style="width: 50%;margin: 0 auto;" >
								<thead>
									<tr>
										<th class="text-center">Nombre</th>
										<th class="text-center">Nota</th>
										<th class="text-center">Numero de evaluaciones</th>
									</tr>
								</thead>
								<tbody>
									<tr class="text-center">
										<td><?=$this->session->userdata('nombre');?></td>
										<td><?=$nota.' / '.$eval->eva_tot?></td>
										<td>1</td>
									</tr>
								</tbody>
							</table>
							<hr>
							<center><a href="<?=base_url()?>inicio/nota/end" class="btn btn-danger">Terminar</a></center>
						</div>
				</div>
			</div>
		</div>
</section>