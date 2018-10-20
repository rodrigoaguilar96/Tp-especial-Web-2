<?php
require_once  "php\View\MoviesView.php";
require_once  "php\View\PaginaView.php";
require_once  "php\Model\MoviesModel.php";
require_once  "php\Model\GenerosModel.php";
require_once "SecuredController.php";


class MoviesController extends SecuredController{
  private $viewpagina;
  private $viewPDO;
  private $modelpeliculas;
  private $modelgeneros;


  function __construct(){
    parent::__construct();
    $this->viewpagina = new PaginaView();
    $this->modelpeliculas = new MoviesModel();
    $this->viewPDO = new MoviesView();
    $this->modelgeneros = new GenerosModel();
  }


  function Home(){
    $this->viewpagina->Home();
  }
  function Contacto(){
    $this->viewpagina->Contacto();
  }
  function AllMovies(){
    $this->viewpagina->AllMovies();
  }
  function Login(){
    $this->viewpagina->Login();
  }


  function MostrarPDO(){
    $Peliculas = $this->modelpeliculas->getPeliculas();
    $Generos = $this->modelgeneros->getGenero();
    $this->viewPDO->MostrarTabla($Peliculas, $Generos);

  }

  function MostrarPDOedit($param){
    $Pelicula = $this->modelpeliculas->getPelicula($param[0]);
    $Generos = $this->modelgeneros->getGenero();
    $this->viewPDO->MostrarEditar($Pelicula, $Generos);
  }

  function InsertarGenero(){
    $nombre = $_POST["Nombre"];
    $cantpeliculas = $_POST["cantidad_peliculas"];
    $this->modelgeneros->InsertarGenero($nombre, $cantpeliculas);
    header("Location: http://".$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]));
}
function EditarGenero(){
  $nombre = $_POST["Nombre"];
  $cantpeliculas = $_POST["cantidad_peliculas"];
  $this->modelgeneros->EditarGenero($nombre, $cantpeliculas, $id_genero);
  header("Location: http://".$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]));
}

  function BorrarGenero($param){
    $this->modelgeneros->BorrarGenero($param[0]);
    header("Location: http://".$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]));
  }

  function BorrarPeli($param){
    $this->modelpeliculas->BorrarPeli($param[0]);
    header("Location: http://".$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]));
  }

function InsertarPelicula(){
  $nombre = $_POST["Nombre_peli"];
  $Año = $_POST["Año"];
  $Valoracion = $_POST["Valoracion"];
  $Duracion = $_POST["Duracion"];
  $genero = $_POST["genero"];
  $this->modelpeliculas->InsertarPelicula($nombre, $Año, $Valoracion ,$Duracion ,$genero);
  header("Location: http://".$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]));
}

function EditarPelicula(){
  $nombre = $_POST["Nombre_peli"];
  $Año = $_POST["Año"];
  $Valoracion = $_POST["Valoracion"];
  $Duracion = $_POST["Duracion"];
  $genero = $_POST["genero"];
  $id_peli = $_POST["id_peli"];
  $this->modelpeliculas->EditarPelicula($nombre, $Año, $Valoracion ,$Duracion ,$genero,$id_peli);
  header("Location: http://".$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]));
}

}

?>
