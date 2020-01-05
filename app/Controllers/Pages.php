<?php


namespace App\Controllers;
use CodeIgniter\Controller;

class Pages extends Controller
{
    public function index()
    {
        return view("Welcome_message");
    }
    public function showme($page = "home")
    {

        if (!is_file(APPPATH.'/views/pages/'.$page.'.php'))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $data['title'] = ucfirst($page);

        echo view('template/header',$data);
        echo view('pages/'.$page,$data);
        echo view('template/footer',$data);

    }

}