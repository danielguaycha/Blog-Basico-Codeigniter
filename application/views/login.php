
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<title>ISMACHALA | Login</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<link rel="icon" type="image/png" href="<?=base_url()?>public/img/logo_condensed.png">
<meta content="" name="description"/>
<meta content="" name="author"/>
</head>

<link href="<?=base_url()?>public/css/login.css?v=1.0.0" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<body class="login">

	<div class="logo">
		<a href="">
		    <span class="icon-logo">
                <img src="<?=base_url()?>public/img/logo.png" alt="" width="60px">      
            </span>
		</a>
		<p class="name-logo"><br>Ingeniería de Software</p>
	</div>
	

    
    <div class="content" >
        <div class="over-content">
               <div class="img-bg">
                    <div class="msg-login"></div>
                    <a  href="<?=base_url()?>admin/logout" class="back-form"><i class="glyphicon glyphicon-menu-left"></i></a>
                    <h3 class="form-title">Ingresar Usuario</h3>
                    <div class="form-group">
                        <div class="c-login-img" data-base ="<?=base_url()?>">
                            <span class="img-login">
                                <i class="is-pc1"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mensaje"></div> 
                <form class="login-form" action="<?=base_url()?>admin/login_user">
                    <div class="form-group user-user">
                    <?php if ($this->session->userdata('id_usuario')>0){ ?>
                        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="txtuser" value="<?=$this->session->userdata('username');?>"/>
                    <?php }else{ ?>
                        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="txtuser"/>
                        <?php } ?>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-login">Siguiente</button>
                    </div>
                </form>
                <form class="pass-form" method="post">
                    <div class="form-actions">
                    <div class="form-group pw-pw">
                        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Ingresa tu contraseña" name="password" id="txtpw"/>
                    </div>
                    <button type="submit" class="btn btn-login" id="login-init">Iniciar Session</button>
                    <a href="javascript:;" id="forget-password" class="forget-password">Olvide mi contraseña?</a>
                </div>               
                </form>
                
        </div>
        <div class="create-account">
            <p>
                <a href="javascript:;" class="uppercase">Contáctanos</a>
            </p>
        </div> 
    </div>
    
	<div class="copyright">
		 2017 © Admin.
	</div>

	
	    <!-- jQuery 2.1.4 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function(){
	    $('.login-form').submit(function(){
	    	var user= $('#txtuser').val();
	    	if(user!=""){
	    		$.ajax({
	    			type:'POST',
	    	 		dataType:'json',
	    			url:$('.login-form').attr('action'),
		    	 	data: ('username='+user+'&case='+1),
		    	 	success: function(resp){
		    	 		if(resp.r =="done"){
                            $('.c-login-img').html(resp.html);
                            $('.form-title').html(resp.m);
                            $('.login-form').css('margin-top', '-120px');
                            $('.back-form').show();
                            $('.mensaje').html('');
                        }
                        else{
                            $('.mensaje').html('<i class="icon-error"> </i>'+resp.m+'.').css('color','#ef5350');
                        }
		    	 	},
		    	 	error: function(request, error)
					{ 
						console.log(arguments);
						alert(" Lo sentimos habido un error intentalo mas tarde . . . " + error);
					}
	    	 })	
	    	}else{

	    		$('.mensaje').html('<i class="icon-error"> </i>Ingresar un usuario.').css('color','#ef5350');
	    		setTimeout(function(){
	    			$('.mensaje').html("");
	    		},3000);
	    	}
	    	return false;
	    });

         $('.pass-form').submit(function(){
            var pass = $('#txtpw').val();
            $.ajax({
                type:'POST',
                dataType:'json',
                url:$('.login-form').attr('action'),
                data:('password='+pass+'&case='+2),
                success: function(resp){
                    if(resp.r =="done")
                    {
                        if(resp.acceso){
                            window.location.href = resp.url;
                        }
                    }
                    else
                    {
                        $('.mensaje').html('<i class="icon-error"> </i>'+resp.m+'.').css('color','#ef5350');
                    }
                },
                error: function(request, error)
                    { 
                        console.log(arguments);
                        alert(" Lo sentimos habido un error intentalo mas tarde . . . " + error);
                    }
            });
            return false;
        });
	    $('.back-form').click(function(){
            $('.c-login-img').html(' <span class="img-login"><i class="icon-admin"></i></span>');
             $('.form-title').html('Ingresar Usuario');
            $('.login-form').css('margin-top', '0px');
            $('.back-form').hide();
            return false;
        });
      //login_var();  
    });
    </script>

</body>
</html>