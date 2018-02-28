<?php

namespace App\Http\Controllers\Relatorio;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Administrador;
use App\Indicador;
use App\Projeto;
use App\Fase;
use App\UserRole;
use App\Statusmodificado;
use App\Acompanhamento;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjetoController;
use \resources\views\relatorio\json\GeradorJson;
use App\Mail\MailRelatorio;
use Illuminate\Support\Facades\Mail;
use App\Relatorio;

class RelatorioComtroller extends Controller
{
    protected $user;
	protected $email;
	//constructor
	public function __construct( MailRelatorio $email)
	{
		$this->middleware('auth');
		$this->email = $email;
		$this->user = new User();
	}

	public function email(Request $request){	
		//$data = 'Meu nome eh luiz';			
		//$result = Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
		//{
		//	$message->subject('Mailgun and Laravel are awesome!');
		//	$message->from('no-reply@portifoliogestor.com', 'Portifolio Gestor');
		//	$message->to('luizsilvaifes@gmail.com');
		//	//$message->cc('dfb6b9fe68-78b989@inbox.mailtrap.io');
		//});

		//var_dump($result);
		//echo '<p style="color:red;">Relat�rio Controller</p>';
		//return view('relatorio.mail.relarorio',[ 'data' => $data,]);
		return redirect('/home');
	}

	public function json(Request $request){
		$GeradorJson = new GeradorJson();
		view('your-view')->with('leads', json_decode($leads, true));
	}

	/**
	*
    * Access  by user 'LEP and GP' to lists projects to access indicators.
	*
	* @param Request
	* @return view
	*/
	public function show(Request $request)
	{		
		#-------Verify if user is Project 'Gerente'----------GP----------------------------
		$isMembroAltaDir = $request->user()->isMembroAltaDir($request->user()->id);		
		if($isMembroAltaDir){ return $this->showProjetos($request);}
		#----------------------------------------------------------------------------------
		$indicadores = Indicador::all();
		$projetos = Projeto::all();
		$fases = Fase::all();
		
		return view('relatorio.projetos', ['projetos' => $projetos,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
	}
	public function showProjetos(Request $request){
		$indicadores = Indicador::all();
		$projetos = Projeto::select('projetos.*' )
		    ->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
			->where('fase_projeto.fase_id', '<>',8)
			->where('projetos.status_id', '<>',3)
			->where('projetos.status_id', '<>',6)
            ->distinct()->get();
		$fases = Fase::all();
		return view('relatorio.projetos', ['projetos' => $projetos,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
	}

	/**
    * Access  by user 'LEP or GP' to modify projects status.
	*
	* @param Request
	*/
	public function create(Request $request)
	{
		
		return redirect('/relatorio/show');
	}

	/**
	*
    * Access  by user 'LEP and GP' to lists projects.
	*
	* @param Request
	* @return view
	*/
	public function relatorioPorProjeto(Request $request) 
	{	
		$relatorio = new Relatorio ();
		$relatorioTXT = new MailRelatorio ($relatorio);
		$relatorioTXT->build();

		#--------------------------------------------------------------------------------------------------------------------
		#			correto n�o mexer	24/08/2017
		##-------------------------------------------------------------------------------------------------------------------

		//$indicadores = Indicador::select('indicador_id','nome')
           // ->join('fase_projeto', 'indicadors.id', '=', 'fase_projeto.indicador_id')
			//->union('fase_projeto', 'fase_projeto.projeto_id', '=', $request->projeto_id)
           // ->select('indicadors.*')
            //->get();

		$indicadores = Indicador::select('indicadors.*', 'fase_projeto.*' )
            ->join('fase_projeto', 'indicadors.id', '=', 'fase_projeto.indicador_id')->where('fase_projeto.projeto_id', '=', $request->projeto_id)
            ->get();

		$projeto =  Projeto::findOrFail($request->projeto_id); # Sem o ->get() s� recupera um. Se utilizar o  ->get() traz todos
		/*
		*O projeto foi aprovado pela alta dire��o. Os investimentos empregados no desenvolvimento tornam seu valor agregado relevante.
		*
		*
		*/
		$fases = Fase::all();
		$result = Statusmodificado::select('statusmodificados.*' )->where('projeto_id', '=', $request->projeto_id)->get();
		$justificativa = array ();
		if(!is_null($result) && count($result) > 0){			                         			  						 			
			foreach($result as $ff){
				foreach($result as $ff){
					if(!is_null( $ff->justificativa_analise_aprovada ) && $ff->projeto_id == $request->projeto_id){
						$justificativa = array ('value' => $ff->justificativa_analise_aprovada);
					}
					break;
				}
			}
		}else{
			$justificativa = array ('value' => 'Sem Justificativa');
		}

		return view('relatorio.analisar', ['projeto' => $projeto,'indicadores' => $indicadores, 'fases' => $fases, 'justificativa' => $justificativa, ]);
	}
	
	/**
	*
    * Access  by user 'LEP and GP' to lists projects.
	*
	* @param Request
	* @return view
	*/
	public function geral(Request $request)
	{	
		#--------------------------------------------------------------------------------------------------------------------
		#			correto n�o mexer	24/08/2017
		##-------------------------------------------------------------------------------------------------------------------
		
		/*
		*O projeto foi aprovado pela alta dire��o. Os investimentos empregados no desenvolvimento tornam seu valor agregado relevante.
		*/

		$indicadores = Indicador::all();

		$projetos = Projeto::select('projetos.*' )
		    ->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
			->where('fase_projeto.fase_id', '<>',8)
			->where('projetos.status_id', '<>',3)
			->where('projetos.status_id', '<>',6)
            ->distinct()->get();

		$fases = Fase::all();
		/*
		$indicadores = Indicador::select('indicadors.*', 'fase_projeto.*' )
            ->join('fase_projeto', 'indicadors.id', '=', 'fase_projeto.indicador_id')->where('fase_projeto.projeto_id', '=', $request->projeto_id)
            ->get();
		*/

		$indicadores = Indicador::select('indicadors.*', 'fase_projeto.*' )
            ->join('fase_projeto', 'indicadors.id', '=', 'fase_projeto.indicador_id')->where('fase_projeto.projeto_id', '=', $request->projeto_id)
            ->get();


		return view('relatorio.geral', ['projetos' => $projetos ,'indicadores' => $indicadores, 'fases' => $fases, ]);
	}
	public function validaDigito($digito)
	{	
		 $result = 1;
		 $valor = ctype_digit( $digito) ? true : false;
		 if( $valor == false || $valor == 0 ){ $result = 0;}
		 $valor =  is_numeric( $digito) ? true : false;
		 if( $valor == false || $valor == 0 ){ $result = 0;}
		 if( ((int) $digito) > PHP_INT_MAX || ((int) $digito) <= 0 ){ $result = 0;}
		 return $result;
	}
	/**
	*
    * Access  by user Administrador' to change attributes role to user.
	*
	* @param Request, User
	* @return boolean
	*/
	public function justificativaStore(Request $request)
	{
		# config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');

		//echo 'StatusmodificadoController justificarProjetoStore()<hr style="color:red;">' ;
		//echo ' user: '. $request->user;
		//echo ' [projeto_id: '. $request->projeto_id;
		//echo ' projeto: '. $request->projeto;
		//echo ' statusId: '. $request->statusId;
		//echo ' aprovada: '. $request->aprovada;
		//echo ' cancelada: '. $request->cancelada .']';
		//echo '<br><hr style="color:red;"><br>' ;

		$statusAprovado = 1;
		$statusCancelado = 3;
		$indicadores = Indicador::all();
		$projeto =  Projeto::findOrFail($request->projeto); # Sem o ->get() s� recupera um. Se utilizar o  ->get() traz todos
		$fases = Fase::all();

		$request->session()->flash('message_error_justificar', 'Nao implementado!'); 
		$request->session()->flash('alert-class', 'alert-danger'); 
		return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);

		# not necessary verify if numbres is string, by this this numbers is string and is necessary convert to int numbers

		if ( ((int) $request->statusId) == $statusAprovado && is_null($request->aprovada) ){
			$request->session()->flash('message_error_justificar', 'A justificativa para o status ANALISE APROVADA deve ser informada!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		if ( ((int) $request->statusId) == $statusCancelado && is_null($request->cancelada) ){
			$request->session()->flash('message_error_justificar', 'A justificativa para o status CANCELADO deve ser informada!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}

		
		/*$resultadoValor = Statusmodificado::select('statusmodificados.*' )->where('statusmodificados.id', '=', $request->valor);

		if ( !$resultadoValor->exists() ){
			$request->session()->flash('message_error_justificar', 'Indicador sem valores informados: inexiste!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		if ( is_null( $request->Acompanhamento) ){
			$request->session()->flash('message_error_justificar', 'Texto do Acompanhamento invalido: Utilize um texto valido!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		if ( strlen( $request->Acompanhamento) > 255 ){
			$request->session()->flash('message_error_justificar', 'Texto do Acompanhamento invalido: Tamanho acima do permitido!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		if ( strlen( $request->Acompanhamento) < 15 ){
			$request->session()->flash('message_error_justificar', 'Texto do Acompanhamento invalido: Tamanho inferior ao esperado 15 - quinze - caracteres!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		if ( is_null($request->user) ){
			$request->session()->flash('message_error_justificar', 'Usuario nao informado!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		*/
		if( $this->validaDigito($request->statusId) == 0 || $this->validaDigito($request->projeto) == 0  ||
			$this->validaDigito($request->user) == 0  ){
			$request->session()->flash('message_error_justificar', 
					'Dados invalidos: Sem possibilidade de cadastrar o acompanhamento!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}

		///*return response()
        //->view('indicadores/show', $request, 200)
        //->header('Content-Type', 'html');
		//*/
		//$messages = array(
		//	'required' => 'O campo :attribute � obrigat�rio!',
		//	'numeric' => 'O campo :attribute deve ser um n�mero v�lido!',
		//);
		//try{
		//($input, $rules, $messages);
		//$this->validate($request, [
			//'projeto_id' => 'required|numeric|max:10',
			//'indicadorProjeto' => 'required|numeric|max:10',
			//'valorminimo' => 'required|numeric|max:3',
			//'valormaximo' => 'required|numeric|max:3',
		//],
        // $messages
		//);
		//}catch(MethodNotAllowedHttpException $e){
		 //return $e->message();
		//}

		$user = User::find($request->user);
		
		$statusModificado = new Statusmodificado();		
		#------------------------------------------------------------------------
		# Verifica se � do tipo AN�LISE APROVADA ou CANCELADO
		if ( ( (int) $request->statusId ) == $statusCancelado || ( (int) $request->statusId) == $statusAprovado ){
			#--------------------------------------------------------------------
			# Verifica se EXISTE o projeto com o status foi modificado desse tipo
			if( $statusModificado->where('statusmodificados.projeto_id', $request->projeto_id)->exists() ){					
				#--------------------------------------------------------------------
				# Verifica se �  do tipo AN�LISE APROVADA
				if (  ( (int) $request->statusId) == $statusAprovado ){
					var_dump('---------------------------------277---------------------------');
					#----------------------------------------------------------------
					# Deve ser atualizado o status modificado do projeto								
					$result = Statusmodificado::where('projeto_id', $request->projeto_id)->update(['user_id' => $request->user()->id,'status_id' => $request->statusId ,'justificativa_analise_aprovada' =>$request->aprovada,'updated_at' => date('Y-m-d H:i:s')  ]);
				}
				#--------------------------------------------------------------------
				# Verifica se �  do tipo CANCELADO
				if ( ( (int) $request->statusId ) == $statusCancelado  ){
					var_dump('---------------------------------285---------------------------');
					#----------------------------------------------------------------
					# Deve ser atualizado o status modificado do projeto								
					$result = Statusmodificado::where('projeto_id', $request->projeto_id)->update(['user_id' => $request->user()->id,'status_id' => $request->statusId ,'justificativa_cancelado' => $request->cancelada,'updated_at' => date('Y-m-d H:i:s') ]);
					var_dump('$result>');
					var_dump($result);
					var_dump('<$result');
				}
				if($result){
					#----------------------------------------------------------------
					# Verifica se quem est� atualizando FOI QUEM CRIOU O PROJETO e atualiza
					if($projeto->user_id == $request->user()->id ){
						var_dump('---------------------------------297---------------------------');
						$request->user()->projetos()->where('id', $request->projeto_id)->update(['status_id' => $request->statusId,'updated_at' => date('Y-m-d H:i:s') ]); 
					#----------------------------------------------------------------
					# Verifica se quem est� atualizando N�O FOI QUEM CRIOU O PROJETO e atualiza
					}else{		
						var_dump('----------------------------------302---------------------------');		
						$result = Projeto::where('id', $request->projeto_id)->update(['status_id' => $request->statusId,]);								
					}
					$request->session()->flash('message_succes_justificar',  'Status do projeto foi atualizado com sucesso!'); 
					$request->session()->flash('alert-class', 'alert-success'); 
				}else{
						$request->session()->flash('message_error_justificar', 'Falhou a tentativa de atualizar!'); 
						$request->session()->flash('alert-class', 'alert-danger'); 
				}
				
			#------------------------------------------------------------------------
			# Em caso de N�O EXISTE o projeto com o status foi modificado desse tipo
			#------------------------------------------------------------------------
			}else{			
					var_dump('---------------------------------316---------------------------');
					$statusmodificado = new Statusmodificado();
					$statusmodificado	->user_id = $request->user()->id;						
					$statusmodificado	->projeto_id = $request->projeto_id;	
					$statusmodificado	->status_id = $request->statusId;	
					$statusmodificado	->justificativa_analise_aprovada = null;	
					$statusmodificado	->justificativa_cancelado = null;	
					//$statusmodificado	->created_at; 															 
					//$statusmodificado	->updated_at = date(Y-m-d H:i:s)
					$result = $statusmodificado->save();	

					//var_dump('$result>');
					//var_dump($result);
					//var_dump('<$result');
					/****---------------------------------------------------------------------------
					$request->user()->statusProjeto()->create(['user_id' => $request->user()->id ,'projeto_id' => $request->projeto_id ,	'status_id' => $request->statusId ,	'justificativa_analise_aprovada' => null ,	'justificativa_cancelado' => null ,	//'created_at', //'updated_at' => date('Y-m-d H:i:s')
					]); 	
					-----------------------------------------------------------------------------*/	
					if($result){
						#----------------------------------------------------------------
						# Verifica se quem est� atualizando FOI QUEM CRIOU O PROJETO e atualiza
						if($projeto->user_id == $request->user()->id ){
							var_dump('-------------------------------327---------------------------');
							$request->user()->projetos()->where('id', $request->projeto_id)->update(['status_id' => $request->statusId,'updated_at' => date('Y-m-d H:i:s') ]); 
						#----------------------------------------------------------------
						# Verifica se quem est� atualizando N�O FOI QUEM CRIOU O PROJETO e atualiza
						}else{		
							var_dump('-------------------------------343--------------------------');		
							$result = Projeto::where('id', $request->projeto_id)->update(['status_id' => $request->statusId,]);								
						}									 
						$request->session()->flash('message_succes_justificar', 'Status do projeto foi inserido com sucesso!'); 
						$request->session()->flash('alert-class', 'alert-success');						
					}else{
						$request->session()->flash('message_error_justificar', 'Falhou a tentativa de atualizar!'); 
						$request->session()->flash('alert-class', 'alert-danger'); 
					}	
								
			}
		#------------------------------------------------------------------------
		# Verifica se N�O � do tipo AN�LISE APROVADA ou CANCELADO
		}else{
			#--------------------------------------------------------------------
			# Verifica se EXISTE O PROJETO com o status foi MODIFICADO desse tipo
			if( $statusModificado->where('statusmodificados.projeto_id', $request->projeto_id)->exists() ){	
					#----------------------------------------------------------------
					# Deve ATUALIZAR O STATUS modificado do projeto								
					$result = Statusmodificado::where('projeto_id', $request->projeto_id)->update(['user_id' => $request->user()->id,'status_id' => $request->statusId ,'updated_at' => date('Y-m-d H:i:s')  ]); 					
					//var_dump('$result>');
					//var_dump($result);
					//var_dump('<$result');
					if($result){						
						#----------------------------------------------------------------
						# Verifica se quem est� atualizando FOI QUEM CRIOU O PROJETO e atualiza
						if($projeto->user_id == $request->user()->id ){
							var_dump('-----------------------370-----------------------------');
							$request->user()->projetos()->where('id', $request->projeto_id)->update(['status_id' => $request->statusId,'updated_at' => date('Y-m-d H:i:s') ]); 
						#----------------------------------------------------------------
						# Verifica se quem est� atualizando N�O FOI QUEM CRIOU O PROJETO e atualiza
						}else{				
							$result = Projeto::where('id', $request->projeto_id)->update(['status_id' => $request->statusId,]);
							var_dump('-----------------------376-----------------------------');
						}
						$request->session()->flash('message_succes_justificar',  'Status do projeto foi atualizado com sucesso!'); 
						$request->session()->flash('alert-class', 'alert-success'); 
					}else{
						$request->session()->flash('message_error_justificar', 'Falhou a tentativa de atualizar!'); 
						$request->session()->flash('alert-class', 'alert-danger'); 
					}
					
			#-------------------------------------------------------------------
			# Em caso de N�O EXISTE o projeto com o status foi modificado desse tipo
			}else{    var_dump($request->user()->id);	var_dump('-----------------------418-----------------------------');
				#----------------------------------------------------------------
					# Deve ser CRIADO o status modificado do projeto						
					//$result = Statusmodificado::where('projeto_id', $request->projeto_id)->create(['user_id' => $request->user()->id, 'projeto_id' => $request->projeto_id, 'status_id' => $request->statusId ,'updated_at' => date('Y-m-d H:i:s')  ]); 
					$statusmodificado = new Statusmodificado();
					$statusmodificado	->user_id = $request->user()->id;						
					$statusmodificado	->projeto_id = $request->projeto_id;	
					$statusmodificado	->status_id = $request->statusId;	
					$statusmodificado	->justificativa_analise_aprovada = null;	
					$statusmodificado	->justificativa_cancelado = null;	
					//$statusmodificado	->created_at; 															 
					//$statusmodificado	->updated_at = date(Y-m-d H:i:s)
					$result = $statusmodificado->save();	
					if($result){
						#----------------------------------------------------------------
						# Verifica se quem est� atualizando FOI QUEM CRIOU O PROJETO e atualiza
						if($projeto->user_id == $request->user()->id ){
							var_dump('-----------------------398-----------------------------');
							$request->user()->projetos()->where('id', $request->projeto_id)->update(['status_id' => $request->statusId,'updated_at' => date('Y-m-d H:i:s') ]); 
						#----------------------------------------------------------------
						# Verifica se quem est� atualizando N�O FOI QUEM CRIOU O PROJETO e atualiza
						}else{		
							var_dump('-----------------------------403----------------------------');		
							$result = Projeto::where('id', $request->projeto_id)->update(['status_id' => $request->statusId,]);
						
						}
						$request->session()->flash('message_succes_justificar',  'Status do projeto foi inserido com sucesso!'); 
						$request->session()->flash('alert-class', 'alert-success');
					}else{
						$request->session()->flash('message_error_justificar', 'Falhou a tentativa de atualizar!'); 
						$request->session()->flash('alert-class', 'alert-danger'); 
					} 			
			}	
		}
		$justificativa [] = $request->aprovada;
		return view('relatorio.justificar', ['projeto' => $projeto,  'indicadores' => $indicadores,  'fases' => $fases, 'justificativa' => $justificativa,]);
	}

	/**
	*
    * Access  by user 'LEP' to lists projects by name.
	*
	* @param User, Indicador
	* @return boolean
	*/
	public function buscarPorNome(Request $request)
	{		
		//echo '======nomeProjetoBusca=======('. $request->buscarProjeto .')/............</br>';
		
		$projetos[] = array();
		$indicadores [] = array();
		$indicadores = Indicador::all();
		$fases = Fase::all();
		try{
			
			$projetos = Projeto::select('projetos.*' )
						->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
						->where('fase_projeto.fase_id', '<>',8)
						->where('projetos.status_id', '<>',3)
						->where('projetos.status_id', '<>',6)
						->where('nome', 'like', '%' . $request->buscarProjeto . '%')
						->orderBy('nome')
						->distinct()
						->get();

	    }catch(Exception $e){
			throw new Exception ('N�o foi poss�vel recuperar os dados!');
			return  $e;
		} 
		return view('relatorio.projetos', ['projetos' => $projetos,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
	}

	/**
	*
    * Access  by user 'LEP' to lists projects sort.
	*
	* @param Request, Indicador
	* @return boolean
	*/
	public function buscarOrdenar(Request $request)
	{
		//echo '======buscarOrdenarPor=======('. $request->ordenarProjeto .')/............</br>';
		$ordenarPor = $request->ordenarProjeto;
		$projetos[] = array();
		$indicadores [] = array();
		$indicadores = Indicador::all();
		$fases = Fase::all();;
	
		try{
			if($ordenarPor === 'NOMEDOPROJETO'){
				$ordenarPor = 'nome';
				//$projetos =  Projeto::where('nome','<>',null)->orderBy($ordenarPor, 'asc')->get();
				$projetos = Projeto::select('projetos.*' )
						->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
						->where('fase_projeto.fase_id', '<>',8)
						->where('projetos.status_id', '<>',3)
						->where('projetos.status_id', '<>',6)
						->where('nome','<>',null)
						->orderBy('nome')
						->distinct()
						->get();									
			}
			if($ordenarPor == 'NOMEDOGERENTE'){
				$ordenarPor = 'gerente_responsavel';
				$projetos = Projeto::select('projetos.*' )
						->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
						->where('fase_projeto.fase_id', '<>',8)
						->where('projetos.status_id', '<>',3)
						->where('projetos.status_id', '<>',6)
						->where('gerente_responsavel','<>',null)
						->orderBy($ordenarPor, 'asc')
						->distinct()->get();									
			}
			if($ordenarPor == 'DATAINICIAL'){
				$ordenarPor = 'data_de_inicio';
				$projetos = Projeto::select('projetos.*' )
						->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
						->where('fase_projeto.fase_id', '<>',8)
						->where('projetos.status_id', '<>',3)
						->where('projetos.status_id', '<>',6)
						->orderBy($ordenarPor, 'asc')
						->distinct()->get();									
			}
			if($ordenarPor == 'DATAFINAL'){
				$ordenarPor = 'previsao_de_termino';
				$projetos = Projeto::select('projetos.*' )
						->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
						->where('fase_projeto.fase_id', '<>',8)
						->where('projetos.status_id', '<>',3)
						->where('projetos.status_id', '<>',6)
						->orderBy($ordenarPor, 'asc')
						->distinct()->get();					
			}
			if($ordenarPor == 'STATUS'){
				$ordenarPor = 'status_id';
				$projetos = Projeto::select('projetos.*' )
						->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
						->where('fase_projeto.fase_id', '<>',8)
						->where('projetos.status_id', '<>',3)
						->where('projetos.status_id', '<>',6)
						->where('status_id','<>',null)
						->orderBy($ordenarPor, 'asc')
						->distinct()->get();		
			}
	    }catch(Exception $e){
			throw new Exception ('N�o foi poss�vel recuperar os dados!');
			return  $e;
		} 
		return view('relatorio.projetos', ['projetos' => $projetos,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
	}
}#end class