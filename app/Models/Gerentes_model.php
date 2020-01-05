<?php
namespace App\Models;
use CodeIgniter\Model;

class Gerentes_model extends Model
{
    protected $table = 'gerentes';

    protected $allowedFields = ['id_gerente'.'nome_gerente','cidade_id','uf_id'];
    protected $primaryKey = 'id_gerente';


    public function getAllGErentes()
    {
        return $this->findAll();
    }

    public function getGerenteById($id = null)
    {
        return $this->find($id);
    }
    public function getGerenteByCidadeId($cidadeId = null)
    {
        return $this->where('id_gerente',$cidadeId);
    }

    public function getGerenteByEstadoId( $estadoIde = null)
    {
        return $this->where('uf_id',$estadoIde)->findAll();
    }
    public function getGerenteByWhatsapp( $whatsApp = null)
    {
        return $this->where('whatsapp',$whatsApp)->first();
    }

}