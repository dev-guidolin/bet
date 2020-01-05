<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class Countries_Controller extends Controller
{
    public function index()
    {
        helper('apoio_helper');
        show_array("Todos paises");
    }

}