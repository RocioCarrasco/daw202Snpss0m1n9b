/*
	function pintarHTML(){
		var html="<!DOCTYPE html>
<html lang=\"es\">
	<head>
		<meta charset=\"utf-8\">
		<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<title></title>
		<meta name=\"author\" content=\"\">
		<meta name=\"description\" content=\"\">

		<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">
		
		<link href=\"css/custom.css\" rel=\"stylesheet\">
		<link rel=\"stylesheet\" type=\"text/css\" href=\"css/custom_base.css\">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
			<script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
		<![endif]-->
		<script type=\"text/javascript\" src=\"js/custom/custom.js\"></script>

	</head>
	<body>

	</body>
</html>";

		document.write(html);
	}
*/
			function seleccionar(idOptioninSelect){
				var option=document.getElementById(idOptioninSelect);
				if(option.getAttribute('selected')!=null){
					option.removeAttribute('selected');
					option.selected=false;
					//quitar foco, deseleccionar
				}else{
					option.setAttribute('selected','selected');
					option.selected=true;
					//añadir foco, seleccionar
				}
			}

			function arregloColaboradoresSeleccionados(){
				var options=document.getElementById("tx_collabs").options;
				var indices=options.length;

				var opcArray=new Array();
				var opc='[';
				for(var it=0;it<indices;it++){
					if(options[it].getAttribute('selected')!=null){
					//	opc+='\"'+options[it]+'\"';
						opcArray.push(options[it].value);
					}
				}

				if(opcArray.length>0)opc+='\"';
				opc+=opcArray.join("\",\"");
				opc+='\"]';

				if(opc.length>3){
					var hideInput=document.getElementById("tx_hidden_collabs");
					hideInput.value=opc;
				}

			}

			function setIdRequest(){
				var inputHide=document.getElementById("id_REQUEST");
				inputHide.value=Number(new Date());
			}

			function antesNuevoPro(){
				arregloColaboradoresSeleccionados();
				setIdRequest();
			}

			function antesNuevoTar(){
				setIdRequest();
			}