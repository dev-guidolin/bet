<?php
namespace App\Models;
use CodeIgniter\Model;

class Consultas_model extends Model
{

    public function teste($data)
    {
        $city = new Localidades_model();
        return $city->getCitieById($data);
    }

    public function getLigasByCountrieSlug(string $slug = null)
    {
        $countrie = new Paises_model();
        $ligas = new Ligas_model();
        $pais = $countrie->getCountrieBySlug($slug);
        $ligas =  $ligas->getLeaguesByCountriId($pais['id_pais']);


        foreach ($ligas as $liga)
        {
            $result = [
                'id_liga' => $liga['id_liga'],
                'nome_liga' => $liga['nome_liga'],
                'id_pais' => $liga['id_pais'],
                'nome_pais' => $pais['nome_pais'],
                'slug_pais' => $pais['slug'],
                'slug_liga' => $liga['slug'],
                'flag' => $pais['flag'],
            ];
            $resultado[] = $result;
        }
        return $resultado;
    }

    public function getMatchesByLigaSlug($slug)
    {
        $jogos = new Matches_model();
        $ligas = new Ligas_model();
        $times = new Times_model();
        $apostas = new Apostas_model();

        $liga = $ligas->getLeagueBySlug($slug);
        $matches = $jogos->getMatchesByLiga($liga['id_liga']);



        /*
         * Se não existir apostas, retorna array vazio
         */



        foreach ($matches as $key => $item)
        {
            $casa = $times->getTimeById($item['time_casa']);
            $visitante= $times->getTimeById($item['time_visitante']);

            $matches[$key]['time_casa_nome'] = $casa['nome_time'];
            $matches[$key]['time_visitante_nome'] = $visitante['nome_time'];
            $matches[$key]['nome_liga'] = $liga['nome_liga'];

            $bets = $apostas->getAnaliseApostas($matches[$key]['id_jogo']);


            $matches[$key]['analise'] = $liga['nome_liga'];
            $matches[$key]['apostas'] = $bets;

        }



        return $matches;

    }

}