<?php

App::uses('EmailsAppController', 'Emails.Controller');
//require("../Vendor/turbo_send_email_code/lib/TurboApiClient.php");

class EmailsController extends AppController  {

    /**
     * Método padrão de toda classe de API.
     * 
     * @see AppController::index()
     */
    public function index() {
        $this->method = 'init';
        return parent::index();
    }

    /**
     * Verifica qual metodo esta sendo solicitado atraves do requestType
     * @return void
     */
    protected function init() {
        switch ($this->requestType) {
            case 'get':
                $this->getData();
                break;
				
			case 'sendTesteEmail':
                $this->sendTesteEmail();
                break;
				
			case 'sendCreatedIndicationEmail':
                $this->sendCreatedIndicationEmail();
                break;
        }
    }

    /**
     * Faz select solicitado com conditions e unbind.
     * @return void
     */
    protected function getData() {
        
        if ($this->findType === 'query') {
            $modelClassName = get_class($this->model);
            $query = $this->requestParams[$modelClassName]['query'];
            $data = $this->Email->executQuery($query);
        } 
        $this->appData = utf8_encode(serialize($data));
    }
	
	protected function sendTesteEmail(){
	
		  if ($this->findType === 'email') {
            $modelClassName = get_class($this->model);
           // $query = $this->requestParams[$modelClassName]['query'];
            $data = $this->Email->sendTeste();
        } 
        $this->appData = utf8_encode(serialize($data));
	
	}
	
	protected function sendCreatedIndicationEmail(){
	
	 if ($this->findType === 'email') {
            $modelClassName = get_class($this->model);
			$dados = '';
			
			
			$dados['destinationEmail'] = $this->requestParams[$modelClassName]['destinationEmail'];
			$dados['nomeSalaoIndicado'] = $this->requestParams[$modelClassName]['nomeSalaoIndicado'];
			$dados['nomeCliente'] = $this->requestParams[$modelClassName]['nomeCliente'];
			$dados['generoSeuouSua'] = $this->requestParams[$modelClassName]['generoSeuouSua'];
			$dados['generoEleouEla'] = $this->requestParams[$modelClassName]['generoEleouEla'];
			$dados['generoOouA'] = $this->requestParams[$modelClassName]['generoOouA'];
			$dados['codigoIndicacao'] = $this->requestParams[$modelClassName]['codigoIndicacao'];
			

           // $query = $this->requestParams[$modelClassName]['query'];
            $data = $this->Email->createdIndication($dados);
        } 
        $this->appData = utf8_encode(serialize($data));
	}
}
