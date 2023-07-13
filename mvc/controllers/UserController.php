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
        $user->addRole('ROLE_USER', $_POST['roles']);

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
                    1240000000,
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

    public function edit(int $id = 0)
    {
        Auth::admin(); // solo para administradores

        // Recuperamos el id vía GET
        $user = User::find($id);

        // Si no existe el User
        if (!$user) {
            throw new Exception("No se encontró el usuario $id");
        }

        // Mostramos la vista de edición
        $this->loadView('user/edit', [
            'user' => $user
        ]);
    }

    // Método update(): Procesa los datos del formulario de edición del user
    public function update()
    {
        if (!Login::oneRole(['', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }
        // Si no llegan los datos a guardar
        if (empty($_POST)) {
            throw new Exception('No se recibieron datos');
        }

        // recuperamos el id vía POST
        $id = intval($_POST['id']);

        // Recuperamos el user de la BDD
        $user = User::find($_POST['id']);

        // Si no existe el user
        if (!$user) {
            throw new Exception("No se encontró el usuario $id");
        }

        // Recuperamos el resto de campos
        $user->displayname = $_POST['displayname'];
        $user->email = $_POST['email'];
        $user->phone = $_POST['phone'];

        // Guardamos el user en la BDD
        try {
            $user->update();

            // Si llega el fichero con la imagen
            $secondUpdate = false;
            $oldCover = $user->picture;

            // Guardamos la imagen anterior
            if (Upload::arrive('portada')) {
                // Guardamos la imagen
                $user->picture = Upload::save(
                    'portada',
                    // Ruta donde se guardará la imagen
                    '../public/' . USER_IMAGE_FOLDER,
                    // Nombre aleatorio
                    true,
                    // Tamaño máximo (en bytes)
                    0,
                    'image/*',
                    'user_'
                );

                $secondUpdate = true;
            }

            // Si hay que eliminar la imagen anterior
            if (isset($_POST['eliminarportada']) && $oldCover && !Upload::arrive('portada')) {
                $user->picture = null;
                $secondUpdate = true;
            }

            if ($secondUpdate) {
                $user->update();
                @unlink('../public/' . USER_IMAGE_FOLDER . $oldCover); // Eliminamos la portada anterior
            }

            Session::flash('success', "Usuario $user->displayname actualizado correctamente");
            // Redireccionar a la lista de users
            redirect("/User/edit/$id");
        } catch (SQLException $ex) {
            //throw $th;
            Session::flash('error', "No se pudo actualizar el usuario $user->displayname");

            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de edición
                redirect("/User/edit/$id");
            }
        } catch (UploadException $ex) {
            Session::flash('error', 'El usuario se actualizó correctamente pero no se pudo subir la portada');

            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                redirect("/User/edit/$user->id"); // Redireccionamos al formulario de edición
            }
        }
    }

    // Método delete(): Procesa los datos del formulario de confirmación de eliminación
    public function delete(int $id = 0)
    {
        if (!Login::oneRole(['', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }

        // Comprobamos si llega el id del user a borrar
        if (!$id) {
            throw new NotFoundException("No se indicó el user");
        }

        // Recuperar el user con el id especificado
        $user = User::find($id);

        // Si no existe el user mostramos un error
        if (!$user) {
            throw new Exception("No se encontró el user $id");
        }

        // Cargamos la vista para confirmar el borrado del user
        $this->loadView('user/delete', ['user' => $user]);
    }

    // Método destroy(): Elimina el user de la BDD
    public function destroy()
    {
        if (!Login::oneRole(['', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }

        // Comprobamos que llegue el formulario de confirmación
        if (empty($_POST)) {
            throw new Exception('No se recibieron datos');
        }

        // Recuperar el id via post
        $id = intval($_POST['id']);
        // Recuperamos el user con el id especificado
        $user = User::find($_POST['id']);

        // Si no existe el user mostramos un error
        if (!$user) {
            throw new Exception("No se encontró el user $id");
        }

        try {
            //code...
            $user->deleteObject();

            // Si el user tenía portada, la eliminamos
            if ($user->picture) {
                @unlink('../public/' . USER_IMAGE_FOLDER . '/' . $user->picture);
            }

            Session::flash('success', "Usuario $user->displayname borrado correctamente");
            // Redireccionar a la lista de users
            redirect('/User/list');
        } catch (\Throwable $th) {
            //throw $th;

            Session::flash('error', "No se pudo borrar el usuario $user->displayname");

            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($th->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de borrado
                redirect("/User/delete/$id");
            }
        }
    }
}
