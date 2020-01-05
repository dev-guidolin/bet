<?php
namespace App\Models;
use CodeIgniter\Model;

class Apostas_model extends Model
{
    protected $table = 'apostas';
    protected $allowedFields = ['id_aposta'.'id_jogo','opcao','valor','id-gerente'];
    protected $primaryKey = 'id_aposta';


    public function getAllBets()
    {
        return $this->findAll();
    }

    public function getBetById($id = null)
    {
        return $this->find($id);
    }
    public function getBetByIdJogo($id = null)
    {
        return $this->where('id_jogo',$id)->findAll();
    }
    public function getBetByGerente($idGeremte = null)
    {
        return $this->where('id_gerente',$idGeremte);
    }

    public function getBetByCidade($idCidade = null)
    {
        return $this->where('id_cidade',$idCidade)->findAll();
    }

    public function getBetByEstado($idEstado = null)
    {
        return $this->where('id_estado',$idEstado)->findAll();
    }
    public function getAnaliseApostas($idJogo)
    {


        $db = \Config\Database::connect();
        $apostas = $this->asObject()->where('id_jogo',$idJogo)->findAll();
        $jogo = $db->table('jogos')->where('id_jogo',$idJogo)->get()->getRow();

         if (empty($apostas))
         {
             return [];
         }

        $cotasTimeCasa = $db->table('apostas')->where('id_jogo',$idJogo)->where('opcao',1)->selectSum('cotas')->get()->getRow()->cotas;
        $cotasTimeVisit = $db->table('apostas')->where('id_jogo',$idJogo)->where('opcao',2)->selectSum('cotas')->get()->getRow()->cotas;
        $cotasEmpate = $db->table('apostas')->where('id_jogo',$idJogo)->where('opcao',0)->selectSum('cotas')->get()->getRow()->cotas;

        /* Seta as cotas */
       $cotasCasa = $cotasTimeCasa ?? 0;
       $cotasDraw = $cotasEmpate ?? 0;
       $cotasVisitante = $cotasTimeVisit ?? 0;

       $resultado = [
           "casa" => $this->calc($cotasCasa,$jogo->acumulado),
           "empate" => $this->calc($cotasDraw,$jogo->acumulado),
           "visitante" => $this->calc($cotasVisitante,$jogo->acumulado),
       ];


           return $resultado;
    }
    private function calc($cotas, $acumulado)
    {
        $cotaMinima = 5;
        /* minimoLucro a cota mínima (R$ 5,00) mais 25%, 20% pra casa e 5% garantindo sempre lucro mínimo para o apostador */
        $minimoLucro = $cotaMinima + ($cotaMinima * 0.25);

        if (!$cotas || empty($cotas) || $cotas == 0){
            $cotas =  1;
        }

        $index = $acumulado / $cotas;

        if ($index < $minimoLucro  )
        {
            $comissao = 0;
        }else{
            $comissao = 0.2;
        }
        $valorPagarPorCotaComComissao = $acumulado - ($acumulado * $comissao) ;
        $resultado = [
            "Comissao" => $comissao,
            "Acumulado" => $acumulado,
            "Ac. com comissão" => $valorPagarPorCotaComComissao,
            "Cotas" => $cotas,
            "Pagar por cota" => $valorPagarPorCotaComComissao / $cotas,
        ];
        return $resultado;
    }

}