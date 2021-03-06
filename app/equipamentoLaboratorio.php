<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class equipamentoLaboratorio extends Model
{
	protected $table='equipamentos_laboratorios';
	protected $fillable = array( 'laboratorio_id','name','description','coords');
	public $timestamps = false;

	public function laboratorio(){
		return $this->belongsTo('App\laboratorio');
	}
	public function getCoords(){
		return json_decode($this->coords);
	}
    //
}
