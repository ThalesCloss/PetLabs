<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\laboratorio;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
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
          if(Auth::user())
            return view('cadastro-laboratorio');
          else
            return redirect('/');
        }

        public function gravar(Requests\Laboratorio $request){
            $this->laboratorio->name=$request->get('name');
            $this->laboratorio->location=$request->get('location');
            $this->laboratorio->panoramicImage=$request->get('panoramicImage');
            $this->laboratorio->size=json_encode(['w'=>$request->get('w'),'h'=>$request->get('h')]);
            $this->laboratorio->save();
            return redirect()->route('laboratorios');
        }
        public function uploadPanoramicView(Request $request){
            //$validator=$this->validate($request,['file'=>'require|image'],['file.*'=>'Escolha uma imagem válida.']);

            $validator=Validator::make($request->all(),['file'=>'required|image'],['file.*'=>'Escolha uma imagem válida.']);
            if($validator->fails())
            {
              return response()->json(array('error'=>'Somente imagens são permitidas'),400);
            }
            $image = $request->file('file');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('img/' . $filename);
            $ho=(Image::make($image)->height());
            $wo=(Image::make($image)->width());
            $hn=400;
            $wn=($wo*$hn/$ho)*2;
            if(Image::make($image->getRealPath())->resize($wn, $hn)->save($path,85))
            //if($request->file('file')->move('img','img.teste' ))
            {
              return response()->json(array('path'=>'/img/'.$filename,'w'=>$wn,'h'=>$hn),200);
            }
            else {
              return response()->json(array('error'=>'Erro ao fazer o upload'),400);
            }
        }
}
