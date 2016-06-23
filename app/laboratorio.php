<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class laboratorio extends Model
{
			protected $fillable = array( 'name','location','panoramicImage','size');
    	public $timestamps = false;
			protected $a_size;


			public function equipaments(){
    		return $this->hasMany(equipamentoLaboratorio::class);
    	}

			public function getSize(){
				isset($a_size)?null:$a_size=json_decode($this->size);
				return $a_size;
			}
			public function getSizeW(){
				return isset($this->size)?json_decode($this->size)->w:0;
			}
			public function getSizeH(){
				return isset($this->size)?json_decode($this->size)->h:0;
			}

}
