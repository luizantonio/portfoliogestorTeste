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
//use  var\www\html\vendor\laravel\framework\src\Illuminate\Support\Facades\DB;
/**
* 
*/

//require_once('/var/www/html/vendor/laravel/framework/src/Illuminate/Support/Facades/DB.php');
//require_once('/var/www/html/app/ProjetosCancelados.php');
//require_once('/var/www/html/app/User.php');
//require_once('/var/www/html/app/Fase.php');
//require_once('/var/www/html/app/Valor.php');
//require_once('/var/www/html/app/Projeto.php');
//require_once('/var/www/html/app/Indicador.php');
//require_once('/var/www/html/app/FaseProjeto.php');

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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $servername = "localhost";
        $username = "cancelados";
        $password = "12345";
        $banco = "emailusers";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $banco);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected successfully";
        mysqli_close($conn);
    }


    /** 
    * Hith Administration - Alta direção 
    * Request user´s mail to send statistics of level indicators inconsistence level
    * Recupera os emails dos usuários da alta direção no caso de indicador fora de nível
    * @return array 
    */
    public function allUsersMails()
    {
        $servername = "localhost";
        $username = "cancelados";
        $password = "12345";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        //echo "Connected successfully";
        $emailsAltaDirecao = $conn->query("select * from emailusers.mails");
        mysqli_close($conn);
        
        $eMails = array();
        if ( !is_null($emailsAltaDirecao) ){
            foreach ($emailsAltaDirecao as $usermail) {   
                echo($usermail->email."\n\t") ;
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
        $ProjetosCancelados = ProjetosCancelados::select('projetoscancelados.*' )
            ->where('projetoscancelados.data', '=', $date)
            ->get();

       if(!is_null($ProjetosCancelados)){
            echo 'Message has been ProjetosCancelados';
            return $ProjetosCancelados;
       }
       return null;
    }

}
MailMonth::f();






















?>