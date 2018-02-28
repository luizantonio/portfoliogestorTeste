<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
     // Fields then update by web requests, using label fillable
	protected $fillable = ['user_id', 'nome',];
	
	
	/**-------------------------------------------------------------
    * Indicar que um indicador pertence a um usu�rio
	* The users that belong to the indicator.
    */
	public function user()
	{
		return $this->belongsTo(User::class);	#[ok]	--ok-- N�o Modificar
	}

	/*
	* Indicar que um indicador pertence a um projeto
	*
	*/
	public function projeto()
	{
		return $this->belongsToMany(Projeto::class, 'fase_projeto');
	}
	/*
	* Indicar que um indicador pertence a um fase
	*
	*/
	public function fase()
	{
		return $this->belongsToMany(Fase::class);
	}

	/**
	* Get the name of the Project Fase 
	* @return string
	*/
	public function nomeFase($id)
	{	
		$id = (int) $id;
		$fases = Fase::all();
		foreach($fases as $f){
			if($f->id == $id){
				return $f->nome;		
			}		
		}
		return 'N�o Definido';
	}
	/**
    * The funcion that get all velues of the one Indicator by your ID 
	*
    * @return array
    */
	public function valoresEsperados($faseid)
	{
		$valoresEsperados = Indicador::select('indicadors.*', 'fase_projeto.*' )
            ->join('fase_projeto', 'indicadors.id', '=', 'fase_projeto.indicador_id')->where('fase_projeto.id', '=', $faseid)
            ->get();
		$resultAuxiliar = array();

		var_dump($valoresEsperados);

		//return ($valoresEsperados != null && count($valoresEsperados) > 0) ? $valoresEsperados : $resultAuxiliar;
	}
	/**
    * The funcion that get all velues of the one Indicator by your ID 
    * change Gerente
	*
    * @return array
    */
	public function valoresInformados($indicadorid, $projetoid)
	{
		$valoresInformados = Valor::select('valors.*' )
            ->join('fase_projeto', 'valors.fase_projeto_id', '=', 'fase_projeto.id')
			->where('fase_projeto.indicador_id', '=', $indicadorid )
			->orwhere('fase_projeto.projeto_id', '=', $projetoid )
            ->get('valors.*', 'fase_projeto.id as valorfase_id');
		$resultAuxiliar = array();
		
		//var_dump($valoresInformados);
		/*foreach($valoresInformados as $valoresInf){
			     echo '<output style="background-color:lightgray;">';	
				 echo utf8_encode('Valor M�nimo'). $valoresInf->valor_minimo; echo utf8_encode('Valor M�ximo'). $valoresInf->valor_maximo ;
				 echo '</output> ';
		//}
		*/
		return ($valoresInformados != null && count($valoresInformados) > 0) ? $valoresInformados : $resultAuxiliar;
	}
}
