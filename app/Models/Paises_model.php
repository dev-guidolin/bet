<?php


namespace App\Models;


use CodeIgniter\Model;

class Paises_model extends Model
{
    protected $table = 'paises';
    protected $primaryKey ='id_pais';
    protected $allowedFields = ['id_pais','nome_pais','flag','slug'];



    public function getAllCountries()
    {
        return $this->findAll();
    }

    public function getCountrieById($idCountrie = null)
    {
        return $this->find($idCountrie);
    }
    public function getCountrieByName( string $countrieName = null)
    {
        return $this->where('nome_pais',$countrieName);
    }

    public function getCountrieBySlug(string $slug = null)
    {
        return $this->where('nome_pais',$slug)->first();
    }

}