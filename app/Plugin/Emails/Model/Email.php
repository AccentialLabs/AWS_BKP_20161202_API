<?php

//require "../Vendor/turbo_send_email_code/lib/TurboApiClient.php";
App::import('Vendor', 'TurboSendEmail', array('file' => 'turbo_send_email_code/lib/TurboClient.php'));

class Email extends AppModel {

    var $useTable = false;

    //General query function
    public function executQuery($query) {
        return($this->query($query));
    }
	
	
	public function sendTeste(){
	
		return($this->sendEmailByPOST("esse e o corpo do email teste", "matheusodilon0@gmail.com", "SUBJECT"));
	
	}
	
	public function createdIndication($dados = null){
	
	
	$body = '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><table style="background: #f2f2f2; font-family: Helvetica, Arial, sans-serif;" id="Table_01" width="800" height="2311" border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_01.jpg" width="800" height="233" alt=""></td>
</tr>
<tr>
<td colspan="8" style="background: #f2f2f2; text-align: center;padding-left:8%;padding-right:8%;">
<br>
<p style="color:rgb(154, 152, 51); font-size: 26px; font-family: Helvetica, Arial, sans-serif; font-style: italic;">Parabéns <br />'.$dados ['nomeSalaoIndicado'].'!</p>
<p style="color:rgb(154, 152, 51); font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-style: italic;">'.$dados ['generoSeuouSua'].' cliente '.$dados ['nomeCliente'].' lhe convidou para fazer parte<br />
da melhor plataforma de Salões de Beleza do Brasil!</p>
<p style="color:#2597AC;font-size: 13px;font-family: Helvetica, Arial, sans-serif;">'.$dados['generoEleouEla'].' já utiliza o Jezzy e gostaria que seu salão também utilizasse.</p>
<p align="justify" style="color:#9B9B9B;font-size: 16px;font-family: Helvetica, Arial, sans-serif;text-align:justify;">
Para começar a usar hoje mesmo o Jezzy, basta se cadastrar em nosso site.<br/>
Para isso, clique no botão abaixo ou copie e cole o endereço <br /><font style="color:#2597AC;">"https://secure.jezzy.com.br/jezzy-portal/company/register"</font><br/> no seu navegador. Ah! Não se esqueça de mencionar '.$dados ['generoOouA'].' <b>'.$dados ['nomeCliente'].'</b> como a pessoa que lhe indicou, ok?</p><br>
</td>
</tr>
<tr>
<td colspan="3" rowspan="2">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_03.jpg" width="195" height="173" alt=""></td>
<td colspan="4">
<a href="https://secure.jezzy.com.br/jezzy-portal/company/register"><img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_04.jpg" width="416" height="75" alt=""></a></td>
<td rowspan="2">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_05.jpg" width="189" height="173" alt=""></td>
</tr>
<tr>
<td colspan="4" style="background: #f2f2f2; text-align: center;height:50%;">
<font style="color:#9B9B9B;font-size:3vh;font-family: Helvetica, Arial, sans-serif;">Indicado por: </font><font style="color:#2597AC;font-size:3vh;font-family:"Open Sans";text-transform:uppercase;">'.$dados ['nomeCliente'].'</font><br>
<font style="color:#9B9B9B;font-size:3vh;font-family: Helvetica, Arial, sans-serif;">Código da Indicação:</font><font style="color:#2597AC;font-size:3vh;font-family:"Open Sans";text-transform:uppercase;">'.$dados ['codigoIndicacao'].'</font>
</td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_07.jpg" width="800" height="158" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_08.jpg" width="800" height="129" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_09.jpg" width="800" height="150" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_10.jpg" width="800" height="149" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_11.jpg" width="800" height="67" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_12.jpg" width="800" height="96" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_13.jpg" width="800" height="88" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_14.jpg" width="800" height="102" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_15.jpg" width="800" height="94" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_16.jpg" width="800" height="102" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_17.jpg" width="800" height="71" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_18.jpg" width="800" height="5" alt=""></td>
</tr>
<tr>
<td rowspan="2">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_19.jpg" width="93" height="155" alt=""></td>
<td colspan="3">
<a href="https://secure.jezzy.com.br/jezzy-portal/company/register"><img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_20.jpg" width="206" height="109" alt=""></a></td>
<td colspan="4" style="background: #f2f2f2; text-align: justify;padding-left:8%;padding-right:8%;">
<font style="color:#9B9B9B;font-size:2.3vh;font-family:\'Open Sans\';">Tudo bem, nós estamos aqui para isso! :)</font><br>
<font style="color:#9B9B9B;font-size:2.3vh;font-family:\'Open Sans\';">Você pode acessar nosso site sobre o Jezzy Empresas clicando <a href="http://www.jezzy.com.br/site/jezzy-para-saloes/" style="color:#2597AC;font-size:2.3vh;font-family:\'Open Sans\;">aqui</a>, enviar um email para nós contando as suas dúvidas (<font style="color:#2597AC;font-size:2.3vh;font-family:\'Open Sans\';">contato@jezzy.com.br</font>), ou ligando para nossa equipe no telefone <font style="color:#2597AC;font-size:2.3vh;font-family:\'Open Sans\';">11 3142-9776</font></font>
</td>
</tr>
<tr>
<td colspan="3">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_22.jpg" width="206" height="46" alt="">
</td>
<td colspan="5" style="background: #f2f2f2;">
</td>
</tr>
<tr>
<td colspan="2">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_23.jpg" width="184" height="95" alt=""></td>
<td colspan="3">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_24.jpg" width="216" height="95" alt=""></td>
<td>
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_25.jpg" width="198" height="95" alt=""></td>
<td colspan="2">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_26.jpg" width="202" height="95" alt=""></td>
</tr>
<tr>
<td colspan="8">
<img src="https://secure.jezzy.com.br/uploads/Emails/files/indications/Jezzy---Email---Indicacao-de-Salao---v1_27.jpg" width="800" height="79" alt=""></td>
</tr>
</table>';
	
	return($this->sendEmailByPOST($body, $dados['destinationEmail'], "Já conhece o Jezzy???")); 
	
	
	}
	
	public function sendEmailByPOST($emailBody, $emailAddress, $subject){
		
		
		$url = 'https://api.turbo-smtp.com/api/mail/send';

$data = array('authuser' => "contato@jezzy.com.br", 'authpass' => "09#pLk#3}KgS", 'from' => "contato@jezzy.com.br", 'to' => $emailAddress, 'subject' => $subject, 'html_content' => $emailBody);

$options = array(
        'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
		$context  = stream_context_create($options);
		$result = json_decode(file_get_contents($url, false, $context));





          // Exibe uma mensagem de resultado
          if ($result->message == "OK") {

               //ENVIADO
			   echo "enviado";

          } else {

              //NÃO ENVIADO
			  echo "nao enviado";
		}
		
		
		}

}
