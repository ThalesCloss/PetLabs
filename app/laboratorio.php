<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class laboratorio extends Model
{
	protected $fillable = array( 'name','location','panoramicImage');
    	public $timestamps = false;

    	public function equipaments(){
    		return $this->hasMany(equipamentoLaboratorio::class);
    	}

}
