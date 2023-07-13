<?php

class NoticiaController extends Controller
{
    // Muestra la pagina home del usuario
    public function index()
    {
        $this->list();
    }

    public function list(int $page = 1)
    {
        $filtro = Filter::apply('noticias');
        $limit = RESULTS_PER_PAGE;
        $total = $filtro ? Noticia::filteredResults($filtro) : Noticia::total();
        $paginator = new Paginator('noticia/list', $page, $limit, $total);

        $noticias = $filtro ?
            Noticia::filter($filtro, $limit, $paginator->getOffset()) : Noticia::orderBy('id', 'ASC', $limit, $paginator->getOffset());


        $this->loadView('noticia/list', [
            'noticias' => $noticias,
            'paginator' => $paginator,
            'filtro' => $filtro,
        ]);
    }

    public function create()
    {
        if (!Login::role('ROLE_WRITER')) {
            Session::error("No tienes permisos para crear un libro");
            redirect('/');
        }

        $this->loadView('noticia/create');
    }

    public function store()
    {
        if (!Login::role('ROLE_WRITER')) {
            Session::error("No tienes permisos para crear un libro");
            redirect('/');
        }

        // Comprobamos que lleguen los datos por post
        if (empty($_POST)) {
            Session::error('No se han recibido datos');
            redirect('/noticia/create');
        }

        // Creamos la noticia
        $noticia = new Noticia();

        // Recogemos los datos del formulario
        $noticia->titulo = $_POST['titulo'];
        $noticia->texto = $_POST['texto'];
        $noticia->iduser = Login::user()->id;

        // Intentamos guardar la noticia en DB
        try {
            //code...
            $noticia->save();

            // Si no llega imagen, guardamos la que hay por defecto
            if (empty($_POST['portada'])) {
                $noticia->imagen = 'default.png';
                $noticia->save();
            }

            // Si llega imagen, la guardamos
            if (Upload::arrive('portada')) {
                $noticia->imagen = Upload::save(
                    // Nombre del input
                    'portada',
                    // Ruta a la carpeta de destino
                    '..public/' . NEWS_IMAGES_FOLDER,
                    // Generar nombre aleatorio
                    true,
                    // Tamaño máximo
                    124000,
                    // TIpo mime
                    'image/*',
                    // Prefijo del nombre
                    'new_image_'
                );
                $noticia->update();
            }
            Session::flash('success', 'Noticia creada correctamente');
            redirect("/noticia/show/$noticia->id");
        } catch (SQLException $ex) {
            //throw $th;
            Session::flash('error', 'Error al crear la noticia');
            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de creación
                redirect('/noticia/create');
            }
        }
        // catch (UploadException $ex) {
        //     //throw $th;
        //     Session::flash('error', $ex->getMessage());
        //     redirect('/noticia/edit/' . $noticia->id);
        // }
    }

    // Método que nos muestra los detalles de la noticia
    public function show(int $id = 0)
    {
        // Comprobamos que nos llega el id
        if (!$id) {
            Session::error('No se ha encontrado la noticia');
            redirect('/noticia');
        }

        // Buscamos la noticia en la DB
        $noticia = Noticia::find($id);

        // Comprobamos que la noticia existe
        if (!$noticia) {
            Session::error('No se ha encontrado la noticia');
            redirect('/noticia');
        }

        // Mostramos la vista
        $this->loadView('noticia/show', [
            'noticia' => $noticia
        ]);
    }

    // Método que nos ayudará a editar la noticia
    public function edit(int $id = 0)
    {
        // Comprobamos que nos llega el id
        if (!Login::role('ROLE_WRITER')) {
            Session::error("No tienes permisos para editar un libro");
            redirect('/');
        }

        // Comprobamos si recibimos el id de la noticia por parametros 
        if (!$id) {
            throw new NotFoundException("No se indicó el libro");
        }

        // Buscamos la noticia en la DB
        $noticia = Noticia::find($id);

        // Comprobamos que la noticia existe
        if (!$noticia) {
            Session::error('No se ha encontrado la noticia');
            redirect('/noticia');
        }

        // Mostramos la vista
        $this->loadView('noticia/edit', [
            'noticia' => $noticia
        ]);
    }

    // Método que nos ayudará a actualizar la noticia

    public function update()
    {
    }
}
