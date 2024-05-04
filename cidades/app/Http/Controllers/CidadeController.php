<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cidade;
use Illuminate\View\View;

class CidadeController extends Controller
{
    //
    private $max_rows = 20;
    public function index(){
        $cidades = Cidade::paginate($this->max_rows);
        return view('main',['cidades'=>$cidades]);

    }

    // /cidades/{type}/{val}/search
    //http://localhost/cidades/public/index.php/cidades/0/Apucarana/search
    public function search($type,$val){
        if($type == "0"){
            $cidades = Cidade::where('nome',$val)->paginate($this->max_rows);
        } elseif ($type == "1"){
            $cidades = Cidade::where('nome','LIKE',$val . '%')->paginate($this->max_rows);
        } elseif ($type == "2"){
            $cidades = Cidade::where('nome','LIKE','%'.$val.'%')->paginate($this->max_rows);
        } else {
            $cidades = Cidade::where('nome',$val)->paginate($this->max_rows);
        }
        return view('main',['cidades'=>$cidades]);
    }

    public function add_city(Request $request) {
        // Criar uma nova instância de Cidade
        // $cidade = new Cidade;
        // $cidade->sigla_estado = $request->input('city_state'); 
        // $cidade->nome = $request->input('city_name');            
        // $cidade->codigo = $request->input('city_code');              
        // $cidade->save();
    
        // // Recarrega a lista de cidades paginadas após a adição
        $cidades = Cidade::paginate($this->max_rows);
        return view('main', ['cidades' => $cidades]);
    }

    public function remove_city(Request $request) {
        // Localiza a primeira cidade que corresponde ao nome e a exclui
        // $cidade = Cidade::where('nome', $request->city_name)->first();
        // if ($cidade) {
        //     $cidade->delete();
        // }
    
        // // Recarrega a lista de cidades paginadas após a remoção
        $cidades = Cidade::paginate($this->max_rows);
        return view('main', ['cidades' => $cidades]);
    }
}