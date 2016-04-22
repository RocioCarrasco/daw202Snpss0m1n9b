/*
	INICIALIZACIÓN DE ELEMENTOS
*/
//recoger eventos del servidor
//var boton_evento=$.ajax();

$(document).ready(function(){
	//boton_evento['link_logout']=xajax_logOut;
	//boton_evento['bt_newPro']=xajax_pintarFormulario;

	/*
	 $('.clicker').each(function(indice,elemento){
	 		if(boton_evento[$(elemento).attr('id')]!=null){
	 			//$(elemento).click(boton_evento[$(elemento).attr('id')]);
	 			iniciarEventos(elemento,$(elemento).attr('id'));
	 		}
	 });
*/
	iniciarFormato();
	iniciarEventos();
});

function iniciarFormato(){
		$('#main section:nth-child(even').css({'background-color':'rgba(240, 240, 240, 0.8)'});
}
function iniciarEventos(){
	$('.main-header-bt').click(abrirMobileNav);
	$('.close-header-bt').click(cerrarMobileNav);
	
	$('.link_logout').click(function(){xajax_logOut();});
	$('.link_vmain').click(function(){xajax_load_main();});

	$('#bt_main_menu').click(abrirMobileMenu);

	$('.cmd_nPro').click(abrirFormNProyecto);
	$('.bt_cerrarForm').click(cerrarForm);
	//cerrar form
}

	function abrirMobileNav(){
		$('.main-header-bt').hide();
		$('.exit-header-bt').css({'display':'inline-block'});
		$('.close-header-bt').css({'display':'inline-block'});
		/*$('#mobile_nav_container').css({'display':'block'});
		*/
		$('.display_mobile').css({
			'background-color':'rgba(255, 255, 224, 0.8)',
			'position':'fixed',
			'width':'100%',
			'height':'100%'
		});
		$('#mobile_nav_container').show();
	}
	function cerrarMobileNav(){
		$('.main-header-bt').show();
		$('.exit-header-bt').removeAttr('style');
		$('.close-header-bt').removeAttr('style');
	/*	$('#mobile_nav_container').removeAttr('style');
		*/
		$('.display_mobile').removeAttr('style');
		$('#mobile_nav_container').hide();
	}

	function abrirMobileMenu(){
		$('#bt_main_menu').unbind('click',abrirMobileMenu);
		$('#bt_main_menu').click(cerrarMobileMenu);
		$('#mobile_menu_container').show();
	}
	function cerrarMobileMenu(){
		$('#bt_main_menu').unbind('click',cerrarMobileMenu);
		$('#bt_main_menu').click(abrirMobileMenu);
		$('#mobile_menu_container').hide();
	}

	function mostrarAside(){
		$('body > aside').show();
	}
	function ocultarAside(){
		$('body > aside').hide();
	}


	function abrirFormNProyecto(){
		$('aside').css({'left':'0'});
		$('body #pop-menu').show();
	}
	function cerrarForm(){
		$('aside').removeAttr('style');
		$('body #pop-menu').hide();
	}
// var boton_evento=new Array();

	
// $(document).ready(function(){
// 	boton_evento['link_logout']=xajax_logOut;
// 	//boton_evento['bt_newPro']=xajax_pintarFormulario;

// 	 $('.clicker').each(function(indice,elemento){
// 	 		if(boton_evento[$(elemento).attr('id')]!=null){
// 	 			//$(elemento).click(boton_evento[$(elemento).attr('id')]);
// 	 			iniciarEventos(elemento,$(elemento).attr('id'));
// 	 		}
// 	 });

// });


// function iniciarEventos(elemento,indice){
// 	if(indice=='bt_newPro'){
// 		$(elemento).click(xajax_pintarFormulario());
// 	}
// 	if(indice=='link_logout'){
// 		$(elemento).click(xajax_logOut());
// 	}
// }
