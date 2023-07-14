<?php
class ComentarioController extends Controller
{

    // Mostramos la vista para la creación de comentarios
    public function index()
    {
        // Auth::check(); // solo para usuarios identificados
        // if (Login::role('ROLE_READER')) {
        //     $this->loadView('comentario', [
        //         'user' => Login::get(),
        //         // 'comentarios' => Comentario::all()
        //     ]);
        // }

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
        if (!Login::role('ROLE_READER')) {
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
        if (!Login::role('ROLE_READER')) {
            Session::error("No tienes permisos para crear un libro");
            redirect('/');
        }

        $this->loadView('comentario/create', [
            'idnoticia' => $idnoticia
        ]);
    }

    public function store()
    {
        if (!Login::role('ROLE_READER')) {
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
}
