<?php


namespace App\Models;
use CodeIgniter\Model;


class Paises extends Model
{
    protected $table = "paises";
    protected $primaryKey = "id";
    protected $allowedFields = ['id','name','image_path','flag'];

    public function setPaises($data)
    {

        foreach ($data as $c)
        {
            $countries = [
                'id'            => $c['id'],
                'name'          => $c['name'],
                'image_path'    => $c['image_path'],
                'flag'          => $c['extra']['flag']
            ];

            $this->insert($countries);

        }

        return "Deu tudo certo";



    }


}