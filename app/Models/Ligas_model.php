<?php
namespace App\Models;
use CodeIgniter\Model;

class Ligas_model extends Model
{

    protected $table = 'ligas';
    protected $primaryKey = 'id_liga';
    protected $allowedFields = ['id_liga','nome_liga','slug'];

    public function getAllLeagues()
    {
        return $this->findAll();
    }

    public function getLeagueById($id = null)
    {
        return $this->find($id);
    }
    public function getLeaguesByCountriId($idCountrie = null)
    {
        return $this->where('id_pais',$idCountrie)->findAll();
    }

    public function getLeagueBySlug(string $slug = null)
    {
        return $this->where('slug',$slug)->first();
    }

    public function getLeagueByName(string $leagueName = null)
    {
        return $this->where('nome_liga',$leagueName)->findAll();
    }

}