<?php
//require_once('/usr/share/php/libphp-phpmailer/autoload.php');
namespace App\Mail\app\Mail;
/*use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;*/
use DateTime;
use App\User;
use App\Fase;
use App\Valor;
use App\Projeto;
use App\Indicador;
use App\FaseProjeto;
use App\ProjetosCancelados;

//class MailMonth extends Mailable
class MailMonth 
{
    //use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public static function f(){
        $inner = function(){
            self::build();
        };
        $inner();
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
            echo 'Message has been eMails';
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
        $ProjetosCancelados = ProjetosCancelados::select('projetoscancelados.*' )
            ->where('projetoscancelados.data', '=', $date)
            ->get();

       if(!is_null($ProjetosCancelados)){
            echo 'Message has been ProjetosCancelados';
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
        #-----------------cria e escreve no arquivo 400.txt-----------------------      
         \Illuminate\Support\Facades\Storage::disk('public')->put('400.txt', $t);
        #-------------------------------------------------------------------------
       echo 'Message has been ProjetosCancelados';
       return $ProjetosCancelados;
    }
    
    /**
    * Função responsável por envia email aos membros da ata direção em caso de 
    * indicadores fora do nível esperado
    */
    public function sendEmail($ProjetosCanceladosNoPeriodo)
    {
        
        if(is_null($ProjetosCanceladosNoPeriodo)){ return null; }
        $emailAltaDirecao = $this->allUsersMails();
        if(is_null($emailAltadirecao)){ return null; }
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
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        #return $this->view('view.name');

        ini_set('max_execution_time', 60);
        # Recupera os projetos cncelados
        $verificar = self::verificarProjetosCanceladosNoPeriodo();
        # variável para a colecao de emails
        $UsersMails = null;
        # variável para o retorno do arquivo
        $Arquivo = null;        
        if ( !is_null($verificar) ){
            # realiza a recuperação dos emails
            $UsersMails = allUsersMails();
            if ( !is_null($UsersMails) ){
                # realiza a operação de gerar o arquivo
                $Arquivo = self::gerarArquivo($verificar);
            }
        }
        # se arquivo retornou diferente de null enviar email
        if ( !is_null($Arquivo) ){
            $OUTRO = self::sendEmail($verificar);   
            //return 
            /*$this->from('no-reply@portifoliogestor.com', 'Portifolio Gestor')
                    ->cc('portifoliogestor@portifoliogestor.com', 'Luiz' )
                    ->cc('gestor@inbox.mailtrap.io', 'Luiz' )
                    ->view('relatorio.mail.relarorio',[ 'relatorio' => $this->relatorio,])               
                    ->attach(public_path('/storage/400.txt'));
            */
            /*return $this->from('portifolio.gestor@gmail.com')->cc('luizsilvaifes@gmail.com', 'Luiz' )
                    ->view('email.relatorio',[ 'relatorio' => $this->relatorio,])               
                    ->attach(public_path('/storage/400.txt'));*/

            // Inclui o arquivo class.phpmailer.php localizado na pasta class
            require_once('/usr/share/php/libphp-phpmailer/PHPMailerAutoload.php');
            require_once('/usr/share/php/libphp-phpmailer/class.phpmailer.php');
            require_once('/usr/share/php/libphp-phpmailer/class.smtp.php');
            $mail = new PHPMailer(true);
            $name = "Luiz";
            //$phone = $_POST['phone'];
            $email = "contato@portifoliogestor.com";
            //$file = $_FILES['attachment']['tmp_name'];
            $message = "To view the message, please use an HTML compatible email viewer!";
            $mail->isMail();                                      // Set mailer to use SMTP
            $mail->Host = 'localhost';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'administrador@portifoliogestor.com';                 // SMTP username
            $mail->Password = 'las4ifes';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->From = 'administrador@portifoliogestor.com';
            $mail->FromName = $name;
            //$mail->addAddress('joe@example.net', 'Joe User');  // Add a recipient
            $mail->addAddress('contato@portifoliogestor.com');  // Name is optional            
            $mail->isHTML(true);                                // Set email format to HTML
            $mail->Subject = 'Relatório de Projetos Cancelados';
            $mail->Body = $message;
            $mail->Body .= "<br/><br/>Below are my contact details <br/> Name: ";
            $mail->Body .= $name;
            $mail->Body .= "<br/>My Phone number: ";
            //$mail->Body .= $phone;
            $mail->Body .= "<br/> My email address: ";
            $mail->Body .= $email;
            $mail->AltBody = 'You are using basic web browser ';
            $mail->MsgHTML("Relatório de Projetos Cancelado");
            foreach ($UsersMails as $CcMail) {
                $mail->AddAddress($CcMail);
            }
           /* $filename = '/var/www/html/public/storage/relatorio.txt';
            $mail->AddAttachment('/var/www/html/public/storage/400.txt', $name = 'relatorio.txt',
            $encoding = 'base64', $type = 'application/txt');        // Add attachments
            if (file_exists($filename)) {
                $mail->AddAttachment('/var/www/html/public/storage/400.txt', $name = 'relatorio.txt',
                    $encoding = 'base64', $type = 'application/txt');

                $mail->AddAttachment('/var/www/html/public/storage/400.txt', $name = 'relatorio.txt',
                    $encoding = 'base64', $type = 'txt');
            }*/
            if(!$mail->send()) {
                echo 'A mensagem não foi enviada.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'A mensagem foi enviada';
                //header('Location: thankyou.html');
            }
        }
    }

}
MailMonth::f();
?>