<?php

class LoginRegisterController extends BaseController
{
    public function login () 
    {
        require "views/auth/login.php";
    }

    public function register() 
    {
        require "views/auth/register.php";
    }
}

?>