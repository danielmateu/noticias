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
}
