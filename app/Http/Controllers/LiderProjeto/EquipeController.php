<?php

namespace App\Http\Controllers\LiderProjeto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Equipe;
use App\Projeto;
use App\Fase;
use App\Membro;
use App\Http\Controllers\Controller;
use App\Repositorios\EquipeRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\DB;



class EquipeController extends Controller
{
    protected $equipeRepository;
	protected $user;
	protected $users;
	protected $EQUIPE_ERRO_MEMBRO_EXISTE = 'Membro ja existe na equipe!';
	protected $EQUIPE_ERRO_MEMBRO_NOME_INVALIDO = 'Campo nome do Membro invalido!';
	protected $EQUIPE_ERRO_MEMBRO_NOME_CARACTER = 'Campo Nome do Membro devem possuir apenas caracteres do alfabeto!';
	protected $EQUIPE_ERRO_MEMBRO_NOME_JA_EXISTE = 'Membro com este nome ja existe!';
	protected $EQUIPE_ERRO_MEMBRO_NAO_CADASTROU = 'N�o foi possivel cadastrar!';
	protected $EQUIPE_ERRO_MEMBRO_INDISPONIVEL = 'Este membro esta indisponivel!';
	protected $EQUIPE_ERRO_MEMBRO_INDICADOR_SEM_VALORES = 'Indicador sem valores informados: inexiste!';
	protected $EQUIPE_ERRO_MEMBRO_POSSUI = 'Membro nao pode ser removido, pois Possui Equipe!';
	protected $EQUIPE_ERRO_MEMBRO_NAO_ATUALIZOU = 'N�o foi poss�vel atualizar o nome membro!';
	protected $EQUIPE_ERRO_MEMBRO_NAO_REMOVEU = 'N�o foi poss�vel remover membro!';


	protected $EQUIPE_SUCESSO_MEMBRO_ATUALIZAR = 'Membro atualizado com sucesso!';
	protected $EQUIPE_SUCESSO_MEMBRO_CADASTRO = 'Cadastro realizado com sucesso!';
	protected $EQUIPE_SUCESSO_MEMBRO_REMOVER = 'Membro removido do Sistema com sucesso!';
	protected $EQUIPE_SUCESSO_MEMBRO_REMOVER_EQUIP ='Membro removido da EQUIPE com sucesso!';

    //constructor
	public function __construct(EquipeRepository $equipeRepository)
	{
		$this->middleware('auth.lp');
		$this->equipeRepository = $equipeRepository;
		$this->user = new User();
		$this->users = array();
	}
	/**
	*
    * Access  by user 'Administrador' .
	*
	* @param Request
	* @return view
	*/
	public function home(Request $request)
	{
		return view('equipes.home');
	}
	/**
	*
    * Access  by user 'Administrador' to create a new user form.
	*
	* @param Request
	* @return view
	*/
	public function index(Request $request)
	{
		// vem de ProjetoRepository
	    $users = $this->administradorRepository->allUser();

		return view('equipes.index', [
			'users' => $users,
		]);
	}
	
	public function cadastro(Request $request)
	{		
		return view('equipes.create');
	}
	
	
	/**
    * Access  by user Administrador' to create new users.
	*
	* @param User, Projeto
	* @return boolean
	*/
	public function create(Request $request)
	{
		//var_dump( $request->user()->id);		
		//var_dump( $request->nome);
	
		if( $request->nome === null || $request->nome === ''){
			$request->session()->flash('message_error_equipe',  $this->EQUIPE_ERRO_MEMBRO_NOME_INVALIDO); 
			$request->session()->flash('alert-class', 'alert-danger');				
			return $this->associarMembroEquipeAoProjeto($request);
		}
		elseif(!is_null($request->nome) && strlen(trim($request->nome)) < 6   ){
			$request->session()->flash('message_error_equipe',  $this->EQUIPE_ERRO_MEMBRO_NOME_INVALIDO); 
			$request->session()->flash('alert-class', 'alert-danger');				
			return $this->associarMembroEquipeAoProjeto($request);
		}elseif(preg_match('/[\'^�$%&*()}{@#~?><>,|=_+�-]/', $request->nome)){
			$request->session()->flash('message_error_equipe',  $this->EQUIPE_ERRO_MEMBRO_NOME_INVALIDO); 
			$request->session()->flash('alert-class', 'alert-danger');				
			return $this->associarMembroEquipeAoProjeto($request);
		}
		elseif(is_numeric($request->nome) ){			
			$request->session()->flash('message_error_equipe', $this->EQUIPE_ERRO_MEMBRO_NOME_CARACTER);
			$request->session()->flash('alert-class', 'alert-danger');				
			return $this->associarMembroEquipeAoProjeto($request);
		}elseif(!is_null($request->nome) && strlen(trim($request->nome)) <= 0   ){
			$request->session()->flash('message_error_equipe',  $this->EQUIPE_ERRO_MEMBRO_NOME_INVALIDO); 
			$request->session()->flash('alert-class', 'alert-danger');				
			return $this->associarMembroEquipeAoProjeto($request);
		}
		# vetor de mensagens de erros personalizadas
		$messages = array(
			'required' => 'O campo :attribute � obrigat�rio!',
		);
		# O metodo validate ($input, $rules, $messages) recebe tr�s parametros;
		$this->validate($request, [
			'nome' => 'required|string|max:255',
		],
        $messages
		);
		# config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');

		if (Membro::where('nome', '=', $request->nome)->exists()) {
		   $request->session()->flash('message_error_equipe', $this->EQUIPE_ERRO_MEMBRO_NOME_JA_EXISTE); 
		   $request->session()->flash('alert-class', 'alert-danger'); 		  
		   return $this->associarMembroEquipeAoProjeto($request);
		}

		# S� funcionou dessa forma para cadastrar membros

		$membro = new Membro();
		$membro	->user_id = $request->user()->id;
		$membro	->nome = $request->nome;
		$membro	->created_at = date('Y-m-d H:i:s');
		$membro	->updated_at = date('Y-m-d H:i:s');
		$membro->save();

		if($membro == null)		{
			$request->session()->flash('message_error_equipe', $this->EQUIPE_ERRO_MEMBRO_NAO_CADASTROU); 
		    $request->session()->flash('alert-class', 'alert-danger'); 			
		}else{			
			$request->session()->flash('message_success_equipe', $this->EQUIPE_SUCESSO_MEMBRO_CADASTRO); 
		    $request->session()->flash('alert-class', 'alert-success'); 
			$projeto = Projeto::find($request->projeto_id);
			
			$projeto->membros()->attach($membro->id, ['user_id' => $request->user()->id,
															'projeto_id' => $request->projeto_id,
		                                                    'membro_id'  => $membro->id,
															'created_at' => date('Y-m-d H:i:s'),
															'updated_at' => date('Y-m-d H:i:s'),]);
		}
		return $this->associarMembroEquipeAoProjeto($request);		
		
	}
	/**
    * Access  by user Administrador' to create new users.
	*
	* @param User, Projeto
	* @return boolean
	*/
	public function createByIdMembro(Request $request)
	{
		//var_dump( $request->user()->id);
		//var_dump( $request->membro_id);

		if( $request->membro_id === null || $request->membro_id === ''){
				$request->session()->flash('message_error_equipe',  $this->EQUIPE_ERRO_MEMBRO_NOME_INVALIDO); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->associarMembroEquipeAoProjeto($request);
		}
		elseif(is_numeric($request->membro_id) ){
			if( (int) $request->membro_id < 0){
				$request->session()->flash('message_error_equipe',  $this->EQUIPE_ERRO_MEMBRO_NOME_INVALIDO); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->associarMembroEquipeAoProjeto($request);
			}						
		}
		# vetor de mensagens de erros personalizadas
		$messages = array(
			'required' => 'O campo :attribute � obrigat�rio!',
		);
		# O metodo validate ($input, $rules, $messages) recebe tr�s parametros;
		$this->validate($request, [
			'membro_id' => 'required|numeric',
		],
        $messages
		);
		
		if (!Membro::where('id', '=', $request->membro_id)->exists()) {
		   $request->session()->flash('message_error_equipe', $this->EQUIPE_ERRO_MEMBRO_INDISPONIVEL); 
		   $request->session()->flash('alert-class', 'alert-danger'); 		  
		   return $this->associarMembroEquipeAoProjeto($request);
		}

		$projeto = Projeto::find($request->projeto_id);

	    if($projeto->membros()->where('membro_id', '=', $request->membro_id)->exists()) {
			$request->session()->flash('message_error_equipe',  $this->EQUIPE_ERRO_MEMBRO_EXISTE); 
		    $request->session()->flash('alert-class', 'alert-danger'); 		  
		    return $this->associarMembroEquipeAoProjeto($request);
		}

		# config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');

		$projeto->membros()->attach($request->membro_id, ['user_id' => $request->user()->id,
															'projeto_id' => $request->projeto_id,
		                                                    'membro_id'  => $request->membro_id,
															'created_at' => date('Y-m-d H:i:s'),
															'updated_at' => date('Y-m-d H:i:s'),]);

		$request->session()->flash('message_success_equipe', $this->EQUIPE_SUCESSO_MEMBRO_CADASTRO); 
		$request->session()->flash('alert-class', 'alert-success'); 
		return $this->associarMembroEquipeAoProjeto($request);		
		
	}

	public function storeMembroNaEquipe(Request $request, $projeto_id, $membro_id) 
	{
		$projeto = Projeto::find($request->projeto_id);
	    if($projeto->membros()->where('nome', '=', $request->nome)->exists()) {	  
		  # config(['app.timezone' => 'UTC']);
		  # DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		  date_default_timezone_set('America/Sao_Paulo');
		  $projeto->membros()->attach($membro_id, ['user_id' => $request->user()->id,
															'projeto_id' => $request->projeto_id,
		                                                    'membro_id'  => $membro_id,
															'created_at' => date('Y-m-d H:i:s'),
															'updated_at' => date('Y-m-d H:i:s'),]);

		  $request->session()->flash('message_success_equipe', $this->EQUIPE_SUCESSO_MEMBRO_CADASTRO); 
		  $request->session()->flash('alert-class', 'alert-success'); 
		  return $this->associarMembroEquipeAoProjeto($request);
		}else{
		  	$request->session()->flash('message_error_equipe', $this->EQUIPE_ERRO_MEMBRO_EXISTE); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->associarMembroEquipeAoProjeto($request);
		}
	}
	public function restore(Request $request) 
	{
		$trip = Trip::withTrashed()->where('id', $request['id'])->restore();
		return redirect ('trips');
	}
	/**
	*
    * Access  by user Administrador' to change attributes role to user.
	*
	* @param Request, User
	* @return boolean
	*/
	public function wwstore(Request $request)
	{

		$projeto = Projeto::find($request->projeto_id);
	    if($projeto->fases()->where('indicador_id', $request->indicadorProjeto)->exists()){	
			//$request->session()->flash('alert-danger', 'Indicador para esta fase ja existe!');	  
			$request->session()->flash('message', 'Indicador para esta fase ja existe!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 

			return (bool)false;

		}else{
		   
		  /*return $projeto->fases()->attach($request->fasedoProjeto, ['fase_id' => $request->fasedoProjeto,
																'projeto_id' => $request->projeto_id,
		                                                        'indicador_id' => $request->indicadorProjeto,
																'valor_minimo' => $request->valorminimo,
																'valor_maximo' => $request->valormaximo]);
		 */
		  return true;
		}

	}
	/**
    * Access  by user 'Lider de Projeto' to lists members.
	*
	* @param Request
	* @return view
	*/
	public function show(Request $request)
	{
		//var_dump($request->user()->id);
		$membros = $request->user()->getMembrosVetor($request->user()->id);
		return view('equipes.show', ['membros' => $membros,]);		
	}
	/*
	* Detalhes da eequipe de um projeto
	*/
	public function detalhes(Request $request)
	{
		$membros = Projeto::find($request->projeto_id)->membros()->orderBy('id')->get();
		$projeto = Projeto::findOrFail($request->projeto_id); # Sem o ->get() s� recupera um. Se utilizar o  ->get() traz todos
		if($membros != null && count($membros) > 0){			                         			  						 			
			return view('equipes/detalhes', [
				'projeto' => $projeto, 'membros' => $membros,
			]);
		}
	}



	/**
	*
    * Access  by user 'Lider de Projeto' to remove users.
	*
	* @param User, Request
	* @return boolean
	*/
	public function projetoAndMembroShow(Request $request, User $user)
	{			
		//$projetos = Projeto::select('projetos.*')
		//	 ->join('equipes', 'membros.id', '=',  $request->membro)
		//	->where('id', '=', $request->membro)->membros()->get();

		//$membros = Membro::select('membro_id')
        //    ->join('equipes', 'membros.id', '=', 'equipes.membro_id')
        //    ->distinct()->get();

		$membro = Membro::findOrFail($request->membro);
		$projetos = Projeto::select('projetos.*')
            ->join('equipes', 'projetos.id', '=', 'equipes.projeto_id')->where('equipes.membro_id', '=', $request->membro)
            ->get();
		foreach($projetos as $projeto){
			//echo $projeto->nome.'<br>';
		}
		
		//$result = Projeto::find($id)->membros()->orderBy('nome')->where('projeto_id', '=', $id)->get(); # ------ busca na tabela equipes 	
		//$projeto = Projeto::findOrFail($request->projeto_id); # Sem o ->get() s� recupera um. Se utilizar o  ->get() traz todos
		
		if($projetos != null && count($projetos) > 0){			                         			  						 			
			return view('equipes/projetos', ['projetos' => $projetos, 'membro' => $membro,]);
		}else{
			$request->session()->flash('message_error_equipes', $this->$EQUIPE_ERRO_MEMBRO_INDICADOR_SEM_VALORES); 
			$request->session()->flash('alert-class', 'alert-danger'); 			
			return $this->show($request);
		}
	}

	/**
	* Remove member of any project time
    * Access  by user 'Lider de Projeto' to remove users.
	*
	* @param User, Projeto
	* @return boolean
	*/
	public function destroy(Request $request, User $user)
	{
		/**---------------------------------------------------------
		* Verifica se o user possui autoriza��o para criar projetos
		* atrav�s da pol�tica (regra) de autoriza��o
		*-----------------------------------------------------------
		*/
		try{
			//$this->authorize('destroy', $user);
		}catch(AuthorizationException $exception){
			$code = [403];
			if ($exception != null)
			{				
				// vetor com a exception e  codigo para serem exibidos na view
				//$error = array( 'error' => $request->user()->perfil_id , 'code' => $code);
				$error = array( 'error' => $exception->getMessage(), 'code' => $code);				
				switch ($code[0])
				{
					case 403:
						return view('/common.403', $error, $code);
						break;
					default:	
						return view('/common.default', $error, $code);
						break;
				}//switch
			}//if
		}//catch

		$id = (int) $request->membro_id;

		// traz todos os projetos
		//$projetos = Projeto::whereHas('membros', function($q){	$q->where('membro_id', '>', 0 ); } )->orwhere('id', '=', $id )->get();
		// traz um projeto
		$projetos = Projeto::findOrFail($request->projeto_id); # Sem o ->get() s� recupera um. Se utilizar o  ->get() traz todos
		

		$membro = new Membro(); 
		# function in Membro::class $membro->isMembro($id) , Verifica se um membro possui equipe
		#
		if($membro->isMembro($id)){ 
			#se existe como membro em equipe de projeto, logo REMOVE DA EQUIPE DO PROJETO
			//$project = $projetos[0];
			$project = $projetos;
			$resultado = $project->membros()->detach($id, ['user_id' => $request->user()->id,
															'projeto_id' => $project->id,
		                                                    'membro_id'  => $id,
															'updated_at' => date('Y-m-d H:i:s'),]);
			var_dump($resultado );
			$request->session()->flash('message_success_equipe',  $this->EQUIPE_SUCESSO_MEMBRO_REMOVER_EQUIP); 
			$request->session()->flash('alert-class', 'alert-success'); 


		}else{
			#se null, n�o existe como membro em equipe de projeto, logo N�O FAZ NADA-
		}
		
		return redirect('/equipes/show');
	}
	/**
	* Remove member of sistem
    * Access  by user 'Lider de Projeto' to remove users.
	*
	* @param User, Projeto
	* @return boolean
	*/
	public function destroyEquipe(Request $request, User $user)
	{
		/**---------------------------------------------------------
		* Verifica se o user possui autoriza��o para criar projetos
		* atrav�s da pol�tica (regra) de autoriza��o
		*-----------------------------------------------------------
		*/
	
		try{
			//$this->authorize('destroy', $user);
		}catch(AuthorizationException $exception){
			$code = [403];
			if ($exception != null)
			{				
				// vetor com a exception e  codigo para serem exibidos na view
				//$error = array( 'error' => $request->user()->perfil_id , 'code' => $code);
				$error = array( 'error' => $exception->getMessage(), 'code' => $code);				
				switch ($code[0])
				{
					case 403:
						return view('/common.403', $error, $code);
						break;
					default:	
						return view('/common.default', $error, $code);
						break;
				}//switch
			}//if
		}//catch
	
		$id = (int) $request->membro_id;
		$membro = new Membro(); 
		#function in Membro::class $membro->isMembro($id) , Verifica se um membro possui equipe
		if($membro->isMembro($id)){ 
			# Se for membro de alguma equipe, ele N�O ser� removido do sistema
			$request->session()->flash('message_error_equipe', $this->EQUIPE_ERRO_MEMBRO_POSSUI ); 
			$request->session()->flash('alert-class', 'alert-danger');
		}else{
			# Se n�o for membro de nenhuma equipe, ele ser� REMOVIDO do sistema
			$result = Membro::where('id', '=', $request->membro_id)->delete();
			$request->session()->flash('message_success_equipe', $this->EQUIPE_SUCESSO_MEMBRO_REMOVER); 
			$request->session()->flash('alert-class', 'alert-success'); 
		}
		return redirect('/equipes/show');
	}
	/**
	*
    * Access  by user 'Adminstrador' to lists users to update.
	*
	* @param User, Projeto
	* @return boolean
	*
	*/
	public function update(Request $request, User $user)
	{
		/**---------------------------------------------------------
		* Verifica se o user possui autoriza��o para editar usu�rios
		* atrav�s da pol�tica (regra) de autoriza��o
		*-----------------------------------------------------------
		*/
		try{
			//$this->authorize('update', $user);
		}catch(AuthorizationException $exception){
			$code = [403];
			if ($exception != null)
			{				
				// vetor com a exception e  codigo para serem exibidos na view
				//$error = array( 'error' => $request->user()->perfil_id , 'code' => $code);
				$error = array( 'error' => $exception->getMessage(), 'code' => $code);				
				switch ($code[0])
				{
					case 403:
						return view('/common.403', $error, $code);
						break;
					default:	
						return view('/common.default', $error, $code);
						break;
				}//switch
			}//if
		}//catch
		#Recupera um usu�rio atrav�s da classe "AdminstradorRepository" 
		$membro = Membro::findOrFail($request->membro_id);			    
		return view('equipes/update', ['membro' => $membro]);
	}
	/**
	*
    * Access  by user 'Adminstrador' to lists users.
	*
	* @param User, Projeto
	* @return boolean
	*
	*/
	public function atualizar(Request $request, User $user)
	{		
		//$result = Membro::where('nome', '=', $request->nome)->orwhere('id', '=', $request->membro_id)->exists();
		//var_dump($result);
		//return "Hello .........nome>".$request->nome.">id>".$request->membro_id."...Old>".$request->nomeOld;

		# config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');

		if( $request->nome === null || $request->nome === ''){
				$request->session()->flash('message_error_equipe',  $this->EQUIPE_ERRO_MEMBRO_NOME_INVALIDO); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->update($request, $user);
		}
		elseif(is_numeric($request->nome) ){			
				$request->session()->flash('message_error_equipe', $this->EQUIPE_ERRO_MEMBRO_NOME_CARACTER); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->update($request);
		}elseif(!is_null($request->nome) && strlen(trim($request->nome)) <= 0   ){
			$request->session()->flash('message_error_equipe',  $this->EQUIPE_ERRO_MEMBRO_NOME_INVALIDO); 
			$request->session()->flash('alert-class', 'alert-danger');				
			return $this->update($request, $user);
		}
		if(!is_null($request->nome) && strlen(trim($request->nome)) <= 5   ){
			$request->session()->flash('message_error_equipe',  $this->EQUIPE_ERRO_MEMBRO_NOME_INVALIDO); 
			$request->session()->flash('alert-class', 'alert-danger');				
			return $this->update($request, $user);
		}
		if (Membro::where('nome', '=', $request->nome)->exists()) {
		   $request->session()->flash('message_error_equipe', $this->EQUIPE_ERRO_MEMBRO_NOME_JA_EXISTE); 
		   $request->session()->flash('alert-class', 'alert-danger'); 		  
		   return $this->update($request, $user);
		}
		# vetor de mensagens de erros personalizadas
		$messages = array(
			'required' => 'O campo :attribute � obrigat�rio!',
		);	

		# ($input, $rules, $messages)
		# pode ocorre um erro de "NotMethodAloewedException" se ocorrer um erro de valida��o no email se tiver unique:user
		$this->validate($request, [
			'nome' => 'required|string|max:255',
			'nome' => 'required|string|min:6',
		],
        $messages
		);
		# update user
		try{		
			Membro::where('id', $request->membro_id)->update([
				'nome' => $request->nome,
				'updated_at' => date('Y-m-d H:i:s'), 	
			]);
		}catch(PDOException $e){
			throw new Exception('n�o foi poss�vel atualiuzar o nome do membbro');
			$request->session()->flash('message_error_equipe', $this->EQUIPE_ERRO_MEMBRO_NAO_ATUALIZOU);
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->update($request, $user);
		}
		$request->session()->flash('message_success_equipe', $this->EQUIPE_SUCESSO_MEMBRO_ATUALIZAR); 
		$request->session()->flash('alert-class', 'alert-success'); 
		return redirect('/equipes/show');
	}

	/**
    * Access  by user 'Admin' to lists users by name.
	*
	* @param Request, User
	* @return boolean
	*/
	public function showBuscarPorNomeMembro(Request $request, User $user)
	{
		# exibe o conte�do da requisi��o para a busca, se n�o tiver conte�do traz todos os users
		//echo '===showBuscarPorNomeMembro=('. $request->nomeMembroBusca .')/............</br>';
		//var_dump($request->user()->id );

		$membros [] = array();

		try{
			$membros = $request->user()->membros()->where('nome', 'like', '%' . $request->nomeMembroBusca . '%')->orderBy('nome')->get();
	    }catch(PDOException $e){
			$request->session()->flash('message_error_equipe', $e); 
			$request->session()->flash('alert-class', 'alert-success'); 
			return redirect('equipes.show');
			
		} 
		return view('equipes.show', ['membros' => $membros, ]);
	}
	/**
    * Access  by user 'Admin' to lists users by name.
	*
	* @param Request, User
	* @return boolean
	*/
	public function buscarPorNome(Request $request, User $user)
	{
		# exibe o conte�do da requisi��o para a busca, se n�o tiver conte�do traz todos os users
		# echo '===buscarPorNome=('. $request->nomeProjetoBusca .')/............</br>';
		//var_dump($request->user()->id );

		$projetos [] = array();
		$fases = Fase::all();

		try{

		    $projeto =  new Projeto();
			$projetos = $projeto->where('nome', 'like', '%' . $request->nomeProjetoBusca . '%')->orderBy('nome')->get();

			# $projetos = $request->user()
			# ->projetos()
			# ->where('nome', $request->nomeProjeto)
			# ->orWhere('user_id', $request->user_id)
			# ->orWhere('nome', 'like', '%' . $request->nomeProjeto . '%')
			# ->get();
		
	    }catch(Exception $e){
			throw new Exception ('N�o foi poss�vel recuperar os dados!');
			return  $e;
		} 
		return view('equipes.equipes', ['projetos' => $projetos, 'fases' => $fases, ]);
	}
	
	/**
    * Access  by user 'L�der de Projetos' to lists projects by name.
	*
	* @param Request, User
	* @return array
	*/
	public function buscarOrdenarPor(Request $request, User $user)
	{
		//echo '======buscarOrdenarPor=======('. $request->ordenarProjetoPor .')/............</br>';
		//echo '<time datetime="'.date('c').'">'.date('Y - m - d').'</time>';

		$ordenarPor = $request->ordenarProjetoPor;

		$projetos [] = array();
		$fases = Fase::all();
		try{			
			if($ordenarPor === 'NOMEDOPROJETO'){
				$ordenarPor = 'nome';
			    $projeto = new Projeto();
				$projetos = $projeto->orderBy('nome', 'asc')->get();
			}
			elseif($ordenarPor === 'NOMEDOPROJETODESC'){
				$ordenarPor = 'nome';
			    $projeto = new Projeto();
				$projetos = $projeto->orderBy('nome', 'desc')->get();
			}
			elseif($ordenarPor === 'POSSUIEQUIPE'){				
				try{
					$projetos = Projeto::whereHas('membros', function($q){	$q->where('membro_id', '>', 0); } )->get(); 
				}catch( ErrorException $e){
					echo $e->messages();
			
					// Redirect::back()->withInput()->withErrors("Ocorreu um erro!");
				}
			}
			elseif($ordenarPor === 'NAOPOSSUIEQUIPE'){				
				try{
					$projetos = Projeto::whereDoesntHave('membros', function($q){	$q->where('membro_id', '>', 0); } )->get(); 
				}catch( ErrorException $e){
					echo $e->messages();
			
					// Redirect::back()->withInput()->withErrors("Ocorreu um erro!");
				}
			}
			# $users = $request->user()
			# ->projetos()
			# ->where('nome', $request->nomeProjeto)
			# ->orWhere('user_id', $request->user_id)
			# ->orWhere('nome', 'like', '%' . $request->nomeProjeto . '%');
			# ->get();
			
	    }catch(Exception $e){
			throw new Exception ('N�o foi poss�vel recuperar os dados!');
			return  $e;
		} 
		
		return view('equipes.equipes', ['projetos' => $projetos, 'fases' => $fases, ]);
	}
	
	/**
    * Access  by user 'L�der de Projetos' to lists projects by name.
	*
	* @param Request, User
	* @return array
	*/
	public function showBuscarMembroOrdenarPor(Request $request, User $user)
	{
		$ordenarPor = $request->ordenarMembroPor;
		$membros [] = array();
		try{			
			if($ordenarPor === 'NOMEDOMEMBROASC'){
				$ordenarPor = 'nome';
				$membros = $request->user()->membros()->where('nome', 'like', '%' . $request->nomeMembroBusca . '%')->orderBy('nome', 'asc')->get();
			}
			elseif($ordenarPor === 'NOMEDOMEMBRODESC'){
				$ordenarPor = 'nome';
			    $membros = $request->user()->membros()->where('nome', 'like', '%' . $request->nomeMembroBusca . '%')->orderBy('nome', 'desc')->get();
			}
			elseif($ordenarPor === 'POSSUIEQUIPE'){				
				try{
					$membros = Membro::whereHas('user', function($q){	$q->where('user_id', '>', 0); } )->get();
				}catch(PDOException $e){
					$request->session()->flash('message_error_equipe', $e); 
					$request->session()->flash('alert-class', 'alert-success'); 
					return redirect('equipes.show');
				}
			}
			
			# $users = $request->user()
			# ->projetos()
			# ->where('nome', $request->nomeProjeto)
			# ->orWhere('user_id', $request->user_id)
			# ->orWhere('nome', 'like', '%' . $request->nomeProjeto . '%');
			# ->get();
			
	    }catch(Exception $e){
			throw new Exception ('N�o foi poss�vel recuperar os dados!');
			$request->session()->flash('message_error_equipe', $e); 
			$request->session()->flash('alert-class', 'alert-success'); 
			return redirect('equipes.show')->back()->withInput()->withErrors("Ocorreu um erro!");;
		} 
		
		return view('equipes.show', ['membros' => $membros, ]);
	}
	/*
	* Utilizado por equipes.blade.php
	*/
	public function associarEquipeAoProjeto(Request $request, User $user)
	{	
		$fases = array();
		$projetos = array();	
		$projetos = Projeto::all(); # -------------------------------------- busca na tabela projetos
		$fases = Fase::all(); # -------------------------------------------- busca na tabela fases	
	   
		// view		
		return view('equipes/equipes', [
			'projetos' => $projetos, 'fases' => $fases,
		]);
		
	}
	public function associarMembroEquipeAoProjeto(Request $request)
	{
		//echo utf8_encode("Dados do formul�rio").'<br>';
		//echo '['. $request->projeto_id .'; ';

		$projetos = array();	
		try{
			$projetos = Projeto::findOrFail($request->projeto_id);# -------------------------------------- busca na tabela projetos
		}catch ( PDOException $e){
			$e->message();
		}
		//var_dump($projetos->nome);
		return view('equipes.create', [
			'projetos' => $projetos,
		]);
	}
}
