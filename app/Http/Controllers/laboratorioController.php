<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\laboratorio;

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
}
