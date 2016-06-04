<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\laboratorio;
use Illuminate\Support\Facades\Auth;

class laboratorioController extends Controller
{
    private $laboratorio;
    	function __construct(laboratorio $laboratorio){
    		$this->laboratorio=$laboratorio;
    	}

    	public function index(){
            return view('laboratorios',['labs'=>$this->laboratorio->all()]);
       	}

    	public function laboratorio($id){
    		$this->laboratorio=$this->laboratorio->find($id);
            return view('laboratorio',['lab'=>$this->laboratorio,'equipaments'=>$this->laboratorio->equipaments]);
    	}

        public function cadastro($id = null){
            return view('cadastro-laboratorio');
        }

        public function gravar(Requests\Laboratorio $request){
            $this->laboratorio->name=$request->get('name');
            $this->laboratorio->location=$request->get('location');
            $this->laboratorio->panoramicImage=$request->get('panoramicImage');
            $this->laboratorio->save();
        }
}
