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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $servername = "localhost";
        $username = "cancelados";
        //$username = "portifoliogestor";
        $password = "12345";
        //$password = "Cp9a3tvFw7x02ADi";
        //$banco = "emailusers";
        $banco = "portifoliogestor";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $banco);
        
         //echo "Connected successfully";
        $date = date('Ym');        
        /*$ProjetosCancelados = $conn->query("select * from   projetoscancelados WHERE    projetoscancelados.data=". $date);*/
        $sql = 'select * from portifoliogestor.projetoscancelados WHERE portifoliogestor.projetoscancelados.data="'.$date.'"';
        //$sql = 'select * from portifoliogestor.projetoscancelados WHERE data="201801"';
        //$sql = 'select * from statusdoprojeto';
        $projetosColl = $conn->query($sql);
        var_dump('----------projeto-64-------------');
        if ( $projetosColl ){
          while($projeto=mysqli_fetch_object($projetosColl))
          {  
            var_dump($projeto->projeto);
            var_dump($projeto->responsavel);
            var_dump($projeto->status);
            var_dump($projeto->justificativa);
            var_dump($projeto->data);
          }
       }

        //var_dump(' ----------func-76------------- ');
       //$result = $conn->query("select * from portifoliogestor.projetoscancelados WHERE portifoliogestor.projetoscancelados.data=". $date);
        //$result = $conn->query("SHOW FULL TABLES IN portifoliogestor  WHERE TABLE_TYPE LIKE 'VIEW'");
  //*******************************************************************************************
   /*     $result = $conn->query("select * from portifoliogestor.projetoscancelados");
        //$projetos = $conn->query($sql);
        var_dump($result);
        $views =  array();
        if ( $result ){
            foreach ($result as $view) {   
                $views [] = $view;                
            }
        }
        var_dump($views);
    */
    //*******************************************************************************************
       /*if ($result) {
          while($projeto=mysqli_fetch_object($result))
          {
            var_dump($projeto->projeto);
            var_dump($projeto->responsavel);
            var_dump($projeto->status);
            var_dump($projeto->justificativa);
            var_dump($projeto->data);
          }
       }*/
        //return null;
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        //echo "Connected successfully";
        //$sql = "select * from portifoliogestor.mails";
        //$emailsAltaDirecao = $conn->query("select * from emailusers.mails");
        //$emailsAltaDirecao = $conn->query("select * from emailusers.mails");
         var_dump(' ----------func-111------------- ');
        $emailsAltaDirecao = $conn->query("select * from emailusers.mails");
        if($emailsAltaDirecao){
            $eMails = array();
            if ( !is_null($emailsAltaDirecao) ){
                foreach ($emailsAltaDirecao as $usermail) {   
                    $eMails [] = $usermail;
                }
               // return $eMails;
            }
             var_dump($eMails);
        }
        

        //return null;
        //mysqli_close($conn);
        // Create connection
        
 
       
        
        mysqli_close($conn);
    }

}
MailMonth::f();
?>