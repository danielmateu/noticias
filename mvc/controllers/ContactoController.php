<?php
class ContactoController extends Controller
{
    // Muestra la pagina home del usuario
    public function index()
    {
        // Auth::check(); // solo para usuarios identificados
        $this->loadView('contacto', [
            'user' => Login::get()
        ]);
    }
}
