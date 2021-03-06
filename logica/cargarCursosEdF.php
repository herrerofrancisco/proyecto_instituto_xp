<?php
require_once "../logica/Curso.php";
require_once "../logica/AlumnoxCurso.php";
require_once "../presentacion/GUIPreceptor.class.php";
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

/**
 * En este archivo, mediante una llamada de ajax,
 * se cargan todos los cursos de la bdd al archivo cursos.php
 * se hace en forma de lista.
 * @author 
 * @version 1.0
 */

$c = new Curso();
$axc= new AlumnoxCurso();

$usuario=$_SESSION["usuario"];

if($usuario == "rector"){
    $cursos = $c->obtenerCursos();
    $registros = $c->cantRegistros();
    $alumnoXCursoAnio = $axc->obtenerAlumnoxCursoAnio();
}
else{
    $cursos = $c->obtenerCursosxPreceptor($usuario);
    $registros = $c->cantRegistrosxPreceptor($usuario);
}
if ($_REQUEST['funcion'] == 'imprimirCurso') {
    echo ("<form class='form-inline' action=tablaCurso.php>");
} elseif ($_REQUEST['funcion'] == 'verInasistenciasAnio') {
	echo ("<form class='form-inline' id='formuVerInasistencias' action=verInasistencias.php>");
}elseif ($_REQUEST['funcion'] == 'mostrarAlumnos'){
	echo ("<form class='form-inline'  action=../presentacion/mostrarAlumnos.php>");
}
else {
    echo ("<form class='form-inline' action=tabla.php>");
}



if ($_REQUEST['funcion'] == 'verInasistenciasAnio') {
	echo (" <select style='margin: 10px 10px 10px 0' class='form-control mb-2 mr-sm-2 mb-sm-0' id='selCurso' name='selCurso' > <option value='seleccionar...'> Seleccione un curso </option>");
	for ($i = 0; $i < $registros; $i++) {
	    print('<option value="' . $cursos[$i]["idcurso"] . '"> ' . $cursos[$i]["anio"] . '&deg' . $cursos[$i]["nombre"] . '</option>');
	}
	echo ("</select>");

	echo (" <select style='margin: 10px 10px 10px 0' class='form-control mb-2 mr-sm-2 mb-sm-0' id='selAnio' name='selAnio' > <option value='seleccionar...'> Seleccione un año </option>");
	for ($i = 0; $i < count($alumnoXCursoAnio); $i++) {
	    print('<option value="' . $alumnoXCursoAnio[$i]["anio"] . '"> ' . $alumnoXCursoAnio[$i]["anio"].'</option>');
	}
	echo ("</select>");
	echo ("<button type='button' onclick='control()'  class='btn btn-danger'>Buscar</button>");
	echo ("</div>");
	echo ("</div>");
		
}
else{
	echo (" <select style='margin: 10px 10px 10px 0' class='form-control mb-2 mr-sm-2 mb-sm-0' id='sel' name='sel' onchange='this.form.submit()'> <option value=seleccionar...> Seleccione un curso </option>");
	for ($i = 0; $i < $registros; $i++) {
	    print('<option value="' . $cursos[$i]["idcurso"] . '"> ' . $cursos[$i]["anio"] . '&deg' . $cursos[$i]["nombre"] . '</option>');
	}
	echo ("</select>");
}

echo ("</form>");
