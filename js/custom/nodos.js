function borrarHijos(contenedor){
		while(contenedor.childNodes.length>0){
			contenedor.removeChild(contenedor.childNodes[0]);
		}
	}

		function crearEtiqueta(tag,contenido,att){
			if(contenido!=null){
			var texto=document.createTextNode(contenido);
			}

			if(tag!=null){
				var etiqueta=document.createElement(tag);
				
				if(texto!=null){
					etiqueta.appendChild(texto);
				}
				
				if(att!=null)insertarAtributos(etiqueta,att);

				return etiqueta;
			}

			return texto;
		}

		function insertarAtributos(tag,att){
			for(indice in att){
				tag.setAttribute(indice,att[indice]);
			}
		}