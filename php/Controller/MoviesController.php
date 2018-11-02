<?php
require_once  "php/View/MoviesView.php";
require_once  "php/View/PaginaView.php";
require_once  "php/Model/MoviesModel.php";
require_once  "php/Model/GenerosModel.php";
require_once  "php/Model/UsuarioModel.php";
require_once "SecuredController.php";


class MoviesController extends SecuredController{
  private $viewpagina;
  private $viewPDO;
  private $modelpeliculas;
  private $modelgeneros;
  private $modelusuarios;

  function __construct(){
    parent::__construct();
    $this->viewpagina = new PaginaView();
    $this->modelpeliculas = new MoviesModel();
    $this->viewPDO = new MoviesView();
    $this->modelgeneros = new GenerosModel();
    $this->modelusuarios = new UsuarioModel();

  }

  function Home(){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $this->viewpagina->Home($user);
    }else{
      $this->viewpagina->Home("");
    }
  }
  function Contacto(){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $this->viewpagina->Contacto($user);
    }else{
      $this->viewpagina->Contacto("");
    }
  }
  function AllMovies(){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $this->viewpagina->AllMovies($user);
    }else{
      $this->viewpagina->AllMovies("");
    }
  }
  function Login(){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $this->viewpagina->Login($user);
    }else{
      $this->viewpagina->Login("");
    }
  }
  function Registrar(){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $this->viewpagina->Registrar($user);
    }else{
      $this->viewpagina->Registrar("");
    }
  }
  function Sugerencias(){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $this->viewpagina->Sugerencias($user);
    }else{
      $this->viewpagina->Sugerencias("");
    }
  }

  function MostrarPDOGeneros(){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $Generos = $this->modelgeneros->getGenero();
      $this->viewPDO->MostrarGeneros($Generos, $user);
    }else{
      $Generos = $this->modelgeneros->getGenero();
      $this->viewPDO->MostrarGeneros($Generos, "");
    }
  }

  function MostrarPDOPeliculas(){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $Peliculas = $this->modelpeliculas->getPeliculas();
      $Generos = $this->modelgeneros->getGenero();
      $this->viewPDO->MostrarPeliculas($Peliculas, $Generos, $user);
    }else{
      $Peliculas = $this->modelpeliculas->getPeliculas();
      $Generos = $this->modelgeneros->getGenero();
      $this->viewPDO->MostrarPeliculas($Peliculas, $Generos, "");
    }
  }
  function MostrarPDOPeliculasporGenero($Genero){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $Peliculas = $this->modelpeliculas->getPeliculasporGenero($Genero[0]);
      $Generos = $this->modelgeneros->getGenero();
      $this->viewPDO->MostrarPeliculas($Peliculas, $Generos,$user);
    }else{
      $Peliculas = $this->modelpeliculas->getPeliculasporGenero($Genero[0]);
      $Generos = $this->modelgeneros->getGenero();
      $this->viewPDO->MostrarPeliculas($Peliculas, $Generos,"");
    }
  }

  function MostrarPDOeditpelicula($param){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $Pelicula = $this->modelpeliculas->getPelicula($param[0]);
      $Generos = $this->modelgeneros->getGenero();
      $this->viewPDO->MostrarEditar($Pelicula, $Generos, "");
      }else{
        header(LOGIN);
      }
  }

  function MostrarPDOeditgenero($param){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
    $Generos = $this->modelgeneros->getGeneroID($param[0]);
    $this->viewPDO->MostrarEditarGenero($Generos,"");
    }else{
      header(LOGIN);;
    }
  }

  function InsertarGenero(){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $nombre = $_POST["Nombre"];
      $cantpeliculas = $_POST["cantidad_peliculas"];
      $this->modelgeneros->InsertarGenero($nombre, $cantpeliculas);
      header(PDO);
    }else{
      header(LOGIN);
    }
}
function EditarGenero(){
  if(isset($_SESSION["User"])){
   $user = $_SESSION["User"];
   $id_genero = $_POST["id_genero"];
   $nombre = $_POST["Nombre"];
   $cantpeliculas = $_POST["cantidad_peliculas"];
   $this->modelgeneros->EditarGenero($id_genero, $nombre, $cantpeliculas);
   header(PDO);
  }else{
   header(LOGIN);
  }
}

  function BorrarGenero($param){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $this->modelgeneros->BorrarGenero($param[0]);
      header(PDO);
    }else{
      header(LOGIN);
    }
  }

  function BorrarPeli($param){
    if(isset($_SESSION["User"])){
      $user = $_SESSION["User"];
      $this->modelpeliculas->BorrarPeli($param[0]);
      header(PDOPELICULA);
    }else{
      header(LOGIN);
    }
  }

function InsertarPelicula(){
  if(isset($_SESSION["User"])){
    $user = $_SESSION["User"];
    $nombre = $_POST["Nombre_peli"];
    $Año = $_POST["Año"];
    $Valoracion = $_POST["Valoracion"];
    $Duracion = $_POST["Duracion"];
    $genero = $_POST["genero"];
    $this->modelpeliculas->InsertarPelicula($nombre, $Año, $Valoracion ,$Duracion ,$genero);
    header(PDOPELICULA);
  }else{
    header(LOGIN);
  }
}

function EditarPelicula(){
  if(isset($_SESSION["User"])){
    $user = $_SESSION["User"];
    $nombre = $_POST["Nombre_peli"];
    $Año = $_POST["Año"];
    $Valoracion = $_POST["Valoracion"];
    $Duracion = $_POST["Duracion"];
    $genero = $_POST["genero"];
    $id_peli = $_POST["id_peli"];
    $this->modelpeliculas->EditarPelicula($nombre, $Año, $Valoracion ,$Duracion ,$genero,$id_peli);
    header(PDOPELICULA);
  }else{
    header(LOGIN);
  }
}

function Admin(){
  if(isset($_SESSION["User"])){
    $user = $_SESSION["User"];
    $usuarios = $this->modelusuarios->GetUsuario();
    $this->viewpagina->Mostraradmin($user, $usuarios);
  }else{
    header(LOGIN);;
  }
}
}

?>
