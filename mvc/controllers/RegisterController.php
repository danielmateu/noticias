<?php
class RegisterController extends Controller
{
    // Muestra el formulario de registro 
    public function index()
    {
        Auth::guest();
        $this->loadView('register');
    }

    public function store()
    {
        // Auth::admin(); // solo para administradores

        // Si no se recibe el formulari
        // comprobar que llegan los datos
        if (!$this->request->has('register')) {
            Session::error("No se recibió el formulario de Registro.");
            redirect('/Register');
        }

        // Creamos el nuevo usuario
        $user = new User();

        // Encriptamos los passwords y los comparamos
        $user->password = md5($_POST['password']);
        $repeat = md5($_POST['repeat-password']);

        // Recuperamos los datos del formulario
        $user->displayname = $_POST['displayname'];
        $user->email = $_POST['email'];
        $user->phone = $_POST['phone'];
        $user->addRole('ROLE_USER');

        // Si los passwords no coinciden
        if ($user->password != $repeat) {
            throw new Exception('Los passwords no coinciden');
        }

        try {
            //code...
            $user->save();

            Session::success("Usuario $user->displayname creado correctamente");
            redirect('/');
        } catch (SQLException $ex) {
            //throw $th;
            Session::error('Error al crear el usuario');

            // Si estamos en modo debug
            if (DEBUG) {
                // Mostramos la traza
                throw new Exception($ex->getMessage());
            } else {
                // Redirigimos a la página anterior
                redirect('/User/create');
            }
        }
    }
}
