
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
	<script src="<?=base_url()?>public/js/flipclock.min.js"></script>
	<script src="<?=base_url()?>public/js/md5.min.js"></script>
	<script>
		$('.embed-responsive').find('iframe').css('width','100%');
		$('.embed-responsive').find('iframe').css('height','400px');
		$('.content').find('table').each(function(){
			$(this).addClass('table table-condensered');
		});
		$('.content').find('img').each(function(){
			$(this).addClass('img-responsive');
		});
		<?php if (isset($is_eval)): ?>
			<?php if ($is_eval): ?>
				$(document).ready(function(){
					$('.cancel').click(function(){
						window.location.href ='inicio';
					});
			swal({
			  title: "<?=$eval->eva_tit?>",
			  text: "<br>Tiempo : <?=$eval->eva_tim?> | Preguntas: <?=$eval->num?> | Promedio <?=$eval->eva_tot?><br><small style='color:#FFA726;'>Al confirmar la evaluacion inicia inmediatamente</small><br><a href='<?=base_url()?>' class='btn btn-danger'>Ir al Inicio</a>",
			  type: "input",
			  html: true,
			  showCancelButton: false,
			  closeOnConfirm: false,
			  animation: "slide-from-top",
			  inputPlaceholder: "Ingresa Nombre y Apellido",
			  closeOnCancel: false,
			},
			function(inputValue){
			  if (inputValue === false) return false;
			  
			  if (inputValue === "") {
			    swal.showInputError("Es necesario que ingrese un Nombre y Apellido!");
			    return false
			  }
			  if(inputValue.split(' ').length<2){
			  	swal.showInputError("Es necesario que ingrese un Nombre y Apellido!");
			    return false
			  }
				swal({
				  title: "¿Esta segur@ que desea continuar?",
				  text: "A partir de este momento contará con 30 min",
				  type: "warning",
				  showCancelButton: true,
				  closeOnConfirm: true,
				  showLoaderOnConfirm: true,

				},
				function(isConfirm){
				if(isConfirm){
				  	$.ajax({
				            type:'POST',
				            dataType:"json",
				            url:'<?=base_url()?>inicio/iniciar_prueba',
				            data:("name="+inputValue+'&id_eva='+<?=$eval->id_eva?>),
				            success: function(respuesta){
				              if(respuesta.r =="done"){
				                if(respuesta.a==0){
				                	
				                	swal({
									  title: "<?=$eval->eva_tit?>",
									  text: "Ingresa la contaseña de la evaluacion.",
									  type: "input",
									  inputType: "password",
									  html: true,
									  showCancelButton: false,
									  closeOnConfirm: false,
									  animation: "slide-from-top",
									  inputPlaceholder: "Contaseña",
									  closeOnCancel: false,
									},
									function(inputValue){
									  if (inputValue === false) return false;
									  
									  if (inputValue === "") {
									    swal.showInputError("Es necesario que ingrese la contaseña");
									    return false
									  }
									  if(md5(inputValue) != respuesta.pw){
									  	swal.showInputError("La contraseña es incorrecta!");
									    return false
									  }else{
									  	swal.close();
									    $('#vista_eva').html(respuesta.html);
					                	clock((respuesta.t*60));
					                	$('.cover_eval').hide('100');}
									});
				                	
				                }else if(respuesta.a==1){
				                	$('.contenido').html(respuesta.html);
				                	$('.cover_eval').hide('100');
				                }

				               
				                
				               // tr.parent().remove();
				              }else{
				                swal("Hubo un error!", respuesta.m, "error");
				                 location.reload();
				              }
				            },
				            error: function(request, error)
				            { 
				              console.log(arguments);
				              alert(" Lo sentimos habido un error intentalo mas tarde . . . " + error);
				            }
			        }); 
				}else{
					 window.location.href = "./inicio";
				}
				});
			  
			});


		});

			<?php endif ?>
		<?php endif ?>
	function clock(time){
		var clock;
		clock = $('.clock').FlipClock(time, {
			        clockFace: 'MinuteCounter',
			        countdown: true,
			        callbacks: {
			        	stop: function() {
			        		$('#frm_eval').submit();
			        	}
			        }
			    });
		}

	
	</script>
</body>
</html>