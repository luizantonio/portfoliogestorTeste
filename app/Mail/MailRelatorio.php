<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Relatorio;
use DateTime;//
use App\User;//
use App\Fase;//
use App\Valor;//
use App\Projeto;//
use App\Indicador;//
use App\FaseProjeto;
use App\ProjetosCancelados;


class MailRelatorio extends Mailable
{
    use Queueable, SerializesModels;

    
	protected $relatorio;
	
	##-------no arquivo .env -------original-----------------------------------
	#	
	# MAIL_DRIVER=smtp
	# MAIL_HOST=smtp.mailtrap.io
	# MAIL_PORT=2525
	# MAIL_USERNAME=portifolio.gestor@gmail.com
	# MAIL_PASSWORD=ka9x.swz4h5jr1s
	# MAIL_ENCRYPTION=tls
	#-------------------------------------------------
	
	/**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Relatorio $relatorio)
    {
        $this->relatorio = $relatorio;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

    	// Path to the project's root folder    
	   // echo base_path();
	    //echo '<br/>';
	    // Path to the 'app' folder    
	    //echo app_path();        
	    //echo '<br/>';
	    // Path to the 'public' folder    
	    //echo public_path();
	    //echo '<br/>';
	    //Path to the 'app/storage' folder    
	    //echo storage_path();
	   // echo '<br/>';
		$servername = "localhost";
        $username = "cancelados";
        $password = "12345";
        $banco = "emailusers";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password);//, $banco);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        //echo "Connected successfully";
        $sql = "select * from emailusers.mails";
        //$emailsAltaDirecao = $conn->query("select * from emailusers.mails");
        $result=mysqli_query($conn, $sql);
        if ($result=mysqli_query($conn, $sql))
		{
		  while ($onemail = mysqli_fetch_object($result)) {
                $eMails[] = $onemail;
                var_dump($eMails);
           }
		}
        /*$eMails = array();
        if ( !is_null($emailsAltaDirecao) ){
           while ($onemail = mysqli_fetch_object($emailsAltaDirecao)) {
                $eMails[] = $onemail;
                var_dump(65);
                var_dump($eMails);
            }
            //return $eMails;
        }*/
        //return null;
       // mysqli_close($conn);
         // Create connection
        //$banco = "portifoliogestor";
        //$conn = mysqli_connect($servername, $username, $password, $banco);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        //echo "Connected successfully";
        $date = date('Ym');
        /*$ProjetosCancelados = $conn->query("select * from   projetoscancelados WHERE    projetoscancelados.data=". $date);*/
        $sql = "select * from   portifoliogestor.projetoscancelados WHERE portifoliogestor.projetoscancelados.data=". $date;
        //$Projetos = array();
/*        if ( !is_null($ProjetosCancelados) ){
            foreach($ProjetosCancelados as $projeto){
                var_dump($projeto->projeto);
                var_dump($projeto->responsavel);
                var_dump($projeto->status);
                var_dump($projeto->justificativa);
                var_dump($projeto->data);
            }#foreach
        }
*/		$result=mysqli_query($conn, $sql);
        if ($result=mysqli_query($conn, $sql))
		{
		  while($projeto=mysqli_fetch_object($result))
		  {
		    var_dump($projeto->projeto);
            var_dump($projeto->responsavel);
            var_dump($projeto->status);
            var_dump($projeto->justificativa);
            var_dump($projeto->data);
		  }
		}
        //return null;
        
        mysqli_close($conn);

		ini_set('max_execution_time', 60);
		# Recupera os projetos cncelados
        $verificar = $this->verificarProjetosCanceladosNoPeriodo();
        # variável para a colecao de emails
        $UsersMails = null;
        # variável para o retorno do arquivo
        $Arquivo = null;        
        if ( !is_null($verificar) ){
            # realiza a recuperação dos emails
            $UsersMails = $this->allUsersMails();
            if ( !is_null($UsersMails) ){
                # realiza a operação de gerar o arquivo
                $Arquivo = $this->gerarArquivo($verificar);
            }
        }
		/*
		Mail::raw('Text to e-mail', function ($message) {
			$message->from('portifolio.gestor@gmail.com', 'Luiz' );
			$message->sender('luizsilvaifes@gmail.com', 'Luiz');
			$message->to('luizsilvaifes@gmail.com', 'Luiz' );
			$message->cc('luizsilvaifes@gmail.com', 'Luiz' );
			$message->bcc('luizsilvaifes@gmail.com', 'Luiz');
			$message->replyTo('luizsilvaifes@gmail.com', 'Luiz');
			$message->subject('Teste de envio de email');
			//$message->priority($level);
			//$message->attach($pathToFile, array $options = []);

			// Attach a file from a raw $data string...
			//$message->attachData($data, $name, array $options = []);
		});
		*/
		$data = 'Um email de Mail';
		//return $this->from('portifolio.gestor@gmail.com')->view('relatorio.mail.relarorio',[ 'data' => $data,]);

/*****************************************************************************************************/
		$indicadores = Indicador::select('indicadors.*', 'fase_projeto.*' )
            ->join('fase_projeto', 'indicadors.id', '=', 'fase_projeto.indicador_id')->where('fase_projeto.projeto_id', '>', 0)
            ->get();
		foreach($indicadores as $i){
			#var_dump($i->nome);
		}
		$projetos =  Projeto::all(); # Sem o ->get() só recupera um. Se utilizar o  ->get() traz todos
		//echo '<output><b>'; echo utf8_encode('RELATÓRIO DOS INDICADORES DOS PROJETOS:'); echo '</b></output>';	
		//echo "--------------------".date('d/m/Y H:i:s')."-----------------------------------";
		$t = "";
		$t .= "--------------------".date('d/m/Y H:i:s')."-----------------------------------". PHP_EOL;
		$t .= "\t\tRELATÓRIO DE INDICADORES DOS PROJETOS". PHP_EOL;
		
		foreach($projetos as $projeto){
			if($projeto->isQualIndicador( $projeto->id)){
				//echo '<div class="form-group navbar-form">	';	
				$contadorIndicador = 0;
				$contadorValor = 0;
				$indicadores = $projeto->indicadoresDoProjeto( $projeto->id); 
				if(count($indicadores)>0){
						  
					$t .= "-----------------------------------------------------------------". PHP_EOL;
					$t .= "PROJETO:\t". utf8_decode($projeto->nome). PHP_EOL;
					$t .= "-----------------------------------------------------------------". PHP_EOL;
				}
				foreach($indicadores as $indic){
					if($projeto->isQualIndicador( $projeto->id)){								
						$valoresInformados = $indic->valoresInformados($indic->id, $projeto->id);
						if(!is_null($valoresInformados)){
								foreach($valoresInformados as $valoresInf){	
									 if( $indic->id == $valoresInf->fase_projeto_id ){
										if($contadorValor%2==0){ 
											//echo '<output style="background-color:#F0F8FF">';
										}else{
											//echo '<output style="background-color:lien;">';
										} 	
										//echo '<strong>'; 
										//echo $indic->nomeFase($indic->fase_id); 
										$t .= "FASE:\t\t" .$indic->nomeFase($indic->fase_id). PHP_EOL;
										//echo '</strong> - ';
										//echo $indic->nome. '<br>';
										$t .= "INDICADOR:\t" .$indic->nome. PHP_EOL;
										//echo '<strong style="color:blue;">VALOR ESPERADO:</strong>'; 
										$t .= "VALOR ESPERADO:". PHP_EOL;
										//echo utf8_encode('Mínimo');
										//echo ':<strong style="color:black;">'. $indic->valor_minimo .'</strong>';
										$t .= "Mínimo:\t\t" .$indic->valor_minimo. PHP_EOL;
										//echo utf8_encode('Maximo'); 
										//echo ':<strong style="color:black;">'. $indic->valor_maximo.'</strong> <br>';
										$t .= "Máximo:\t\t" .$indic->valor_maximo. PHP_EOL;
										//echo '<strong style="color:orange;">VALOR INFORMADO:</strong>'; 
										$t .= 'VALOR INFORMADO:'. PHP_EOL;
										//echo utf8_encode('Mínimo');
										//echo ': '.'<strong style="color:black;">'. $valoresInf->valor_minimo . '</strong>';
										$t .= "Mínimo:\t\t" .$valoresInf->valor_minimo. PHP_EOL;
										//echo utf8_encode('Máximo');
										//echo ': <strong style="color:black;">'. $valoresInf->valor_maximo ;
										$t .= "Mánimo:\t\t" .$valoresInf->valor_maximo. PHP_EOL;
										//echo '</strong> ';
										//echo '</output>';  
									}#endif	
								}#endforeach
						}else{
							if($contadorIndicador%2==0){
									//echo '<output style="background-color:#F0F8FF;">';
							}else{
									 //echo '<output style="background-color:lien;">';
							} 	
							//echo '<strong>'. $indic->nomeFase($indic->fase_id) .'</strong> -';
							$t .= $indic->nomeFase($indic->fase_id) .'-'. PHP_EOL;
							//echo $indic->nome . '-';
							$t .= $indic->nome . '-'. PHP_EOL;
							//echo utf8_encode('Valor Mínimo');
							$t .= 'Valor Mínimo' .':'. PHP_EOL;
							//echo ': '. $indic->valor_minimo ;
							$t .= $indic->valor_minimo .'-'. PHP_EOL;
							//echo utf8_encode('Valor Máximo');
							$t .= 'Valor Máximo'.'-'. PHP_EOL;
							//echo ': '. $indic->valor_maximo ;
							$t .= $indic->valor_maximo .'-'. PHP_EOL;
							//echo '</output> '; 
							$contadorIndicador = $contadorIndicador + 1; 
							$contadorValor = $contadorValor + 1;
						}#endesle
						
						 #foreach($valoresInformados as $valoresInf){												
							#if( $indic->id == $valoresInf->fase_projeto_id ){
									#if (!is_null(Auth::user()->acompanhamentoByValorId(Auth::user()->id , $valoresInf->id))){
											#echo '<output style="background-color:#F0F8AF;"><span id="content_acompanhamento">'. Auth::user()->acompanhamentoByValorId(Auth::user()->id , $valoresInf->id).'</span></output>  '; 
									#}#endif		
							#}#endif

						#}#endforeach
					
					}																						
				}#endforeach
				
			//echo '</div>';
												  
			}#if
		
		}#foreach
		$fases = Fase::all();
		#foreach($fases as $fase){
			#var_dump($fase->nome);
		#}
		
/************************************************************************************************/
		#------------------------------------------------------------------------------
		/*
		$array = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
		$t = "";
		foreach ($array as $i)
		{
			$t .= $i . PHP_EOL;
		}
		*/

		#-----------------cria e escreve no arquivo relatorio.txt-----------------------		
		\Illuminate\Support\Facades\Storage::disk('public')->put('400.txt', $t);
		#-------------------------------------------------------------------------
		/*$tets = Mail::raw('Message text', function($message) {
			$message->from('no-reply@portifoliogestor.com', 'Portifolio Gestor');
			$message->to('portifoliogestor@portifoliogestor.com')->cc('luzjpas@gmail.com' );
		});*/
		//var_dump($tets);

		/*$resutadoc  = Mail::send('relatorio.mail.relarorio', array('msg' => 'This is the body of my email'), function($message)
		{
			$message->to('portifoliogestor@portifoliogestor.com', 'John Smith')->subject('This is my subject');
		});*/
		//var_dump($resutadoc);

		//return 
		/*$this->from('no-reply@portifoliogestor.com', 'Portifolio Gestor')
				->cc('portifoliogestor@portifoliogestor.com', 'Luiz' )
				->cc('gestor@inbox.mailtrap.io', 'Luiz' )
				->view('relatorio.mail.relarorio',[ 'relatorio' => $this->relatorio,])               
                ->attach(public_path('/storage/400.txt'));

		$this->relatorio = "Meu documento de teste 09-09-2017";
        */

		/*$this->from('no-reply@portifoliogestor.com', 'Portifolio Gestor')
				->cc('luizsilvaifes@portifoliogestor.com', 'Luiz' )
				/>cc('dfb6b9fe68-78b989@inbox.mailtrap.io', 'Luiz' )
				->view('relatorio.mail.relarorio',[ 'relatorio' => $this->relatorio,])               
                ->attach(public_path('/storage/400.txt'));*/

		/*return $this->from('portifolio.gestor@gmail.com')->cc('luizsilvaifes@gmail.com', 'Luiz' )
				->view('email.relatorio',[ 'relatorio' => $this->relatorio,])               
                ->attach(public_path('/storage/400.txt'));*/
    }
    /** 
    * Hith Administration - Alta direção 
    * Request user´s mail to send statistics of level indicators inconsistence level
    * Recupera os emails dos usuários da alta direção no caso de indicador fora de nível
    * @return array 
    */
    public function allUsersMails()
    {
        // $items = DB::table('items')->whereIn('id', [1, 2, 3])->get();
        # verify if exists value in table
        $resultadoMails = User::select('users.*', 'email' )
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', '=', 5 )
            ->get();
        $eMails = array();
        if ( !is_null($resultadoMails) ){
            foreach ($resultadoMails as $usermail) {    
                $eMails [] = $usermail->email;
            }
            return $eMails;
        }
        return null;
    } 

    /**
    * Verifica se existem projetos cancelados.
    *
    * @return array
    **/
    public function verificarProjetosCanceladosNoPeriodo(){
        $date = date('Ym');
        $ProjetosCancelados = ProjetosCancelados::select('*' )
            ->where('projetoscancelados.data', '=', $date)
            ->get();
       if(!is_null($ProjetosCancelados)){
            return $ProjetosCancelados;
       }
       return null;
    }
    /**
    * Gera um arquivo txt para ser enviado ao menbro da alta direção
    * @param Request
    * @return array
    **/
    public function gerarArquivo($ProjetosCancelados){
        if(is_null($ProjetosCancelados)){
            return null;
        }
        $t = "";
        $t .= "--------------------".date('d/m/Y H:i:s')."----------------------". PHP_EOL;
        $t .= "\t\tRELATÓRIO DOS PROJETOS CANCELADOS NO PERÍODO". PHP_EOL;
        foreach($ProjetosCancelados as $projeto){
            $t .= "-----------------------------------------------------------------". PHP_EOL;
            $t .= "PROJETO:\t". utf8_decode($projeto->projeto). PHP_EOL;
            $t .= "-----------------------------------------------------------------". PHP_EOL;
            $t .= "RESPONSÁVEL:\t" .$projeto->responsavel. PHP_EOL; 
            $t .= "STATUS:     \t" .$projeto->status. PHP_EOL; 
            $t .= "JUSTIFICATIVA:\t" .$projeto->justificativa. PHP_EOL; 
            $t .= "ANO/MES:    \t" .$projeto->data. PHP_EOL; 
            $t .= "". PHP_EOL;
            $t .= "-----------------------------------------------------------------". PHP_EOL;
        }#foreach
        #-----------------cria e escreve no arquivo relatorio.txt-----------------------      
         \Illuminate\Support\Facades\Storage::disk('public')->put('relatorio.txt', $t);
        #-------------------------------------------------------------------------
        
       return $ProjetosCancelados;
    }
    
    /**
    * Função responsável por envia email aos membros da ata direção em caso de 
    * indicadores fora do nível esperado
    */
    public function sendEmail($ProjetosCanceladosNoPeriodo)
    {
        
        if(is_null($ProjetosCanceladosNoPeriodo)){ return; }
        $emailAltaDirecao = $this->allUsersMails();
        if(is_null($emailAltadirecao)){ return; }
        //$Relatorio = new Relatorio();
        $data = 'Um email de Mail';
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $from = 'nao-responda@portifoliogestor.com';
        $to = 'administrador@portifoliogestor.com';
        $subject = 'Indicadore fora do nível esperado';
        $message = 'Em: '.date('d/m/Y H:i:s') . "\r\n";
        $message .= 'Atenção: Relatório de Indicadores fora do nível esperado'. "\r\n";
        foreach ($ProjetosCanceladosNoPeriodo as $key => $value) {
            $message .= $key . ' ' . $value . "\r\n";
        }
        $message .=  ' ' . "\r\n";
        $message .= 'Remetente: Sistema Portifolio Gestor.';
        $headers = 'MIME-Version: 1.0' . "\r\n" .
                   'Content-type: text/plain; charset=iso-8859-1' . "\r\n" .
                   'From: '.$from. "\r\n" .
                   'Cc: ';
                   foreach ($emailAltaDirecao as $CcMail) {
                        $headers .= $CcMail ;
                   }
                   $headers .= "\r\n".
                   'Reply-To: administrador@portifoliogestor.com' . "\r\n" .
                   'Subject:'.$subject. "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
       //mail($to, $subject, $message, $headers);
    }


}