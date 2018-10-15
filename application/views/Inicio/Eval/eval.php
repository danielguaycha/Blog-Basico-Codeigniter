<section class="contenido">
		<div class="art">
			<div class="row">
			<div class="col-md-8">
			<div class="content">
			<h3>Preguntas</h3>
			<p><?=$eval->eva_des?></p><hr>
			<form action="<?=base_url()?>/inicio/nota" method="post" id="frm_eval">
			<input type="hidden" name="id_eva" value="<?=$eval->id_eva?>">
			<div id="vista_eva">
				
			</div>
			
			
				<hr>
				<center><button type="submit" class="btn btn-danger" >Enviar</button></center>
			</form>
			</div>
			</div>
			<div class="col-md-4">
				<div class="aside_eval">
					<center><b><h4><?=$eval->eva_tit?></h4></b></center>
					<div class="col-md-6">N°. Preguntas: <b><?=$eval->num?></b></div>
					<div class="col-md-6">Promedio Total: <b><?=$eval->eva_tot?></b></div>
					<div class="col-md-12">
						<center><h4>Tiempo Restante</h4></center>
					</div>
					<div class="col-md-12">
						<div id="getting-started"></div>
						<div class="clock" style="margin:2em;"></div>
						<div class="message"></div>
					</div>
				</div>
				
			</div>
		</div>
		</div>
</section>
	<div class="cover_eval"  style="background-image: url(<?=base_url()?>public/img/work.png);">
		
	</div>
<style>
	.cover_eval{
		position: fixed;
		width: 100%;
		height: 100%;
		top: 0;
		z-index: 100;
		background-size: cover;
		background-color: rgba(0,0,0,1);

	}
</style>