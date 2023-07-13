<?php
class RegisterController extends Controller
{
    // Muestra el formulario de registro 
    public function index()
    {
        Auth::guest();
        $this->loadView('register');
    }
}
