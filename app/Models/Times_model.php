<?php
namespace App\Models;
use CodeIgniter\Model;

class Times_model extends Model
{
    protected $table = 'times';
    protected $allowedFields = ['id_time'.'nome_time','flag_time','id_pais'];
    protected $primaryKey = 'id_time';


    public function getAllTimes()
    {
        return $this->findAll();
    }

    public function getTimeById($id = null)
    {
        return $this->find($id);
    }
    public function getTimeByCountrieId($countrieId = null)
    {
        return $this->where('id_gerente',$countrieId);
    }

    public function getTimeByName(string $timeNome = null)
    {
        return $this->where('nome_time',$timeNome)->findAll();
    }

}