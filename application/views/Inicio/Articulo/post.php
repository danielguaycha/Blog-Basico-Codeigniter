<section class="contenido">
		<div class="art">
			<div class="row">
				<div class="col-md-8">
					<div class="header-content">
					<div class="col-md-12 advise">
						<a href="">Inicio</a> >
						<span><?=$consulta->tit_pos;?></span>
					</div>
					</div>
					<div class="content">
						<h3 style="text-align: left;"><?=$consulta->tit_pos;?></h3>
						<hr>
						<div class="embed-responsive embed-responsive-4by3">
						  <?php 
						  	if($vid!=""){
						  		echo $vid;
						  	}
						   ?>
						</div>
						<?=$consulta->des_pos?><br><br>
						<?php if ($consulta->img_pos!=""): ?>
							<center><img src="<?=base_url()?>public/img/post/<?=$consulta->img_pos?>" alt="" class="img-responsive"></center><br>					
						<?php endif ?>
						
						<?php 
							if($consulta->cue_pos!='0')
								echo $consulta->cue_pos;
						 ?>
						 
						 <?php if ($refer->num_rows()>0): ?>
						 	<h4><b>Referencias</b></h4>
							 <table class="table">
							 <?php $i=1; ?>
							 <?php foreach ($refer->result() as $f): ?>
							 <tr>
							 	<td style="border-top: 0px; text-align: left;">[<?php echo $i;?>]</td>
							 	<td style="border-top: 0px; text-align: left;"><?=$f->nom_ref?></td>
							 </tr>	
							 <?php $i++; ?>
							 <?php endforeach ?>
							 </table>
					 	
						 <?php endif ?>
						 
					</div>
				</div>
				<div class="col-md-4">
					<form action="" class="buscador">
						<input type="search" class="form-control" required="" placeholder="Buscar....">
					</form>
					<img src="<?=base_url()?>public/img/head.jpg" alt="" style="width: 100%">


					<ul class="items">

					<?php 

                        $temas =$this->db->query("SELECT a.`id_pos`,a.`tit_pos`,a.`sta_pos`,a.`url_pos`,a.`img_pos`,b.id_tem FROM `post` a JOIN temas b on a.`id_pos` = b.id_pos ORDER BY b.id_tem ASC");

                        foreach ($temas->result() as $temas) {
                        	echo '<li class="topic"><span><a href="'.base_url().'inicio/post/'.$temas->url_pos.'">'.$temas->tit_pos.'</a></span></li>';

                        	 $subtemas = $this->db->query("SELECT a.`id_pos`,a.`tit_pos`,a.`sta_pos`,a.`url_pos`,a.`img_pos`,b.id_sbt FROM `post` a JOIN subtemas b on a.`id_pos` = b.id_pos AND b.id_tem = ".$temas->id_tem." ORDER BY b.id_tem ASC");
                          	foreach ($subtemas->result() as $subt) {
                          		echo '<li class="subtopic"><span><a href="'.base_url().'inicio/post/'.$subt->url_pos.'">'.$subt->tit_pos.'</a></span></li>';
                          	}
                        }

                     ?>
					</ul>
				</div>
			</div>
		</div>
	</section>