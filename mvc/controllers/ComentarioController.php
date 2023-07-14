<?php
class ComentarioController extends Controller
{

    // Mostramos la vista para la creación de comentarios
    public function index()
    {
        Auth::check(); // solo para usuarios identificados

        $this->list();
    }

    // Método list para mostrar todos los comentarios
    public function list(int $page = 1)
    {
        // Resultados por página 
        $limit = RESULTS_PER_PAGE;
        $total = Comentario::total();

        // Crear objeto de paginación
        $pagination = new Paginator('Comentario/list', $page, $limit, $total);

        // Obtener los comentarios
        $comentarios = Comentario::orderBy('id', 'DESC', $limit, $pagination->getOffset());

        // Obtener al usuario
        $user = Login::user();

        // Cargar la vista
        $this->loadView('comentario/list', [
            'comentarios' => $comentarios,
            'pagination' => $pagination,
            'user' => $user
        ]);
    }

    // Método para mostrar un comentario
    public function show(int $id = 0)
    {
        // Auth::check(); // solo para usuarios identificados
        if (!Login::role('ROLE_USER')) {
            Session::error("No tienes permisos para ver un comentario");
            redirect('/noticia');
        }

        // Comprobar que nos llega el id
        if (!$id) {
            Session::error('Debes indicar un comentario');
            redirect('/noticia');
        }

        // Obtener el comentario
        $comentario = Comentario::find($id);

        // Comprobar que existe el comentario
        if (!$comentario) {
            Session::error('El comentario no existe');
            redirect('/noticia');
        }

        // Cargar la vista
        $this->loadView('comentario/show', [
            'comentario' => $comentario
        ]);
    }


    public function create(int $idnoticia = 0)
    {
        // Auth::check(); // solo para usuarios identificados
        if (!Login::role('ROLE_USER')) {
            Session::error("No tienes permisos para crear un comentario");
            redirect('/');
        }

        $this->loadView('comentario/create', [
            'idnoticia' => $idnoticia
        ]);
    }

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

    // Método para editar un comentario

    // Método para actualizar un comentario

    // Método para eliminar un comentario
    public function delete(int $id = 0)
    {
        if (!Login::role('ROLE_USER')) {
            Session::error("No tienes permisos para eliminar un comentario");
            redirect('/');
        }

        // Comprobar que nos llega el id
        if (!$id) {
            Session::error('Debes indicar un comentario');
            redirect('/noticia');
        }

        // Obtener el comentario
        $comentario = Comentario::find($id);

        // Comprobar que existe el comentario
        if (!$comentario) {
            Session::error('El comentario no existe');
            redirect('/noticia');
        }

        // Cargamos la vista de confirmación
        $this->loadView('comentario/delete', [
            'comentario' => $comentario
        ]);
    }

    public function destroy()
    {
        if (!Login::role('ROLE_USER')) {
            Session::error("No tienes permisos para eliminar un comentario");
            redirect('/');
        }

        // Comprobar que nos llegue el id por post
        if (empty($_POST['id'])) {
            Session::error('No se ha indicado el comentario a eliminar');
            redirect('/noticia');
        }

        // Recuperar el id por post
        $id = intval($_POST['id']);

        // Comprobar que existe el comentario
        if (!$comentario = Comentario::find($id)) {
            Session::error('El comentario no existe');
            redirect('/noticia');
        }

        // Eliminar el comentario
        try {
            //code...
            $comentario->deleteObject();
            Session::flash('success', 'Comentario eliminado correctamente');
            redirect('/noticia');
        } catch (SQLException $ex) {
            //throw $th;
            Session::flash('error', 'Error al eliminar el comentario');
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
