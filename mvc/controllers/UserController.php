<?php
class UserController extends Controller
{
    // Muestra la pagina home del usuario
    public function home()
    {
        Auth::check(); // solo para usuarios identificados
        $this->loadView('user/home', [
            'user' => Login::get()
        ]);
    }
}
