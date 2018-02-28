<?php
//namespace App\Mail\app\Mail;
require_once('/usr/share/php/libphp-phpmailer/autoload.php');
require_once('/usr/share/php/libphp-phpmailer/PHPMailerAutoload.php');
require_once('/usr/share/php/libphp-phpmailer/class.phpmailer.php');
require_once('/usr/share/php/libphp-phpmailer/class.smtp.php');
//use DateTime;

//class MailMonth extends Mailable
class MailMonth 
{
    static $servername = "localhost";
    static $username = "cancelados";
    static $password = "12345";
    static $banco = "portifoliogestor";
    // Create connection
    static $conn = false;
    static $Mails = array();
    static $projetosCollection = array();

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        echo "myClass init'ed successfuly!!!";
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
        //
        self::$conn = mysqli_connect(self::$servername, self::$username, self::$password, self::$banco);
        // Check connection
        if (!self::$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

      
        ini_set('max_execution_time', 60);
        # Recupera os projetos cncelados
        $verificar = self::verificarProjetosCanceladosNoPeriodo();
        # variável para a colecao de emails
        $UsersMails = null;
        # variável para o retorno do arquivo
        $Arquivo = null;        
        if ( !is_null($verificar) ){
            $projetosCollection = $verificar;
            # realiza a recuperação dos emails
            $UsersMails = self::allUsersMails();
            if ( !is_null($UsersMails) ){
                $Mails = $UsersMails;
                # realiza a operação de gerar o arquivo
                $Arquivo = self::gerarArquivo($verificar);
            }
        }
       
        /*
        # se arquivo retornou diferente de null enviar email
        if ( !is_null($Arquivo) ){
            //$OUTRO = self::sendEmail($verificar);   
            
            // Inclui o arquivo class.phpmailer.php localizado na pasta class
            $mail = new PHPMailer(true);
            $name = "Portifoliogestor";
            //$phone = $_POST['phone'];
            $email = "nao-responda@portifoliogestor.com";
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
            //$mail->addAddress('contato@portifoliogestor.com');  // Name is optional            
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
            foreach ($OUTRO as $CcMail) {
                $mail->AddAddress($CcMail);
            }
            $filename = '/var/www/html/public/storage/relatorio.txt';
            $mail->AddAttachment('/var/www/html/public/storage/relatorio.txt', $name = 'relatorio.txt',
            $encoding = 'base64', $type = 'application/txt');        // Add attachments
            if (file_exists($filename)) {
               #$mail->AddAttachment('/var/www/html/public/storage/relatorio.txt', $name = 'relatorio.txt',
                    $encoding = 'base64', $type = 'application/txt');

                $mail->AddAttachment('/var/www/html/public/storage/relatorio.txt', $name = 'relatorio.txt',
                    $encoding = 'base64', $type = 'txt');
            }
            if(!$mail->send()) {
                echo 'A mensagem não foi enviada.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'A mensagem foi enviada';
                //header('Location: thankyou.html');
            }
        }else{
            //$OUTRO = self::sendEmail($verificar);   
            
            $mail = new PHPMailer(true);
            $name = "Portifoliogestor";
            //$phone = $_POST['phone'];
            $email = "nao-responda@portifoliogestor.com";
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
            //$mail->addAddress('contato@portifoliogestor.com');  // Name is optional            
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
            $mail->MsgHTML("Não foram encontrados projetos cancelados neste período!");
            foreach ($UsersMails as $CcMail) {
                $mail->AddAddress($CcMail);
            }
            
            if(!$mail->send()) {
                echo 'A mensagem não foi enviada.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'A mensagem foi enviada';
                //header('Location: thankyou.html');
            }
        }
        echo "\n\t";
        */
        mysqli_close(self::$conn);
    }
    /** 
    * Hith Administration - Alta direção 
    * Request user´s mail to send statistics of level indicators inconsistence level
    * Recupera os emails dos usuários da alta direção no caso de indicador fora de nível
    * @return array 
    */
    public function allUsersMails()
    {
        # verify if exists value in table and return values array
        $emailsAltaDirecao = self::$conn->query("select * from emailusers.mails");
        if($emailsAltaDirecao){
            //var_dump('----allUsersMails 155------');
            $eMails = array();
            if ( !is_null($emailsAltaDirecao) ){
                foreach ($emailsAltaDirecao as $usermail) {   
                    $eMails [] = $usermail;
                }
                //var_dump($eMails);
                return $eMails;
            }
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
        /*$ProjetosCancelados = $conn->query("select * from   projetoscancelados WHERE    projetoscancelados.data=". $date);*/
        $sql = 'select * from portifoliogestor.projetoscancelados WHERE portifoliogestor.projetoscancelados.data="'.$date.'"';
        $projetosCancelados = self::$conn->query($sql);
        //var_dump('----verificarProjetosCanceladosNoPeriodo 178------');
        //var_dump($projetosCancelados);
        if($projetosCancelados){
                if(!is_null($projetosCancelados) && sizeof($projetosCancelados) > 0){
                    return $projetosCancelados;
                }
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
        error_reporting(E_ALL);
        $t = "";
        $t .= "\n\t". PHP_EOL;
        $t .= "--------------------".date('d/m/Y H:i:s')."----------------------". PHP_EOL;
        $t .= "\n\t". PHP_EOL;
        $t .= "\t\tRELATÓRIO DOS PROJETOS CANCELADOS NO PERÍODO". PHP_EOL;
        $t .= "\n\t". PHP_EOL;
        foreach($ProjetosCancelados as $key => $projeto){
            $t .= "-----------------------------------------------------------------". PHP_EOL;
            $t .= "\n\t". PHP_EOL;
            $t .= "PROJETO:\t". utf8_decode($projeto['projeto']). PHP_EOL;
            $t .= "\n\t". PHP_EOL;
            $t .= "-----------------------------------------------------------------". PHP_EOL;
            $t .= "\n\t". PHP_EOL;
            $t .= "RESPONSÁVEL:\t" .$projeto['responsavel']. PHP_EOL; 
            $t .= "\n\t". PHP_EOL; 
            $t .= "STATUS:     \t" .$projeto['status']. PHP_EOL; 
            $t .= "\n\t". PHP_EOL;
            $t .= "JUSTIFICATIVA:\t" .utf8_decode($projeto['justificativa']). PHP_EOL; 
            $t .= "\n\t". PHP_EOL;
            $t .= "ANO/MES:    \t" .$projeto['data']. PHP_EOL; 
            $t .= "\n\t". PHP_EOL;
            $t .= "". PHP_EOL;
            $t .= "\n\t". PHP_EOL;
            $t .= "-----------------------------------------------------------------". PHP_EOL;
            $t .= "\n\t". PHP_EOL;
        }#foreach
        #-----------------escreve no arquivo relatorio.txt-----------------------     
        $filename = '/var/www/html/public/storage/relatorio.txt';
        if (file_exists($filename)) {
            $oldfile = fopen("/var/www/html/public/storage/relatorio.txt", "w") or die("Falha ao abrir arquivo de relarorio!");
            fwrite($oldfile, $t);
            fclose($oldfile);
        }
         #-----------------cria e escreve no arquivo relatorio.txt----------------------- 
        $fileName = 'relatorio';
        $newFileName = '/var/www/html/public/storage/'.$fileName.".txt";
        if (file_put_contents($newFileName, $t) !== false) {
            echo "Arquivo criado com sucesso (" . basename($newFileName) . ") ";
        } else {
            echo "Nao pode criar o arquivo (" . basename($newFileName) . ") ";
        }
       return $ProjetosCancelados;
    }
    /**
    * Envia email ao menbro da alta direção
    * @param Request
    * @return array
    **/
    public function sedEmail($ProjetosCancelados){

    }

}
MailMonth::f();

$nn = MailMonth::$projetosCollection;
var_dump($nn);

//$mailMonth = new MailMonth();
foreach(MailMonth::$projetosCollection as $key => $projeto){
                echo("PROJETO:\t". utf8_decode($projeto['projeto']));
                echo("\n\t");
                echo("RESPONSÁVEL:\t" .$projeto['responsavel']);
                echo("\n\t"); 
                echo("STATUS:     \t" .$projeto['status']); 
                echo("\n\t");
                echo("JUSTIFICATIVA:\t" .utf8_decode($projeto['justificativa'])); 
                echo("\n\t");
                echo("ANO/MES:    \t" .$projeto['data']); 
                echo("\n\t");
                echo("");
                echo("\n\t");
                echo("-----------------------------------------------------------------");
                echo("\n\t");
            }#foreach

/*
# se arquivo retornou diferente de null enviar email
      
            //$OUTRO = self::sendEmail($verificar);   
         
            // Inclui o arquivo class.phpmailer.php localizado na pasta class
            $mail = new PHPMailer(true);
            $name = "Portifoliogestor";
            //$phone = $_POST['phone'];
            $email = "nao-responda@portifoliogestor.com";
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
            //$mail->addAddress('contato@portifoliogestor.com');  // Name is optional            
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
            $mail->MsgHTML("\n\t");
            $mail->MsgHTML("--------------------".date('d/m/Y H:i:s')."----------------------");
            $mail->MsgHTML("\n\t");
            $mail->MsgHTML("\t\tRELATORIO DOS PROJETOS CANCELADOS NO PERIODO");
            $mail->MsgHTML("\n\t");
            foreach(MailMonth::$projetosCollection as $key => $projeto){
                $mail->MsgHTML("PROJETO:\t". utf8_decode($projeto['projeto']));
                $mail->MsgHTML("\n\t");
                $mail->MsgHTML("RESPONSÁVEL:\t" .$projeto['responsavel']);
                $mail->MsgHTML("\n\t"); 
                $mail->MsgHTML("STATUS:     \t" .$projeto['status']); 
                $mail->MsgHTML("\n\t");
                $mail->MsgHTML("JUSTIFICATIVA:\t" .utf8_decode($projeto['justificativa'])); 
                $mail->MsgHTML("\n\t");
                $mail->MsgHTML("ANO/MES:    \t" .$projeto['data']); 
                $mail->MsgHTML("\n\t");
                $mail->MsgHTML("");
                $mail->MsgHTML("\n\t");
                $mail->MsgHTML("-----------------------------------------------------------------");
                $mail->MsgHTML("\n\t");
            }#foreach
            $emailusers = MailMonth::$Mails;
            foreach ($emailusers as $CcMail) {
                $mail->AddAddress($CcMail);
            }
            $filename = '/var/www/html/public/storage/relatorio.txt';
            $mail->AddAttachment('/var/www/html/public/storage/relatorio.txt', $name = 'relatorio.txt',
            $encoding = 'base64', $type = 'application/txt');        // Add attachments
            if (file_exists($filename)) {
                #$mail->AddAttachment('/var/www/html/public/storage/relatorio.txt', $name = 'relatorio.txt',$encoding = 'base64', $type = 'application/txt');

                $mail->AddAttachment('/var/www/html/public/storage/relatorio.txt', $name = 'relatorio.txt',
                    $encoding = 'base64', $type = 'txt');
            }
            if(!$mail->send()) {
                echo 'A mensagem não foi enviada.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'A mensagem foi enviada';
                //header('Location: thankyou.html');
            }

   


     
            
   */
        
    
        
        



?>