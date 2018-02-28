<?php

namespace App\Http\Controllers\Fase;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;
use App\Indicador;
use App\Projeto;
use App\Fase;
use App\Valor;
use App\Acompanhamento;
use App\FaseProjeto;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class FaseController extends Controller
{
	//
	public function __construct()
	{
		$this->middleware('auth.lep');
	}
	public function associarFasesAoProjeto(Request $request, User $user)
	{	
	    $indicadores = array();
		$fases = array();
		$projetos = array();	
		$projetos = Projeto::all(); # -------------------------------------- busca na tabela projetos
		$fases = Fase::all(); # -------------------------------------------- busca na tabela fases	
		
			
		/*--------------^^-------------------COMENTADO-------------------^^--------------
		$userw = Fase::find(1)->indicador()->orderBy('id')->get(); # ------- busca na tabela fase_projeto
		foreach ($userw as $role) {
			echo '<p> ===================================================================</p></br>';
			//var_dump($role);
			echo '<p> ===================================================================</p></br>';
			echo '<p> id: '.$role->id.' rn: '.$role->nome.' uid: '.$role->indicador_id.' pid: '.$role->fase_id.'</p></br>'; 
		}
		--------------^^-------------------COMENTADO-------------------^^--------------*/
	   
	    /*--------------^^-------------------COMENTADO-------------------^^--------------
		echo '<h2>Fases: </h2></br>';
		foreach ($fases as $fase) { //echo '<span>'.$fase->nome.'</span></br>'; }
		echo '<h2>Projetos: </h2></br>';
		foreach ($projetos as $projeto) {// echo '<span>'.$projeto->nome.'</span></br>'; }
		--------------^^-------------------COMENTADO-------------------^^-------------- **/
		// view		
		return view('indicadores/fases', ['projetos' => $projetos, 'fases' => $fases,]);
		
	}

	/**
    * Access  by user Administrador' to attribut role to user.
	*
	* @param Request, User
	* @return boolean
	*/
	public function associarIndicadorAoProjeto(Request $request,  $projeto_id)
	{
		// Método de recuperação de projetos do user do ProjetoRepository
	    $indicadores = array();		
		$projetos = array();	
		$projeto = Projeto::findOrFail( $projeto_id );
		$fases = Fase::all(); 
	
		$indicadoresall = Indicador::all();
		if($projeto != null ){
		
			$projetos [] = $projeto;
			//foreach ($projetos as $projeto) { echo '<span>'.$projeto->nome.'</span></br>'; }
		}

		//$result = Projeto::find($projeto_id)->fases()->orderBy('id')->get(); 
		//if($result != null && count($result) > 0){
		//	foreach ($result as $res) {	
		//	    $Name = utf8_encode($res->nome);				
		//		//echo $res->nome;					                         			  						 
		//	}
		//}
		// view
		return view('indicadores/associar', ['projetos' => $projetos, 'fases' => $fases, 'indicadoresall' => $indicadoresall,]);
		
	}


	public function getIndicadorDoProjeto(Request $request,  $projeto_id)
	{
	
		$indicadores = array();
		$fases = array();
		$projetos = array();	
		$projeto = Projeto::findOrFail( $projeto_id );
		$fases = Fase::all();
		$indicadoresall = Indicador::all();
		if($projeto != null ){
			$projetos [] = $projeto;
		}
		return view('indicadores/remover', ['projetos' => $projetos, 'fases' => $fases,'indicadoresall' => $indicadoresall,]);

	}
	# Remove indicador do projeto
	public function destroy(Request $request, $faseDoProjeto)
	{
		# verify if user has authorize to make this operation
		if(!$request->user()->isLiderEscritProjetos($request->user()->id)){	
			$code = [403];
			// vetor com a exception e  codigo para serem exibidos na view
			$error = array( 'error' => 'Você não tem privilégio suficiente para excluir usuário!', 'code' => $code);								
			return view('/common.403', $error, $code);
		}//if
		$projeto = Projeto::find($request->projeto) ;
	    if(!$projeto->fases()->where('fase_projeto.id', $request->faseprojeto)->where('indicador_id', $request->indicador)->exists()){		 
			$request->session()->flash('message_error_desassociar', 'Indicador impossibilitado de ser desassociado!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 

			return $this->getIndicadorDoProjeto($request, $request->projeto);
		}else{
			#-----------------------------------------------------
			$temValorInformado = Valor::where('fase_projeto_id', $faseDoProjeto)->first();
			$acomp = new Acompanhamento();	
			$result = null;	
			if(!is_null($temValorInformado)){
				# verify if exists one acompanhamento with value
				if($acomp->where('acompanhamentos.valor_id', $temValorInformado->id)->exists()){		
					//$acompanhamento = Acompanhamento::where('valor_id', $temValorInformado->id)->delete();
				}
				if($temValorInformado->where('fase_projeto_id', $faseDoProjeto)->exists()){	
					# $resultadoDoRemoverValor =  Valor::where('valor_id',  $temValorInformado->id)->delete();
					#  luiz 09/02/2018
					//$resultadoDoRemoverValor =  Valor::where('fase_projeto_id',  $faseDoProjeto)->delete();
				}
			}		
			#-----------------------------------------------------
			
/*
			$results = DB::select('select * from `fase_projeto` where `fase_id` = ? and `projeto_id` = ? and `indicador_id` = ?', array($request->fase, $request->projeto, $request->indicador) )->delete();
*/
			/*$results = DB::table('fase_projeto')
			->where('fase_id',$request->fase)
			->where('projeto_id',$request->projeto)
			->where('indicador_id', $request->indicador)
			;*/

			//$results = $projeto->fases()->where('fase_id', $faseDoProjeto)->where('projeto_id', $request->projeto)->where('indicador_id', $request->indicador)->delete();

			//dd($results);

			//$results = DB::select("select * from fase_projeto where fase_id = '1' and `projeto_id` = '11' and indicador_id = '39' ");
/*			echo ' user_id: '. $request->user;
			echo ' faseProjeto: '. $request->faseprojeto;
			echo ' Projeto: '. $request->projeto;
			echo ' fase: '. $request->fase;
			echo ' indicador: '. $request->indicador.']';
			$inputIds = [$request->projeto];
			$results = DB::table('fase_projeto')
			    //->select('fase_id', 'projeto_id', 'indicador_id')
			    ->select('*')
			    ->whereIn('projeto_id', $inputIds) // pass an array
			    ->get();
			//dd($result);
			//var_dump( $result);

			echo '<br/> -----------168-------tudo-------> ';

			if(!is_null($results) && count($results) > 0){
				foreach($results as $elementKey => $element) {
				    	foreach($element as $keyElementFaseProjeto => $ElementFaseProjeto){	
				    			if( $keyElementFaseProjeto == 'indicador_id' ){
					    				echo( $keyElementFaseProjeto);
					    				echo ' = ';
					    				var_dump($ElementFaseProjeto);
						        }
				    	}
				    	
				}
			}# if
			echo '<br/> -----------182---------remove-----> ';

			 if(!is_null($results) && count($results) > 0){

				foreach($results as $elementKey => $element) {
				    	foreach($element as $keyElementFaseProjeto => $ElementFaseProjeto){	
				    			if( $keyElementFaseProjeto == 'indicador_id' ){
				    				if( $ElementFaseProjeto != intval($request->indicador) ){
					    				echo( $keyElementFaseProjeto);
					    				echo ' = ';
					    				var_dump($ElementFaseProjeto);
					    				echo ' -->  ';
					    				var_dump($request->indicador);
					    				unset($results[$elementKey]);
					    				//$result->delete();
				    			    }
						        }
				    	}
				    	
				}
			}# if
			echo '<br/> -----------203------após remover-------> ';
			if(!is_null($results) && count($results) > 0){
				foreach($results as $elementKey => $element) {
				    	foreach($element as $keyElementFaseProjeto => $ElementFaseProjeto){	
				    			if( $keyElementFaseProjeto == 'indicador_id' ){
				    				if( $ElementFaseProjeto == intval($request->indicador) ){
					    				echo( $keyElementFaseProjeto);
					    				echo ' = ';
					    				var_dump($ElementFaseProjeto);
					    				echo ' -->  ';
					    				var_dump($request->indicador);
					    				//unset($result[$elementKey]);
					    				//$result->delete();
				    			    }
						        }
				    	}
				    	
				}
			}# if

			echo '<br/> -----------223-------sobrou-------> ';
			if(!is_null($results) && count($results) > 0){
				foreach($results as $elementKey => $element) {
				    	foreach($element as $keyElementFaseProjeto => $ElementFaseProjeto){	
				    			if( $keyElementFaseProjeto == 'indicador_id' ){
					    				echo( $keyElementFaseProjeto);
					    				echo ' = ';
					    				var_dump($ElementFaseProjeto);
						        }
				    	}
				    	
				}
			}# if
			//$collection = new Collection($results);
        	//dd($collection);

			//dd($results[1]);

        	$model = new FaseProjeto();
        	//$model->fillable($results);
        	//$results[1]->delete();
        	$model->id = $results[1]->id;
        	$model->fase_id = $results[1]->fase_id; 
        	$model->projeto_id = $results[1]->projeto_id; 
        	$model->indicador_id = $results[1]->indicador_id; 
        	$model->valor_minimo = $results[1]->valor_minimo ; 
        	$model->valor_maximo = $results[1]->valor_maximo; 
        	$model->created_at = $results[1]->created_at; 
        	$model->updated_at = $results[1]->updated_at;
        	$model->delete();
*/
        	//dd($model);
        	$id_fase_projeto = intval($request->faseprojeto);
        	$deletedRows = DB::table('fase_projeto')->where('id', $id_fase_projeto)->delete();

		


			// if(!is_null($result) && count($result) > 0){
			// 	foreach($projetos as $elementKey => $element) {
			// 	    	foreach($licoesaprendidas as $elementKeylicoes => $licoesElement){	
			// 	    			if( $element['id'] == $licoesElement['projeto_id'] ){
			// 	    				//var_dump( $element['id'] );
			// 	    				//var_dump($licoesElement['projeto_id']);
			// 	    				unset($projetos[$elementKey]);
			// 			        }
			// 	    	}
			// 	}
			// }# if
	

		

			if(!is_null($deletedRows)){
				$request->session()->flash('message_success_desassociar', 'Indicador desassociado com sucesso!'); 
				$request->session()->flash('alert-class', 'alert-success'); 
			}else{
				$request->session()->flash('message_error_desassociar', 'Falha ao tentar desassociar o indicador!'); 
				$request->session()->flash('alert-class', 'alert-danger'); 
			}
			return $this->getIndicadorDoProjeto($request, $request->projeto);
		}
		return $this->getIndicadorDoProjeto($request, $request->projeto);
	}

	public function indicadoresDaFase($fase_id)
	{
		
	    $indicadores = array();
		try {
			$indicadores = Fase::findOrFail(1)->indicador()->orderBy('id')->get(); # ------ busca na tabela fase_projeto ----------> RETURN indicador nome
			//return $indicadores;



			//return redirect( response()->json(array(view('indicadores/json')->with('indicadores',$indicadores), 'indicadores' => $indicadores))->header('Content-Type', 'json')) ;
			 response()->json(array(view('indicadores/json')->with('indicadores',$indicadores), 'indicadores' => $indicadores));
			
			/*
			return response()->json([
                "result" => $result
            ]); */
		}catch (Exception $e){
			
			//return response()->json(array('err'=>'error'))-redirect;
	    }
		/*
		
		if($indicadores != null && count($indicadores) > 0){
			foreach ($indicadores as $res) {	
			    $Name = utf8_encode($res->nome);				
				//echo $res->nome;					                         			  						 
			}
			$indicadores[] = $result;
		}

		*/
/*
		return Response::json(array(
                    'success' => true,
                    'data'   => $result
                )); 
  */
		// view
		//return view('indicadores/associar', ['indicadores' => $indicadores,]);
		
	}
	/**
	*
    * Access  by user Administrador' to change attributes
	*
	* @param Request, User
	* @return boolean
	*/
	public function store(Request $request)
	{
		/*
		echo 'FaseController<hr style="color:red;">' ;
		echo ' user_id: '. $request->user_id;
		echo ' [fasedoProjeto: '. $request->fasedoProjeto;
		echo ' projeto_id: '. $request->projeto_id;		
		echo ' indicadorProjeto: '. $request->indicadorProjeto;
		echo ' valormaximo: '. $request->valormaximo;
		echo ' valorminimo: '. $request->valorminimo .']';
		echo '<br><hr style="color:red;"><br>' ;
		*/
		/*
		 $valormaximoNumerico = is_numeric ($request->valormaximo) ? true : false;
		 var_dump($valormaximoNumerico);
		 $valormaximoNumerico = ctype_digit( $request->valormaximo) ? true : false;
		 var_dump($valormaximoNumerico);
		 $valormaximoNumerico = is_bool( $request->valormaximo) ? true : false;
		 var_dump($valormaximoNumerico);
		 $valormaximoNumerico = is_null( $request->valormaximo) ? true : false;
		 var_dump($valormaximoNumerico);
		 $valormaximoNumerico = is_float( $request->valormaximo) ? true : false;
		 var_dump($valormaximoNumerico);
		 $valormaximoNumerico = is_int( $request->valormaximo) ? true : false;
		 var_dump($valormaximoNumerico);
		 $valormaximoNumerico = is_string( $request->valormaximo) ? true : false;
		 var_dump($valormaximoNumerico);
		 $valormaximoNumerico = is_object( $request->valormaximo) ? true : false;
		 var_dump($valormaximoNumerico);
		 $valormaximoNumerico = is_array( $request->valormaximo) ? true : false;
		 var_dump($valormaximoNumerico);
		 */

		///*return response()
        //->view('indicadores/show', $request, 200)
        //->header('Content-Type', 'html');
		//*/
		//$messages = array(
		//	'required' => 'O campo :attribute é obrigatório!',
		//	'numeric' => 'O campo :attribute deve ser um número válido!',
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

		
		$projeto = Projeto::find($request->projeto_id);
	    if($projeto->fases()->where('indicador_id', $request->indicadorProjeto)->exists()){	
			//$request->session()->flash('alert-danger', 'Indicador para esta fase ja existe!');	  
			$request->session()->flash('message', 'Indicador para esta fase ja existe!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 

			return (bool)false;

		}else{
			# config(['app.timezone' => 'UTC']);
			# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
			date_default_timezone_set('America/Sao_Paulo');
		  	return $projeto->fases()->attach($request->fasedoProjeto, ['fase_id' => $request->fasedoProjeto,
																'projeto_id' => $request->projeto_id,
		                                                        'indicador_id' => $request->indicadorProjeto,
																'valor_minimo' => $request->valorminimo,
																'valor_maximo' => $request->valormaximo,
																'created_at' => date('Y-m-d H:i:s'),
																'updated_at' => date('Y-m-d H:i:s'),]);
		 
		  return true;
		}
		
		/*
		//$result = Projeto::find($request->projeto_id)->fases()->orderBy('id')->get(); # ------ busca na tabela fase_projeto ----------> RETURN indicador nome		
		//if($result != null && count($result) > 0){
			//foreach ($result as $res) {	
			//    $Name = utf8_encode($res->nome);				
				//echo $res->nome;		                         			  						 
			//}
		//}
		*/


	}

	public function remove($idUser, $permissao)
	{

	}
	public function storeBKP(Request $request)
	{
		
		# {userid}/{adm}/{ger_proj}/{lider_escr_proj}/{lider_proj}/{membro_alta_dir}
		# 'userid' => '4', 'adm' => '0', 'ger_proj' => '0', 'lider_escr_proj' => '0', 'lider_proj => '0', 'membro_alta_dir' => '0')
		/*
		echo 'C:\xampp\htdocs\portifoliogestor\app\Http\Controllers\RoleController.php<br>';
		echo ' userid: '. $request->userid;
		echo ' [adm: '. $request->adm;
		echo ' gerproj: '. $request->ger_proj;
		echo ' liderescrproj: '. $request->lider_escr_proj;
		echo ' liderproj: '. $request->lider_proj;
		echo ' mad: '. $request->membro_alta_dir .']';
		echo '<br><hr style="color:red;"><br>' ;
		*/
		$rolesADD = array();
		if(  $request->adm == 1){
			$rolesADD [] = 1;
		}
		if(  $request->ger_proj == 1){
			$rolesADD [] = 2;
		}
		if(  $request->lider_escr_proj == 1){
			$rolesADD [] = 3 ;
		}
		if(  $request->lider_proj == 1){
			$rolesADD [] = 4 ;
		}
		if(  $request->membro_alta_dir == 1){
			$rolesADD [] = 5 ;
		}
		$userw = User::find($request->userid)->roles()->orderBy('id')->get(); # ----------------------------- busca na tabela role_user
		$permissoes = array();
		if($userw != null && count($userw) > 0){
			$nome = '';
			//var_dump($userw);
			foreach ($userw as $role) {
				
				$nome  = $role->role_name;      
								  						 
				$permissoes[] = $nome; 
			}
			
			//return $permissoes;
		}
		else{

			//return null;
		}
		//var_dump($rolesADD);
		//$user = User::find($request->userid);
		//$role = Role::find($role_id);
		//$user->roles()->attach($role);
		//return $user->roles()->sync($rolesADD);// array de permissões

	}

	/**
	*
    * Access  by user 'Administrador' to lists users.
	*
	* @param Request
	* @return boolean
	*/
	public function show(Request $request)
	{
		// Método de recuperação de projetos do user do ProjetoRepository
	    $users = array();
		$users = $this->administradorRepository->allUser();
		// view
		return view('admin.show', [
			'users' => $users,
		]);
	}
	/**
	*
    * Access  by user 'Admin' to lists users by name.
	*
	* @param Request, User
	* @return boolean
	*/
	public function buscarPorNome(Request $request, User $user)
	{
		# exibe o conteúdo da requisição para a busca, se não tiver conteúdo traz todos os users
		# echo '===buscarPorNome=('. $request->nomeUsuarioBusca .')/............</br>';
		//var_dump($request->user()->id );

		$projetos [] = array();
		try{

		    $users =  User::where('name', 'like', '%' . $request->nomeUsuarioBusca . '%')->orderBy('name')->paginate(10);
			
			# $projetos = $request->user()
			# ->projetos()
			# ->where('nome', $request->nomeProjeto)
			# ->orWhere('user_id', $request->user_id)
			# ->orWhere('nome', 'like', '%' . $request->nomeProjeto . '%')
			# ->get();
		
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		//return redirect('/projetos/show');

		return view('admin.show', [
			'users' => $users,
		]);
	}

	/**
	*
    * Access  by user 'Administrador' to lists projects by name.
	*
	* @param Request, User
	* @return array
	*/
	public function buscarOrdenarPor(Request $request, User $user)
	{
		//echo '======buscarOrdenarPor=======('. $request->ordenarUsuarioPor .')/............</br>';
		//echo '<time datetime="'.date('c').'">'.date('Y - m - d').'</time>';

		$ordenarPor = $request->ordenarUsuarioPor;

		$users [] = array();
		try{			
			if($ordenarPor === 'NOMEDOUSUARIO'){
				$ordenarPor = 'name';
				 $users =  $this
				    ->user
					->orderBy($ordenarPor, 'asc')
					->get();
			}
			elseif($ordenarPor === 'EMAILDOUSUARIO'){
				$ordenarPor = 'email';
				$users =  $this
				->user
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
			elseif($ordenarPor === 'PERFILDOUSUARIO'){
				$ordenarPor = 'perfil_id';
				$users =  $this
				->user
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
			# $users = $request->user()
			# ->projetos()
			# ->where('nome', $request->nomeProjeto)
			# ->orWhere('user_id', $request->user_id)
			# ->orWhere('nome', 'like', '%' . $request->nomeProjeto . '%');
			# ->get();
			
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
	
		return view('admin.show', ['users' => $users,]);
	}
	public function buscarTodasRoles()
	{
		$role = new Role();
		$roles [] = array();
		$roles =  $role->orderBy('role_name', 'asc')
					->get();
	
		return  $roles;
	}
}