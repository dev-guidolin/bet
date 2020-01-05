<?php
namespace App\Models;
use CodeIgniter\Model;

class Localidades_model extends Model
{
    protected $table = 'cidades';
    protected $allowedFields = ['id_cidade','id_uf','nome_cidade'];
    protected $primaryKey = 'id_cidade';



    /*
     * Retorna todas as cidades
     */
    public function getAllCities()
    {
        return $this->asArray()->findAll();
    }

    /*
     * Retorna uma Cidade por ID
     */
    public function getCitieById($id =null)
    {
        return $this->find($id);
    }

    /*
     * Retorna cidades pelo ID do Estado
     */
    public function getCitiesByUfId($idUf = null)
    {
        return $this->where('id_uf',$idUf)->findAll();
    }

    /*
     * Retorna uma cidade pelo slug (url amigável)
     */
    public function getCitieBySlug($slug = null)
    {
        return $this->where('slug_cidade',$slug)->find();
    }

    /*
     * Retorna cidades pelo nome
     */
    public function getCitieByName($name = null)
    {
        return $this->where('nome_cidade',$name)->findAll();
    }

}