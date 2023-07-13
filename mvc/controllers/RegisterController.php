<?php
class RegisterController extends Controller
{
    // Muestra el formulario de registro 
    public function index()
    {
        Auth::guest();              // solo para usuarios no identificados
        $this->loadView('register');   // carga la vista de login     
    }

    public function store()
    {
        Auth::guest();              // solo para usuarios no identificados

        // Si no se recibe el formulari
        if (empty($_POST['register'])) {
            throw new Exception('No se recibió el formulario');
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
                    12400000000,
                    'image/*',
                    'user_'
                );

                $user->update();
            }

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
        } catch (UploadException $ex) {
            Session::error('Error al subir la imagen');

            if (DEBUG) {
                throw new Exception($ex->getMessage());
            }
            redirect('/User/create');
        }
    }
}
