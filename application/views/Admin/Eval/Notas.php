
 <div class="content-wrapper">
        <!-- Main content -->
        <section class="content" style="height: 90vh;">
        <div class="box box-default color-palette-box">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Resultados para Evaluaciones.</h3>
              </div>
             <div class="box-body">
             <div style="position: relative; width: 80%; margin:0 auto;">
				<h3><?=$eval->eva_tit?></h3>
             	<br>
             	<table class="table">
             		<thead>
             			<tr>
             				<th>Estudiante</th>
             				<th>Nota</th>
             			</tr>
             		</thead>
             		<tbody>
             			<?php foreach ($rs->result() as $f): ?>
             				<tr>
             					<td><?=$f->nombre?></td>
             					<td><?=$f->nota?></td>
             				</tr>
             			<?php endforeach ?>
             		</tbody>
             	</table>
             </div>
             </div>
        </div>
        </section>
 </div>