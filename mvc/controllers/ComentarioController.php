<?php
class ComentarioController extends Controller
{
    public function store()
    {
        if (!Login::role('ROLE_USER')) {
            Session::error("No tienes permisos para crear un comentario");
            redirect('/');
        }

        // Comprobamos que lleguen los datos por post
        if (empty($_POST)) {
            Session::error('No se han recibido datos');
            redirect('/noticia');
        }

        $texto = $_POST['texto'];
        $user = Login::user();
        $iduser = $user->id;
        $idnoticia = $_POST['id_noticia'];

        // Comprobamos que los datos sean correctos
        if (empty($texto)) {
            Session::error('El texto no puede estar vacío');
            redirect('/noticia');
        }

        // Creamos el comentario
        $comentario = new Comentario();

        $comentario->texto = $texto;
        $comentario->iduser = $iduser;
        $comentario->idnoticia = $idnoticia;


        // Intentamos guardar la noticia en DB
        try {
            //code...
            $comentario->save();



            Session::set('success', 'Comentario creado correctamente');
            redirect("/noticia/show/$idnoticia");
        } catch (SQLException $ex) {
            //throw $th;
            Session::flash('error', 'Error al crear la noticia');
            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de creación
                redirect('/noticia');
            }
        }
    }
}
