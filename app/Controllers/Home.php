<?php namespace App\Controllers;
use App\Models\Consultas_model;
use App\Models\Ligas_model;
use App\Models\Paises;
use App\Models\Paises_model;
use App\Models\ShowBets;
use App\Controllers;

class Home extends BaseController
{


	public function index()
	{
	    helper('apoio_helper');

        echo view('head');
        echo view('welcome_message');

    }
    public function countries()
    {
        helper('apoio_helper');

        $model = new Paises_model();
        $data['paises'] = $model->getAllCountries();

        echo view('head');
        echo view('countries',$data);


    }

    public function leagues($slug)
    {
        helper("apoio_helper");
        $model = new Consultas_model();
        $data['ligas'] =$model->getLigasByCountrieSlug($slug);
        echo view('head');
        echo view('ligas',$data);
    }
    public function matches($data1,$data2)
    {
        helper("apoio_helper");
        $model = new Consultas_model();
        $data['matches'] = $model->getMatchesByLigaSlug($data2);
        echo view('head');
        echo view('partidas',$data);
    }

}
