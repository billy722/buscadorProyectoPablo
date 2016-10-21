function limpiarDivs(){
		document.getElementById("divContenidoConfiguraciones").innerHTML = "";
		document.getElementById("divContenidoGrupos").innerHTML = "";
}

//SCRIPTS DE MANTENEDOR DE USUARIOS

function cargarMantenedorUsuarios(){
		$(document).ready(function(){

				document.getElementById("divContenidoGruposPrivilegio").innerHTML = "";
				document.getElementById("divPrivilegios").innerHTML = "";

				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorUsuarios/cargarMantenedorUsuarios.php",$("#flc").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
								limpiarDivs();
								document.getElementById("divContenidoConfiguraciones").innerHTML = respuesta;

				});
		});
}

function guardarCambiosMantenedorUsuarios(){

	$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorUsuarios/guardarMantenedorUsuarios.php",$("#formularioMantenedorUsuarios").serialize(),function(respuesta){
					//alert(respuesta);
				$(document).ready( function() {  ocultarCargando();});
				});
		});
}

function guardarNuevoUsuario(){
	var rut= document.getElementById("rutUsuario").value;

	$(document).ready(function(){
		if(validaRut(rut)==false){
				alert("EL RUT INGRESADO NO ES VÁLIDO");
		}else{

					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorUsuarios/guardarNuevoUsuarios.php",$("#formularioNuevoUsuario").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								alert(respuesta);

										cargarMantenedorUsuarios();

					});
		}
	});
}
function eliminarUsuario(rut){

	$(document).ready(function(){
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorUsuarios/eliminarUsuario.php?rut="+rut,$("#formEliminarUsuario").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								alert(respuesta);
							    cargarMantenedorUsuarios();
					});
	});
}
//FIN MANTENEDOR DE USUARIOS


//SCRIPTS MANTENEDOR DE GRUPOS
function cargarMantenedorGrupos(){
		$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorGrupos/cargarMantenedorGrupos.php",$("#flc").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
								limpiarDivs();
								document.getElementById("divContenidoGrupos").innerHTML = respuesta;
				});
		});
}
function guardarCambiosMantenedorGrupo(){

	$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorGrupos/guardarMantenedorGrupo.php",$("#formularioMantenedorGrupo").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
				});
		});
}

function guardarNuevoGrupo(){
	var nombre= document.getElementById("nombreGrupo").value;

	$(document).ready(function(){
		if(nombre==""){
				alert("NO PUEDE DEJAR EL NOMBRE VACÍO");
		}else{
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorGrupos/guardarNuevoGrupo.php",$("#formularioNuevoGrupo").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								//alert(respuesta);
										cargarMantenedorGrupos();
					});
		}
	});
}
function eliminarGrupo(id){

	$(document).ready(function(){

					$.post("./metodosAjax/configuraciones/mantenedorGrupos/eliminarGrupo.php?id="+id,$("#formEliminarGrupo").serialize(),function(respuesta){
								alert(respuesta);
							    cargarMantenedorGrupos();
					});
	});
}
//FIN MANTENEDOR DE GRUPOS

//SCRIPT PARA CARGAR LOS PRIVILEGIOS QUE TIENE UN GRUPO
function seleccionarGrupo(idGrupo){
	$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/privilegiosDeGrupo/cargarPrivilegiosDeGrupo.php?id="+idGrupo,$("#flc").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
								document.getElementById("divContenidoGruposPrivilegio").innerHTML = respuesta;
								mostrarTodosPrivilegios(idGrupo);
				});
		});
}
function quitarPrivilegio(grupo,privilegio){

	$(document).ready(function(){
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/privilegiosDeGrupo/quitarPrivilegio.php?idg="+grupo+"&idp="+privilegio,$("#formQuitarPrivilegio").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								//alert("SE HA QUITADO EL PRIVILEGIO");
							    seleccionarGrupo(respuesta);
					});
	});
}
//FIN

/* FUNCIONES TABLA DE PRIVILEGIOS */
function mostrarTodosPrivilegios(grupo){
	$(document).ready(function(){
				$("#divPrivilegios").html('<div><h2 style="font-style:italic; margin-top:5rem;">CARGANDO...</h2></div>');
				$.post("./metodosAjax/configuraciones/todosPrivilegios/cargarTodosPrivilegios.php?idg="+grupo,$("#flc").serialize(),function(respuesta){

								document.getElementById("divPrivilegios").innerHTML = respuesta;
				});
		});
}
function agregarPrivilegio(grupo,privilegio){

	$(document).ready(function(){
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/todosPrivilegios/agregarPrivilegio.php?idg="+grupo+"&idp="+privilegio,$("#formAgregarUsuario").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								//alert("SE HA AÑADIDO EL PRIVILEGIO AL GRUPO");
							    seleccionarGrupo(respuesta);
					});
	});
}
//FIN


//SCRIPTS MANTENEDOR DE DEPARTAMENTOS
function cargarMantenedorDepartamentos(){
		$(document).ready(function(){

			document.getElementById("divContenidoGruposPrivilegio").innerHTML = "";
			document.getElementById("divPrivilegios").innerHTML = "";

				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorDepartamentos/cargarMantenedorDepartamentos.php",$("#flc").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
								limpiarDivs();
								document.getElementById("divContenidoConfiguraciones").innerHTML = respuesta;

				});
		});
}
function guardarCambiosMantenedorDepartamento(){

	$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorDepartamentos/guardarMantenedorDepartamento.php",$("#formularioMantenedorDepartamento").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
				});
		});
}

function guardarNuevoDepartamento(){
	var nombre= document.getElementById("nombreDepartamento").value;

	$(document).ready(function(){
		if(nombre==""){
				alert("NO PUEDE DEJAR EL NOMBRE VACÍO");
		}else{
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorDepartamentos/guardarNuevoDepartamento.php",$("#formularioNuevoDepartamento").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								//alert(respuesta);
										cargarMantenedorDepartamentos();
					});
		}
	});
}
function eliminarDepartamento(id){

	$(document).ready(function(){
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorDepartamentos/eliminarDepartamento.php?id="+id,$("#formEliminarDepartamento").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								//alert(respuesta);
							    cargarMantenedorDepartamentos();
					});
	});
}
//FIN MANTENEDOR DE DEPARTAMENTOS


//SCRIPTS DE MANTENEDOR DE SOLICITANTES
function cargarMantenedorSolicitantes(){
		$(document).ready(function(){


			document.getElementById("divContenidoGruposPrivilegio").innerHTML = "";
			document.getElementById("divPrivilegios").innerHTML = "";

				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorSolicitantes/cargarMantenedorSolicitantes.php",$("#flc").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
								limpiarDivs();
								document.getElementById("divContenidoConfiguraciones").innerHTML = respuesta;
				});
		});
}

function guardarCambiosMantenedorSolicitantes(){

	$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorSolicitantes/guardarMantenedorSolicitantes.php",$("#formularioMantenedorSolicitantes").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
					   //alert("esta es: "+respuesta);
				});
		});
}

function guardarNuevoSolicitante(){
	var rut= document.getElementById("rutSolicitante").value;

	$(document).ready(function(){
		if(validaRut(rut)==false || rut==""){
				alert("EL RUT INGRESADO NO ES VÁLIDO");
		}else{
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorSolicitantes/guardarNuevoSolicitante.php",$("#formularioNuevoSolicitante").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								alert(respuesta);

										cargarMantenedorSolicitantes();

					});
		}
	});
}
function eliminarSolicitante(rut){

	$(document).ready(function(){

					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorSolicitantes/eliminarSolicitante.php?rut="+rut,$("#formEliminarSolicitante").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								alert(respuesta);
							    cargarMantenedorSolicitantes();
					});
	});
}
//FIN MANTENEDOR DE SOLICITANTES


//SCRIPTS MANTENEDOR DE HORAS
function cargarMantenedorHoras(){
		$(document).ready(function(){

			document.getElementById("divContenidoGruposPrivilegio").innerHTML = "";
			document.getElementById("divPrivilegios").innerHTML = "";

				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorHoras/cargarMantenedorHoras.php",$("#flc").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
								limpiarDivs();
								document.getElementById("divContenidoConfiguraciones").innerHTML = respuesta;
				});
		});
}
function guardarCambiosMantenedorHoras(){

	$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorHoras/guardarMantenedorHoras.php",$("#formularioMantenedorHoras").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
				});
		});
}

function guardarNuevaHora(){
	var nuevaHora= document.getElementById("nuevaHora").value;

	$(document).ready(function(){
		if(nuevaHora==""){
				alert("DEBE INGRESAR UNA HORA");
		}else{
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorHoras/guardarNuevaHora.php",$("#formularioNuevaHora").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								alert(respuesta);
										cargarMantenedorHoras();
					});
		}
	});
}
function eliminarHora(id){

	$(document).ready(function(){

					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorHoras/eliminarHora.php?id="+id,$("#formEliminarHora").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								//alert(respuesta);
							    cargarMantenedorHoras();
					});
	});
}
//FIN MANTENEDOR DE HORAS



/* SCRIPTS MANTENEDOR MOTIVOS DE AUDIENCIA*/


function cargarMantenedorMotivosAudiencia(){

	document.getElementById("divContenidoGruposPrivilegio").innerHTML = "";
	document.getElementById("divPrivilegios").innerHTML = "";

		$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorMotivos/cargarMantenedorMotivos.php",$("#flc").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
								limpiarDivs();
								document.getElementById("divContenidoConfiguraciones").innerHTML = respuesta;
				});
		});
}
function guardarCambiosMantenedorMotivos(){

	$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorMotivos/guardarMantenedorMotivos.php",$("#formularioMantenedorMotivos").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
				});
		});
}

function guardarNuevoMotivo(){
	var nombre= document.getElementById("nombreMotivo").value;

	$(document).ready(function(){
		if(nombre==""){
				alert("NO PUEDE DEJAR EL NOMBRE VACÍO");
		}else{
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorMotivos/guardarNuevoMotivo.php",$("#formularioNuevoMotivo").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								//alert(respuesta);
										cargarMantenedorMotivosAudiencia();
					});
		}
	});
}
function eliminarMotivo(id){

	$(document).ready(function(){

					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorMotivos/eliminarMotivo.php?id="+id,$("#formEliminarMotivo").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								alert(respuesta);
							    cargarMantenedorMotivosAudiencia();
					});
	});
}
//FIN MANTENEDOR MOTIVOS DE AUDIENCIA



//SCRIPTS MANTENEDOR DE POBLACIONES
function cargarMantenedorProfesiones(){
		$(document).ready(function(){

			document.getElementById("divContenidoGruposPrivilegio").innerHTML = "";
			document.getElementById("divPrivilegios").innerHTML = "";

				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorProfesiones/cargarMantenedorProfesiones.php",$("#flc").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
								limpiarDivs();
								document.getElementById("divContenidoConfiguraciones").innerHTML = respuesta;
				});
		});
}
function guardarCambiosMantenedorProfesiones(){

	$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorProfesiones/guardarMantenedorProfesiones.php",$("#formularioMantenedorProfesiones").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
				});
		});
}

function guardarNuevaProfesion(){
	var nuevaProfesion= document.getElementById("nuevaProfesion").value;

	$(document).ready(function(){
		if(nuevaProfesion==""){
				alert("DEBE INGRESAR UNA PROFESION");
		}else{
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorProfesiones/guardarNuevaProfesion.php",$("#formularioNuevaProfesion").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								alert(respuesta);
										cargarMantenedorProfesiones();
					});
		}
	});
}
function eliminarProfesion(id){

	$(document).ready(function(){
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorProfesiones/eliminarProfesion.php?id="+id,$("#formEliminarProfesion").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								//alert(respuesta);
							    cargarMantenedorProfesiones();
					});
	});
}
//FIN MANTENEDOR DE POBLACIONES






//SCRIPTS MANTENEDOR DE ZONAS
function cargarMantenedorZonas(){
		$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorZonas/cargarMantenedorZonas.php",$("#flc").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
								limpiarDivs();
								document.getElementById("divContenidoGrupos").innerHTML = respuesta;
				});
		});
}
function guardarCambiosMantenedorZonas(){

	$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/mantenedorZonas/guardarMantenedorZonas.php",$("#formularioMantenedorGrupo").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
				});
		});
}

function guardarNuevaZona(){
	var nombre= document.getElementById("nombreGrupo").value;

	$(document).ready(function(){
		if(nombre==""){
				alert("NO PUEDE DEJAR EL NOMBRE VACÍO");
		}else{
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/mantenedorZonas/guardarNuevaZona.php",$("#formularioNuevoGrupo").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								alert(respuesta);
										cargarMantenedorZonas();
					});
		}
	});
}
function eliminarZona(id){

	$(document).ready(function(){

					$.post("./metodosAjax/configuraciones/mantenedorZonas/eliminarZona.php?id="+id,$("#formEliminarGrupo").serialize(),function(respuesta){
								alert(respuesta);
							    cargarMantenedorZonas();
					});
	});
}
//FIN MANTENEDOR DE ZONAS

//SCRIPT PARA CARGAR LOS PRIVILEGIOS QUE TIENE UN GRUPO
function seleccionarZona(idGrupo){
	$(document).ready(function(){
				$(document).ready( function() {  mostrarCargando();});
				$.post("./metodosAjax/configuraciones/poblacionesDeZona/cargarPoblacionesDeZona.php?id="+idGrupo,$("#flc").serialize(),function(respuesta){
				$(document).ready( function() {  ocultarCargando();});
								//limpiarDivs();
								document.getElementById("divContenidoGruposPrivilegio").innerHTML = respuesta;
								mostrarTodasPoblaciones(idGrupo);
				});
		});
}
function quitarPoblacion(grupo,privilegio){

	$(document).ready(function(){
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/poblacionesDeZona/quitarPoblacion.php?idg="+grupo+"&idp="+privilegio,$("#formQuitarPrivilegio").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								//alert("SE HA QUITADO EL PRIVILEGIO "+respuesta);
							    seleccionarZona(respuesta);
					});
	});
}
//FIN

/* FUNCIONES TABLA DE PRIVILEGIOS */
function mostrarTodasPoblaciones(grupo){
	$(document).ready(function(){
				$("#divPrivilegios").html('<div><h2 style="font-style:italic; margin-top:5rem;">CARGANDO...</h2></div>');
				$.post("./metodosAjax/configuraciones/todasPoblaciones/cargarTodasPoblaciones.php?idg="+grupo,$("#flc").serialize(),function(respuesta){
								//limpiarDivs();
								document.getElementById("divPrivilegios").innerHTML = respuesta;
				});
		});
}
function agregarPoblacion(grupo,privilegio){

	$(document).ready(function(){
					$(document).ready( function() {  mostrarCargando();});
					$.post("./metodosAjax/configuraciones/todasPoblaciones/agregarPoblacion.php?idg="+grupo+"&idp="+privilegio,$("#formAgregarUsuario").serialize(),function(respuesta){
					$(document).ready( function() {  ocultarCargando();});
								//alert("SE HA AÑADIDO EL PRIVILEGIO AL GRUPO");
							    seleccionarZona(respuesta);
					});
	});
}
//FIN
