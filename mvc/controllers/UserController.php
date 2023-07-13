<?php
class userController extends Controller
{
    // Muestra la pagina home del user
    public function home()
    {
        Auth::check(); // solo para users identificados
        $this->loadView('user/home', [
            'user' => Login::get()
        ]);
    }

    // Muestra la lista de users
    public function list(int $page = 1)
    {
        // Auth::check(); // solo para users identificados
        // Solo para users con rol de administrador
        Auth::check();

        $limit = RESULTS_PER_PAGE;
        $total = User::total();

        // Crear el objeto de paginación
        // Crear el objeto de la paginación
        $paginator = new Paginator('/user/list', $page, $limit, $total);

        // Obtener los users
        $users = User::orderBy('id', 'ASC', $limit, $paginator->getOffset());

        $this->loadView('user/list', [
            'users' => $users,
            'paginator' => $paginator
        ]);
    }

    // Métdo que muestro el detalle del user
    public function show(int $id = 0)
    {
        Auth::check(); // solo para users identificados

        // Obtener el user
        $user = User::find($id);

        // Comprobar que el user existe
        if (!$user) {
            throw new Exception("No se encontró el user $id", 404);
        }

        $this->loadView('user/show', [
            'user' => $user
        ]);
    }

    // Método que muestra el formulario de creación de users
    public function create()
    {
        Auth::check(); // solo para users identificados

        $this->loadView('user/create');
    }

    // Método que guarda el user en la base de datos
    public function store()
    {
        Auth::admin(); // solo para administradores

        // Si no se recibe el formulari
        if (empty($_POST['guardar'])) {
            throw new Exception('No se recibió el formulario');
        }

        // Creamos el nuevo user
        $user = new User();

        // Encriptamos los passwords y los comparamos
        $user->password = md5($_POST['password']);
        $repeat = md5($_POST['repeat-password']);

        // Recuperamos los datos del formulario
        $user->displayname = $_POST['displayname'];
        $user->email = $_POST['email'];
        $user->phone = $_POST['phone'];
        $user->addRole('ROLE_user', $_POST['roles']);

        // Si los passwords no coinciden
        if ($user->password != $repeat) {
            throw new Exception('Los passwords no coinciden');
        }

        try {
            //code...
            $user->save();

            // Si llega el fichero con la imagen
            if (Upload::arrive('portada')) {
                // Guardamos la imagen
                $user->picture = Upload::save(
                    'portada',
                    // Ruta donde se guardará la imagen
                    '../public/' . USER_IMAGE_FOLDER,
                    // Nombre aleatorio
                    true,
                    // Tamaño máximo (en bytes)
                    124000,
                    'image/*',
                    'user_'
                );

                $user->update();
            }

            Session::success("user $user->displayname creado correctamente");
            redirect('/');
        } catch (SQLException $ex) {
            //throw $th;
            Session::error('Error al crear el user');

            // Si estamos en modo debug
            if (DEBUG) {
                // Mostramos la traza
                throw new Exception($ex->getMessage());
            } else {
                // Redirigimos a la página anterior
                redirect('/user/create');
            }
        } catch (UploadException $ex) {
            Session::error('Error al subir la imagen');

            if (DEBUG) {
                throw new Exception($ex->getMessage());
            }
            redirect('/user/create');
        }
    }
}
