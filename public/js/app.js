

var article = function (){

	var main = function(){
		$('#add_content').change(function() {
	        if($(this).is(":checked")) {
	           $('.blok-content').hide();
	           $('#exist_content').val('1');
	        }else{
	        	 $('.blok-content').show();
	        	 $('#exist_content').val('0');
	        }
    	});
	};

	

	var btn_add_reference = function(){
		$('#btn_new_refer').click(function(){
			var cont_act = $('.refers').html();
			var num = $('.refers').find('input').length;
			$('.refers').append("<input class='form-control' id='r_"+(num+1)+"'><br>");
			return false;
		});
	}

	var save_article = function(){
		$('#btn_save').click(function(){
			var refers="";
			$('.refers').find('input').each(function(index){
				if($(this).val()!="" && $(this).val().length>20)
				{
					if(index == 0)
						refers = refers+$(this).val();
					else
						refers= refers+"<|>"+$(this).val();
				}
			});
			if(validar_campos()=="")
			{
				for (instance in CKEDITOR.instances) {
	                  CKEDITOR.instances['cue_pos'].updateElement();
	          	}				
				var formData = new FormData($('#save_article')[0]);
		        formData.append('art_refers', refers);
	           	swal({
		            title: "Atención al Guardar",
		            text: "¿Realmente deseas continuar?",
		            type: "info",
		            showCancelButton: true,
		            closeOnConfirm: false,
		            showLoaderOnConfirm: true,
	       		}, 
	            function(isConfirm) {
	              if (isConfirm) { 
			          $.ajax({
				            type: 'POST',
				            dataType: 'json',
				            url: $('#save_article').attr('action'),
				            data: formData,
				            cache: false,
					        contentType: false,
					        processData: false,
				            success: function(resp){
				              	if(resp.r =="done"){
				                  swal("OK!", resp.m, "success");
				                 location.reload();
				                }else{
				                  swal("Hubo un error!", resp.m, "error");
				                }
				            },
				            error: function(request, error){ 
					            console.log(arguments);
					            alert(" Lo sentimos habido un error intentalo mas tarde . . . " + error + request);
				          	}
			          });
			       }
	            }); 

			}else{
				swal("Hubo un error!", validar_campos(), "error");
			}

			return false;		 
		});
	}

	var validar_campos = function() {
        var tit = $('#tit_pos').val();
        var des = $('#des_pos').val();
        var uri  =$('#vid_pos').val();

		if(tit=="" || des =="" )
        {
        	return "Tanto el titulo como la descripción son requeridos";
        }
    	
    	return "";
	};

	var  isValidUrl =  function(url,obligatory,ftp)
	{
	    if(obligatory==undefined)
	        obligatory=0;
	    if(ftp==undefined)
	        ftp=0;
	 
	    if(url=="" && obligatory==0)
	        return true;
	 
	    if(ftp)
	        var pattern = /^(http|https|ftp)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/gi;
	    else
	        var pattern = /^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/gi;
	 
	    if(url.match(pattern))
	        return true;
	    else
	        return false;
	}

	var update_article = function()
	{
		$('#btn_update').click(function(){
			var refers="";
			$('.refers').find('input').each(function(index){
				if($(this).val()!="")
				{
					if(index == 0)
						refers = refers+$(this).val();
					else
						refers= refers+"<|>"+$(this).val();
				}
			});
			for (instance in CKEDITOR.instances) {
                  CKEDITOR.instances['cont_art'].updateElement();
          	}
	        var tit = $('#tit_art').val();
	        var des = $('#des_art').val();

			if(tit!="" && des !="" )
	        {
	          var formData = new FormData($('#save_article')[0]);
	          formData.append('art_refers', refers);
	       	swal({
	            title: "Atención al Actualizar la información.",
	            text: "¿Realmente deseas continuar?",
	            type: "info",
	            showCancelButton: true,
	            closeOnConfirm: false,
	            showLoaderOnConfirm: true,
       		}, 
            function(isConfirm) {
              if (isConfirm) { 
		          $.ajax({
			            type: 'POST',
			            dataType: 'json',
			            url: $('#save_article').attr('action'),
			            data: formData,
			            cache: false,
				        contentType: false,
				        processData: false,
			            success: function(resp){
			              	if(resp.r =="done"){
			                  swal("OK!", resp.m, "success");
			                  window.location.href = "./update";
			                }else{
			                  swal("Hubo un error!", resp.m, "error");
			                }
			            },
			            error: function(request, error){ 
				            console.log(arguments);
				            alert(" Lo sentimos habido un error intentalo mas tarde . . . " + error + request);
			          	}
		          });
		       }
            }); 
	        }
	        else
	        {
	          swal("Error!","Algunos campos son requeridos","error");
	        }
			return false;
		});
	}

	var delete_article = function(){
		$('.btn-delete').click(function(){
	        var id = $(this).data('id');
	        var clic = false;
	        var uri = $(this).data('request');
	        var tr = $(this).parent();
	        var type = $(this).data('type');
	        swal({   
	          title: "Estas seguro?",   
	          text: "Borraras la informacion!",   
	          type: "warning",   
	          showCancelButton: true,   
	          closeOnConfirm: false,   
	          showLoaderOnConfirm: true,
	        }, 
	        function(isConfirm){   
	          if (isConfirm) { 
	            clic = true;
	            $.ajax({
	            type:'POST',
	            dataType:"json",
	            url:uri,
	            data:("id="+id+"&clic="+clic+"&type="+type),
	            success: function(respuesta){
	              if(respuesta.r =="done"){
	                swal("Eliminado!",respuesta.m, "success");
	                tr.parent().remove();
	              }else{
	                swal("Hubo un error!", respuesta.m, "error");
	              }
	            },
	            error: function(request, error)
	            { 
	              console.log(arguments);
	              alert(" Lo sentimos habido un error intentalo mas tarde . . . " + error);
	            }
	              });      
	            //   
	          }
	        });
	      });
	}

	return {
	  init: function(){
	  		main();
	       btn_add_reference();
	       save_article();
	       update_article();
	       delete_article();
	  }
	}
}();

var qs = function() {
    var letter = ["a", "b", "c", "d", "e", "f", "g"];
     
     var guardar_preguntas = function(){
     	
     	$('#btn_guardar_pregunta').click(function(){
     		var resp ="";
     		var p = $('#opciones').find('.lit');
     		if(p.length>=2){
	     		p.each(function(index){
	     			if(index < p.length-1){
	     				resp = resp + $(this).val()+";";
	     			}else{
	     				resp = resp + $(this).val()+"";
	     			}
	     		});
	     		$('#respuestas').val(resp);
	     		if($('#pre_def').val()!="" && $('#id_eva').val()!=""){
	     			$('#frm_guardar_preguntas').submit();
	     		}
	     	}
	     	else{
	     		alert("Es necesario especificar minimo 2 repsuestas");
	     	}
     		return false;
     	});
     }

     var save_resp = function (){
     	$('#save_qts').click(function(){
     		var qs = [];
     		var qsr = [];
     		var rsp = [];
     		var id_eva = $('#id_eva').val();
     		$('#frm_save_qs').find('.qs').each(function(index){
     			qs[index] =$(this).val();
     			rsp [index] = $(this).data('rsp');
     		});
     		$('#frm_save_qs').find('.qsr').each(function(index){
     			qsr[index] =$(this).val();
     		});


                        
            if(qsr.length>1){
            
     		$.ajax({
	            type: 'POST',
	            dataType: 'json',
	            url: $('#frm_save_qs').attr('action'),
	            data: ('qs='+qs+'&qsr='+qsr+'&id_eva='+id_eva+'&rsp='+rsp),
	            success: function(resp){
	              	if(resp.r =="done"){
	                  swal("OK!", resp.m, "success");
	                  window.location.href = "./admin";
	                }else{
	                  swal("Hubo un error!", resp.m, "error");
	                }
	            },
	            error: function(request, error){ 
		            console.log(arguments);
		            alert(" Lo sentimos habido un error intentalo mas tarde . . . " + error + request);
	          	}
          	});
                
            }else{
                swal("Hubo un error!", 'Necesitas un minimo de 2 preguntas!', "error");
            }
     		return false;
     	});
     };

    /*Carga de inicio*/
    var main = function() {

        $('#add_lit').click(function() {
            var i = 0;
            $('#opciones').find('.lit').each(function() {
                i++;
            });
            if (i >= 0 && i < 5) {
                var a = ' <div class="input-group ad_"><span class="input-group-btn"><button class="lit_vit form-control" disabled>' + letter[i] + '</button></span><input class="form-control lit" placeholder="Introduce una nueva opción "><span class="input-group-btn"><button type="button" class="btn btn-default del_lit"><i class="fa fa-minus"></i> Elimimar</button></span> </div>';

                $('#opciones').append(a);
                $('#pre_rsp').append('<option value="' + letter[i] + '">' + letter[i] + '</option>');
            } else {
                alert("Solo se permiten 5 respuestas por pregunta");
            }
            $('.del_lit').click(function() {
                var f = $('#opciones').find('.lit_vit');
                
                    f.each(function(index) {
                        $(this).html(letter[index]);
                    });


                    $(this).parent().parent().remove();
                    acun = "";
                    for (var i = 0; i < $('#opciones').find('.lit_vit').length; i++) {
                        acun = acun + '<option value="' + letter[i] + '">' + letter[i] + '</option>';
                    }
                    $('#pre_rsp').html(acun);
                
            });
        });
      instance_click();
    };
    var instance_click = function() {
         //$(".question-section").off('hover');
         $('.open_modal, .insert_qt').off('click');
         $('.crr-modal').off('click');
         $('.del_qt').off('click');
         
        $('.question-section').hover(
            function() {
                $(this).find('.question-overlay').css('display', 'block');
            }, function() {
                $(this).find('.question-overlay').css('display', 'none');
            }
        );

        $('.open_modal, .insert_qt').on('click',function() {
            $('.modal-backdrop ').show('10');
            $('.modal_cont_qs').show('500');

            return false;
        });

        $('.crr-modal').on('click',function() {
            $('.modal-backdrop ').hide('10');
            $('.modal_cont_qs').hide('500');
            reset_inputs();
            return false;
        });
        
         $('.del_qt').on('click',function(e) {
            var ind = $(this).data('index');
            e.preventDefault();
          //  $(this).parent().parent().parent().parent().parent().parent().remove();
            
            $('#cqs_'+ind).remove();
            $('#'+ind).remove();
            reset_qt();
            return false;
        });
        
         
    };
    /*Validacion de campos*/
    var validation_questions = function() {
        var valido = true;
        var msg = "Bien";
        if ($('#pre_def').val() == "") {
            valido = false;
            msg = "El enunciado de la pregunta es requerido";
        }
        if ($('#opciones').find('.lit').length >= 2) {
            $('#opciones').find('.lit').each(function() {
                if ($(this).val() == "") {
                    valido = false;
                    msg = "No puedes dejar opciones en blanco.";
                }
            })
        } else {
            valido = false;
            msg = "Debes ingresar minimo 2 opciones.";
        }
        return valido;
    };
    // insertar htnl de las pregubtas
    var send_questions = function() {
        $('#confirm-cuestion').click(function() {
            if (validation_questions()) {
                adquestions();
            }
        });
    };
    //eliminar preguntas del HTML
    var del_questions = function() {
      
    };
    //resetear indices de preguntas
    var reset_qt = function() {
        var n=0;
        $('.qt-add').find('.question-section').each(function(i) {
            $(this).find('.num').html('<b>&nbsp; ' + (i + 1) + ' - &nbsp;</b>');
            $(this).removeAttr('id');
            $(this).attr('id',i+1);
            $(this).find('.del_qt').removeAttr('data-index');
            $(this).find('.del_qt').attr('data-index', (i + 1));
        });
        
        $('#frm_save_qs').find('.c_qs').each(function(i){
        	
        	var qs = $(this).find('.qs');
            $(this).removeAttr('id');
            $(this).attr('id','cqs_'+(i+1));
            
            var z = qs.val().split(';');
            qs.val((i+1)+";"+z[1]);

            $(this).find('.qsr').each(function(j){
	            var x = $(this).val().split(';');
	            $(this).val((i+1)+";"+x[1]+";"+x[2]);
            });
        });
        return false;
    };
    //limpiar los inputs luego de insertar o actualizar
    var reset_inputs = function() {
        $('#pre_def').val("");
        $('#opciones').find('.lit').each(function(i) {
            $(this).val("");
        });
    };
    //adicionar preguntas al codigo HTML
    var adquestions = function() {
        var html = '';
        var pt = $('#pre_tip').val();
        var pd = $('#pre_def').val();
        var pr = $('#pre_rsp').val();
        var lit = '';
        var del = '';
        var qs = '';
        var qsr = '';
        var n = $('.qt-add').find('.question-section').length;
        
        $('#opciones').find('.lit').each(function(i) {
            lit = lit + '<tr><td><input type="radio">&nbsp;&nbsp;&nbsp;</td><td><b>' + letter[i] + '</b> &nbsp;&nbsp;</td><td><span>' + ($(this).val()) + '</span>&nbsp;</td></tr>';
            qsr =qsr + '<input type="hidden" class="qsr" value="'+(n+1)+';'+letter[i]+';'+($(this).val())+'">';
        });

        
        
        qs ='<div class="c_qs" id="cqs_'+(n+1)+'" ><input type="hidden" id="qs_'+(n+1)+'" class="qs" value="'+(n+1)+';'+pd+'" data-rsp="'+pr+'">'+qsr+'</div>';
        
        html = '<article class="clearfix question-section" id="' + (n + 1) + '"> <div class="question-body"> <div class="qt"> <span class="tit_pre"><span class="num"><b>&nbsp; ' + (n + 1) + ' - &nbsp;</b></span><b>' + pd + '</b> (' + pt + ')</span> <div class="contenedor_opciones_respuesta"> <table> <tbody> </tbody>' + lit + ' </table> </div><div class="question-overlay"> <div class="question-insert"> <div class="btn-group"> <div class="btn btn-info" style="z-index:9;"> Opciones: </div><a href="" class="open_modal btn btn-primary" role="button"> <i class="fa fa-check-square-o"></i> Nueva </a> <button class="del_qt btn btn-danger" role="button" data-index ="' + (n + 1) + '"> <i class="fa fa-check-square-o" onclick="del_questions();"></i> Eliminar </button> </div></div></div><div class="rps-preg"><b>Respuesta Correcta: </b> ' + pr + '</div></div></div></article> ';
        $('#frm_save_qs').append(qs);
        $('.qt-add').append(html);
		
		instance_click();
        reset_qt();
        
        $('.modal-backdrop ').hide('10');
        $('.modal_cont_qs').hide('500');
        reset_inputs();
       
    };



    return {
        init: function() {
            guardar_preguntas();
            main();
            send_questions();
            del_questions();
            save_resp();
        }
    };

}();


var eval = function(){

	var save_eval = function(){

		$('#btn_save_eval').click(function(){
			if(validate_eval()=="")
	        {
	         
	         var formData = new FormData($('#frm_save_eval')[0]);
	          
           	swal({
	            title: "Atención al Guardar",
	            text: "¿Realmente deseas continuar?",
	            type: "info",
	            showCancelButton: true,
	            closeOnConfirm: false,
	            showLoaderOnConfirm: true,
       		}, 
            function(isConfirm) {
              if (isConfirm) { 
		          $.ajax({
			            type: 'POST',
			            dataType: 'json',
			            url: $('#frm_save_eval').attr('action'),
			            data: formData,
			            cache: false,
				        contentType: false,
				        processData: false,
			            success: function(resp){
			              	if(resp.r =="done"){
			                  swal("OK!", resp.m, "success");
			                  location.reload();
			                }else{
			                  swal("Hubo un error!", resp.m, "error");
			                }
			            },
			            error: function(request, error){ 
				            console.log(arguments);
				            alert(" Lo sentimos habido un error intentalo mas tarde . . . " + error + request);
			          	}
		          });
		       }
            }); 
	        }
	        else
	        {
	           swal("Hubo un error!", validate_eval(), "error");
	        }
			return false;
		});
	};


	var validate_eval = function(){
			var id_tem = $('#select2').val();
	        var tit = $('#eva_tit').val();
	        var des = $('#eva_des').val();
	        var tim = $('#eva_tim').val();
	        var eni = $('#eva_num_int').val();
	        var et= $('#eva_tot').val();
	        var pw1= $('#eva_pwr').val();
	        var pw2= $('#eva_pwr2').val();
	        if(id_tem<=0){
	        	return "Debes escojer el tema que vas a evaluar";
	        }
	        if(tit =="" || des==""){
	        	return "El titulo y la descripción son requeridos";
	        }
	        if(tim ==""){
	        	return "Se necesita un tiempo, ingrese 00:00 para establecer una evaluación sin tiempo";
	        }
	        if(eni<0){
	        	return "Se necesita un numero de intentos, para cada pregunta. 0 para ilimitado";
	        }
	        if(et<=0){
	        	return "No puedes establecer promedios menores o iguales a cero."
	        }
	     
	        return  "";
	};

	return {
	  init: function(){
	      save_eval();
	  }
	}
}();