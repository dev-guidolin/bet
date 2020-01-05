<?php namespace App\Controllers;
use App\Models\NewsModel;
use CodeIgniter\Controller;


class News extends Controller
{
    public function index()
    {
        helper('apoio_helper');
        show_array("NEWS");

    }

    public function view($slug = NULL)
    {
        $model = new NewsModel();

        $data['news'] = $model->getNews($slug);

        if (empty($data['news']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: '. $slug);
        }

        $data['title'] = $data['news']['title'];

        echo view('template/header', $data);
        echo view('news/view', $data);
        echo view('template/footer');
    }

    public function create()
    {
        helper('form');
        helper('apoio_helper');

        $model = new NewsModel();

        if (! $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body'  => 'required'
        ]))
        {
            echo view('template/header', ['title' => 'Criar novo artigo']);
            echo view('news/create');
            echo view('template/footer');

        }else{
            $model->save([
                'title'=> $this->request->getVar('title'),
                'slug' => urlTitle($this->request->getVar('title')),
                'body' => $this->request->getVar('body'),
            ]);
            echo view('news/success');
        }

    }

}