<?php
namespace App\Models;
use CodeIgniter\Model;

class Matches_model extends Model
{
    protected $table = 'jogos';
    protected $allowedFields = ['id_jogo','time_casa','time_visitante','acumulado','id_liga'];
    protected $primaryKey = 'id_jogo';


    public function getAllMatches()
    {
        return $this->findAll();
    }
    public function getMatchById($id = null)
    {
        return $this->find($id);
    }
    public function getMatchesByLiga($idLiga = null)
    {
        return $this->where('id_liga',$idLiga)->findAll();
    }
    public function getMatchesByTimeCasa($idTimeCasa = null)
    {
        return $this->where('time_casa',$idTimeCasa)->findAll();
    }
    public function getMatchesByTimeVistante($idTimeVisitante = null)
    {
        return $this->where('time_casa',$idTimeVisitante)->findAll();
    }



}