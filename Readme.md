- Crear Virtualhost:
  Editar el fichero como administrador c:/windows/system32/drivers/etc/hosts -> añadimos la linea 127.0.0.1 noticias

- Editamos el fichero c:/xamp/apache2/conf/extra/httpd-vhosts.conf
  copiar-pegar el vhost cambiando el nobre del proyecto

- Reiniciamos apache!

PLANTEAMIENTO DE LO QUE HAY QUE HACER

Queremos una aplicación que permita publicar noticias, a modo de blog.
Las noticias tendrán un título, un texto y una imagen. También tendrán la fecha de publicación y fecha de actualización.

- Se mostrarán en un listado de 5 noticias por página y ordenadas por fecha de publicación descendente. Al hacer clic en una noticia, se mostrará la noticia junto con los comentarios de los usualistrios en una página nueva.

- Solamente podrán publicar noticias los redactores y también podrán modificar sus propias noticias. No las podrán eliminar.

- Los editores podrán editar o borrar cualquier noticia pero no podrán crear noticias nuevas.

- Existirá un perfil de administrador. El usuario administrador podrá añadir nuevos usuarios.

- Un lector podrá darse de alta en el sistema mediante la operación de registro. Un lector será también un usuario,con el rol de lector y no podrá modificar ni crear noticias,
pero sí comentarlas.

- Los usuarios invitados (no identificados) podrán leer las noticias y nada más.

- Existirá una home de usuario (página personal) y una operación de contacto.

OPCIONAL: búsqueda de noticias.
OPCIONAL: el usuario moderador puede eliminar comentarios.
OPCIONAL: en la home de un usuario redactor se listan todas las noticias que ha redactado.
OPCIONAL: en la home de un usuario lector se listan todos los comentarios que ha hecho.
OPCIONAL: el administrador puede quitar o añadir roles a los usuarios.
OPCIONAL: el administrador puede dar de baja usuarios.
OPCIONAL: el lector podrá borrar sus propios comentarios.

CASOS DE USO

CU01 - Registro de usuario: en la parte superior derecha, el usuario hará clic sobre el enlace “registro”. El sistema le mostrará el formulario de registro. El usuario rellena los datos y pulsa el botón “enviar”. El sistema guarda los datos y notifica al usuario que el proceso se ha realizado correctamente.

CU02 contacto - desde el menú principal, el usuario pulsará “contactar”. El sistema le mostrará un formulario de contacto que el usuario rellenará y enviará. Llegará un mail al administrador con la consulta y el sistema redirigirá al usuario a la portada junto con un mensaje de éxito.

- CU03 ver listado noticias: cuando el usuario acceda a la aplicación se le mostrará el listado de noticias en la portada.

CU04 ver noticia: el usuario pulsará el enlace “ver más” sobre una noticia. El sistema le mostrará la noticia completa junto con los comentarios que tenga.

CU05 comentar noticia: un lector correctamente identificado podrá pulsar el enlace “comentar” en la página de detalles de la noticia. El sistema le mostrará un formulario, el usuario lo rellena y lo envía, el sistema guarda el comentario y le redirige a los detalles de la noticia (PRIORIDAD BAJA).

CU06 - OPCIONAL borrar comentario: desde los detalles de la noticia o desde la home, el usuario puede borrar sus comentarios (PRIORIDAD BAJA).

- CU07 escribir noticia: el redactor pulsará el enlace “escribir noticia” en el menú. Sistema muestra formulario, redactor escribe y envía, sistema guarda y redirige a detalles de la noticia.

- CU08 modificar noticia: el editor o el redactor, desde el listado de noticias o los detalles de la noticia podrá pulsar el botón “editar”. El sistema muestra formulario, usuario edita y envía, sistema guarda y mantiene en edición de la noticia. OJO: el redactor tan solo puede editar sus propias noticias.

- CU09 borrar noticia: el editor, desde el listado de noticias o detalles de la noticia podrá borrar la noticia (con confirmación). El sistema te lleva a la lista de noticias.

- CU10 alta usuario: el administrador podrá crear un nuevo usuario desde el menú principal. El sistema le mostrará formulario, el admin rellenará los datos y elegirá el rol del nuevo usuario (lector, redator, editor, administrador). El sistema guarda y regresa a la portada.

- CU11 identificarse: desde la parte superior derecha de la página, el usuario podrá pulsar el enlace a “login”. El sistema le mostrará el formulario de login que rellenará y enviará. El sistema dará acceso al usuario y lo redirigirá a su espacio personal (home).

DIBUJAR INTERFICIES GRÁFICAS (páginas) → diseñadores

DISEÑO DE LA BDD

Modelo entidad relación:

ESQUEMA RELACIONAL

Una vez pasado a MariaDB/MySQL:

PREPARAR EL PROYECTO

INSTRUCCIONES PARA EL PROYECTO

CONSIDERACIÓN 1 (AUTORIZACIÓN):

Ejemplo: solamente el usuario redactor puede escribir una noticia, por tanto en los métodos create() y store() de NoticiaController tenemos que vigilar la autorización, con:

Auth::role(‘ROLE_WRITER’);

o bien

if(!Login::role(‘ROLE_WRITER’)){
Session::error(‘No tienes permiso para realizar esta operación.’);
redirect(‘/’);
}

Habrá que controlar la autorización en todos los métodos de controlador que no sean para todos los usuarios.

CONSIDERACIÓN 2 (entidades relacionadas):

Al guardar una noticia, se guarda el id del usuario que la escribe en el campo iduser de la noticia. Por tanto, en el método store() de NoticiaController...

//…
$noticia = new Noticia();

$noticia->titulo = $this->request->post(‘titulo’);
$noticia->texto = $this->request->post(‘texto’);
$noticia->iduser = Login::user()->id;

//…
$noticia→save();

CONSIDERACION 3 (autor de la noticia o del comentario):

- Al mostrar las noticias, estaría bien mostrar la fecha y quién ha escrito esa noticia. Por ejemplo, en el método show() de NoticiaController podríamos hacer:

// cargar la vista…

CONSIDERACION 4 (espacio personal HOME):

Sería interesante, en la HOME del usuario, mostrar las noticias que ha escrito o los comentarios que ha realizado. Por tanto, en el método home() de UserController, podemos tener algo como…

// comprobar que el usuario está identificado

$user = Login::user();
$noticias = $user->hasMany(‘Noticia’);
// recuperar también los comentarios

// cargar la vista pasándole usuario, noticias y comentarios

CONSIDERACION 5 (comprobar autoría de la noticia o comentario):

Un lector solamente puede borrar sus propios comentarios. En el método destroy() del ComentarioController, tendríamos algo así:

if($comentario->iduser != Login::user()->id && !Login::isAdmin())
throw new AuthException(‘No puedes borrar comentarios que no son tuyos’);

o bien:

if($comentario->iduser != Login::user()->id && !Login::isAdmin()){
Session::error(‘No puedes borrar comentarios que no son tuyos.’);
redirect(‘/’);
}

CONSIDERACIÓN 6 (esconder o mostrar botones):

Para ocultar el botón de editar noticia a los usuarios que no tengan permiso para editar las noticias, en las vistas pertinentes podemos hacer:

if($noticia->iduser == Login::user()->id || Login::user()->role(‘ROLE_EDITOR’)){
	echo “<a class=’button’ href=’/Noticia/edit/$noticia->id’ >Editar</a>”;
}
