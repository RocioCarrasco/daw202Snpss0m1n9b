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