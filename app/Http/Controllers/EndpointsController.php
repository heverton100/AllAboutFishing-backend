<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endpoint;

class EndpointsController extends Controller
{
    public function index()
    {
        return view('endpoints.main', [
            'endpoints' => Endpoint::all(),
        ]);
    }

    public function weather(Request $request)
    {
        $cidade = utf8_encode($request->vCity);
        $cidade2 = str_replace(' ','%20',str_replace('Ã£','%C3%A3',str_replace('Ã©','%C3%A9',str_replace('Ãº','%C3%BA',str_replace('Ã¡','%C3%A1',$cidade)))));

        $estado2 = $request->vState;

        function retiraAcentos($string){
           $acentos  =  'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
           $sem_acentos  =  'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
           $string = strtr($string, utf8_decode($acentos), $sem_acentos);
           return utf8_decode($string);
        }

        $estado = retiraAcentos(utf8_decode($estado2));

        switch ($estado) {
             case 'Acre' :          $estado = 'AC'; break; 
             case 'Alagoas' :       $estado = 'AL'; break; 
             case 'Amapa' :         $estado = 'AP'; break; 
             case 'Amazonas' :      $estado = 'AM'; break; 
             case 'Bahia' :         $estado = 'BA'; break; 
             case 'Ceara' :         $estado = 'CE'; break; 
             case 'Distrito Federal' :  $estado = 'DF'; break; 
             case 'Espirito Santo' :    $estado = 'ES'; break; 
             case 'Goias' :         $estado = 'GO'; break; 
             case 'Maranhao' :      $estado = 'MA'; break; 
             case 'Mato Grosso' :   $estado = 'MT'; break; 
             case 'Mato Grosso do Sul' : $estado = 'MS'; break; 
             case 'Minas Gerais' :  $estado = 'MG'; break; 
             case 'Para' :          $estado = 'PA'; break; 
             case 'Paraiba' :       $estado = 'PB'; break; 
             case 'Parana' :        $estado = 'PR'; break; 
             case 'Pernambuco' :    $estado = 'PE'; break; 
             case 'Piaui' :         $estado = 'PI'; break; 
             case 'Rio de Janeiro' :        $estado = 'RJ'; break; 
             case 'Rio Grande do Norte' :   $estado = 'RN'; break; 
             case 'Rio Grande do Sul' : $estado = 'RS'; break; 
             case 'Rondonia' :          $estado = 'RO'; break; 
             case 'Roraima' :           $estado = 'RR'; break; 
             case 'Santa Catarina' : $estado = 'SC'; break; 
             case 'Sao Paulo' :         $estado = 'SP'; break; 
             case 'Sergipe' :           $estado = 'SE'; break; 
             case 'Tocantins' :         $estado = 'TO'; break; 
        }

        if($request->vState =! 'null') {
            
            $url = 'http://apiadvisor.climatempo.com.br/api/v1/locale/city?name='.$cidade2.'&state='.$estado.'&token=f0ecd34ead81093ae53c7381ea97cf44';
            
        }else{
            
            $url = 'http://apiadvisor.climatempo.com.br/api/v1/locale/city?name='.$cidade2.'&token=f0ecd34ead81093ae53c7381ea97cf44';

        }

        $tempo = file_get_contents($url);

        $json = json_decode($tempo);

        foreach($json as $registro){
            
            $idlocal = $registro->id;

            $clima = file_get_contents('http://apiadvisor.climatempo.com.br/api/v1/weather/locale/'.$idlocal.'/current?token=f0ecd34ead81093ae53c7381ea97cf44');

            $data = json_decode($clima);

            return json_encode(array(
                'response'=>'success',
                'id'   => $data->id,
                'city'     => $data->name,
                'state' => $data->state,
                'temperature'   => $data->data->temperature,
                'humidity'     => $data->data->humidity,
                'condition' => $data->data->condition));

        }

    }
}
