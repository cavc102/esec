  
//alert('dddfasfasd');
$( document ).ready(function() {


	$('#b_guardarorden').click(function(){
		console.log("entro");
		var dataString="id_tarjeta="+$('#id_tarjeta').val()+"&minutos="+$('#minutos').val();
        var url = "ajax/saveorden.php";
        $.ajax({                        
           type: "GET",                 
           url: url,                     
           data: dataString, 
           cache: false,
           contentType: false,
           processData: false,
           success: function(data)             
           {
        	   console.log(data);
    		   $(location).attr('href', 'ordenes.php');
        	},
        	beforeSend:function(objeto){ 
            },
        	error:function(error){
        	}
       });
	 });
	
	 $('#b_guardartarjeta').click(function(){
		console.log("entro");
		var dataString="codigo_tarjeta="+$('#codigo_tarjeta').val()+"&descripcion="+$('#descripcion').val()+"&id_usuario="+$('#id_usuario').val();
        var url = "ajax/savetarjeta.php";
        $.ajax({                        
           type: "GET",                 
           url: url,                     
           data: dataString, 
           cache: false,
           contentType: false,
           processData: false,
           success: function(data)             
           {
        	   console.log(data);
    		   $(location).attr('href', 'tarjetas.php');
        	},
        	beforeSend:function(objeto){ 
            },
        	error:function(error){
        	}
       });
	 });
	

	 $('#b_guardarrecarga').click(function(){
		console.log("entro");
		var dataString="id_tarjeta="+$('#id_tarjeta').val()+"&valor="+$('#valor').val();
        var url = "ajax/saverecargas.php";
        $.ajax({                        
           type: "GET",                 
           url: url,                     
           data: dataString, 
           cache: false,
           contentType: false,
           processData: false,
           success: function(data)             
           {
        	   console.log(data);
    		   $(location).attr('href', 'recargas.php');
        	},
        	beforeSend:function(objeto){ 
            },
        	error:function(error){
        	}
       });
	 });
	


	 

	$('#b_guardarusu').click(function(){
		
		var dataString="usu_nombre="+$('#usu_nombre').val()+"&usu_email="+$('#usu_email').val()+"&usu_rol="+$('#usu_rol').val()+"&usu_pass="+$('#usu_pass').val()+"&usu_tel="+$('#usu_tel').val()+"&usu_dir="+$('#usu_dir').val()+"&usu_iden="+$('#usu_iden').val();
        var url = "ajax/saveusuario.php";
        $.ajax({                        
           type: "GET",                 
           url: url,                     
           data: dataString, 
           cache: false,
           contentType: false,
           processData: false,
           success: function(data)             
           {
        	   console.log(data);
    		   $(location).attr('href', 'usuarios.php');
        	},
        	beforeSend:function(objeto){ 
            },
        	error:function(error){
        	}
       });
	 });
		
     $('#login').click(function(){

     		if($('#login-username').val()==''){
     			$("#msjerror_login" ).html("Debe agregar el usuario");
				showdiv("msjerror_login");
				return;
			}else if($('#login-password').val()==''){
     			$("#msjerror_login" ).html("Debe agregar la contraseña");
				showdiv("msjerror_login");
				return;
			}else{
				
				
				var dataString="user="+$('#login-username').val()+"&pass="+$('#login-password').val();
				var url = "valida.php";
				
		        $.ajax({                        
		           type: "GET",                 
		           url: url,                     
		           data: dataString, 
		           cache: false,
		           contentType: false,
		           processData: false,
		           success: function(data)             
		           {
		        	   console.log(data);
		        	   if(data=='[]'){
						alert(dataString);
		        			$("#msjerror_login" ).html("Usuario o contraseña invalidos");
		       				showdiv("msjerror_login");
		       				return;   
		        	   }else{
		        		   /*console.log(data);
			        	   var content = JSON.parse(data);
			        	   var fila		=content[0];
			        	   console.log(fila.id);
			        	   console.log(fila.user);
			        	   console.log(fila.pass);
			        	   console.log(fila.nombre); */
		        		   $(location).attr('href', 'index.php');
		        	   }
		        	},
		        	beforeSend:function(objeto){ 
		            },
		        	error:function(error){
		        	}
		       });
				
			}

	 });
	 


    function showdiv(div){
		$("#"+div).fadeIn(1500);
   		$("#"+div).fadeOut(1500);
    	$("#"+div).show();
	}
    
});
