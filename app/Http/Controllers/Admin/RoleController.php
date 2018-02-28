<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;//
use App\Role;//
use App\Administrador;//


class RoleController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('auth.admin');

	}

	public function remove($idUser, $permissao)
	{

	}
	public function store(Request $request)
	{
		
		# {userid}/{adm}/{ger_proj}/{lider_escr_proj}/{lider_proj}/{membro_alta_dir}
		# 'userid' => '4', 'adm' => '0', 'ger_proj' => '0', 'lider_escr_proj' => '0', 'lider_proj => '0', 'membro_alta_dir' => '0')

		
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
		$userw = User::find($request->userid)->roles()->orderBy('id')->get(); 
		#  busca na tabela role_user
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
		$user = User::find($request->userid);
		//$role = Role::find($role_id);
		//$user->roles()->attach($role);
		#-----------------------------------------------------------------------------
		# Add role to user there
		#-----------------------------------------------------------------------------
		return $user->roles()->sync($rolesADD);// array de permissões

		# $user_id = $request->input('user_id'); // get user id from post request
		# $role_id = $request->input('role_id'); // get  Role id from post request
		/* Operações para request validation*/
		# $user = User::find($user_id);
		# $role = Role::find($role_id);
		# $user->roles()->attach($role);
		return null;
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
