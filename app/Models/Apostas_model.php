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
             exit();
         }

        $idTimeCasa = $jogo->time_casa;
        $idTimeVisitante = $jogo->time_visitante;

        $cotaMinima = 5;
        $comissao = 0.2;


        $cotasTimeCasa = $db->table('apostas')->where('id_jogo',$idJogo)->where('opcao',1)->selectSum('cotas')->get()->getRow()->cotas;
        $cotasTimeVisit = $db->table('apostas')->where('id_jogo',$idJogo)->where('opcao',2)->selectSum('cotas')->get()->getRow()->cotas;
        $cotasEmpate = $db->table('apostas')->where('id_jogo',$idJogo)->where('opcao',0)->selectSum('cotas')->get()->getRow()->cotas;


        if (!$cotasTimeCasa || empty($cotasTimeCasa)){
            $valorCotaPagaCasa = 0;

        }else{
            $valorCotaPagaCasa = $jogo->acumulado / $cotasTimeCasa;
        }
        if (!$cotasTimeVisit || empty($cotasTimeVisit)){
            $valorCotaPagaVisit = 0;
        }else{
            $valorCotaPagaVisit = $jogo->acumulado / $cotasTimeVisit;
        }
        if (!$cotasEmpate || empty($cotasEmpate)){
            $valorCotaPagaEmpate = 0;
        }else{
            $valorCotaPagaEmpate = $jogo->acumulado / $cotasEmpate;
        }



        $acumluadoComissao = $jogo->acumulado - ($jogo->acumulado * 0.2);
        $acumuladoSemComissao = $jogo->acumulado;
        $result = [
            'Valor Acumulado'=> $acumuladoSemComissao,
            'Valor Acumulado Comissão'=> $acumluadoComissao,

            "Casa"=>["Cotas"=>$cotasTimeCasa ?? 0,"Valor Pagar por Cota / Comissão"=>$acumluadoComissao/$cotasTimeCasa,"Valor Pagar por Cota / Sem Comissao"=>$acumuladoSemComissao/$cotasTimeCasa,'Total Pago Sem Comissão'=> ($acumluadoComissao/$cotasTimeCasa) * $cotasTimeCasa ],

            "Empate"=>["Cotas"=>$cotasEmpate ?? 0,"Valor Pagar por Cota / Comissão"=> $acumluadoComissao/$cotasEmpate,"Valor Pagar por Cota / Sem Comissao"=>$acumuladoSemComissao/$cotasEmpate,'Total Pago Sem Comissão'=> ($valorCotaPagaCasa * $cotasEmpate),'Total Pago Com Comissão'=> ($acumluadoComissao/$cotasEmpate) * $cotasEmpate ],

            "Visitante"=>["Cotas"=>$cotasTimeVisit ?? 0,"Valor Pagar por Cota / Comissão"=>$acumluadoComissao/$cotasTimeVisit,"Valor Pagar por Cota / Sem Comissao"=>$acumuladoSemComissao/$cotasTimeVisit,'Total Pago Sem Comissão'=> ($valorCotaPagaCasa * $cotasTimeCasa),'Total Pago Com Comissão'=> ($acumluadoComissao/$cotasTimeVisit) * $cotasTimeCasa ],

        ];


        show_array($result);






        exit();

           return 0;
    }


}