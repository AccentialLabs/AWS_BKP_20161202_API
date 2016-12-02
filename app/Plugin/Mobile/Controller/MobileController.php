<?php 
ini_set('default_charset', 'UTF-8');
App::uses('MobileAppController', 'Mobile.Controller');

class MobileController extends AppController {

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
            case 'login':
                $this->getLogin();
                break;
            case 'subclass':
                $this->getSubclass();
                break;
            case 'bussiness':
                $this->getBussiness();
                break;
            case 'get':
                $this->getData();
                break;
            
            case 'getTeste':
                $this->getDataTeste();
            
            case 'service':
                $this->getService();
                break;
            case 'schedule':
                $this->getSchedule();
                break;
            case 'profissional':
                $this->getProfissional();
                break;

 	    case 'testando' :
                $this->testandoQuery();
                break;
        }
    }

    protected function getLogin() {
//        $modelClassName = get_class($this->model);
        if ($this->findType === 'action') {
            // => usando o padrão do cake2
            $this->loadModel('User');
			$property =  $this->requestParams['Mobile']['property'];
			
            $user = $this->User->find('first', array(
                'conditions' => array('User.email' => $property['login'], 'User.password' => md5( $property ['pass']))
            ));
            if (isset($user['User']['id']) && $user['User']['id'] > 0) {
                $user['User']['password'] = "";
                $returnArr = array('cod' => 0, 'msg' => $user);
				
				
            } else {
                $returnArr = array('cod' => 1, 'msg' => "Login ou senha invalido.");
            }
            // => metodo usando a classe do modulo
//            $user = $this->Mobile->loginUser('matheusodilon0@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');
        } else {
            $returnArr = array('cod' => 2, 'msg' => "Login ou senha invalido.");
        }
	echo utf8_encode(json_encode($returnArr));

        exit();
    }

    protected function getSubclass() {
        if ($this->findType === 'get') {
            $subClassList = $this->Mobile->getSubClassList($this->requestParams['Mobile']['property']['class']);
            $this->utf8_encode_deep($subClassList);
            $returnArr = array('cod' => 0, 'msg' => $subClassList);
        } else {
            $returnArr = array('cod' => 1, 'msg' => "Não foi possivel realizar sua requisição.");
        }
        echo json_encode($returnArr);
        exit();
    }

    protected function getBussiness() {
        if ($this->findType === 'get') {
            $subClassList = $this->Mobile->getBussinessList($this->requestParams['Mobile']['property']['subclass_id'], $this->requestParams['Mobile']['property']['search']);
            $arrOrderCopany = array();
            foreach ($subClassList as $company) {
                $company['companies']['description'] = utf8_encode($company['companies']['description']);
                $company['companies']['fancy_name'] = utf8_encode($company['companies']['fancy_name']);
                $arrOrderCopany[strtoupper(substr($company['companies']['fancy_name'], 0, 1))][] = $company['companies'];
            }
            $returnArr = array('cod' => 0, 'msg' => $arrOrderCopany);
        } else {
            $returnArr = array('cod' => 1, 'msg' => "Não foi possivel realizar sua requisição.");
        }
        echo json_encode($returnArr);
        exit();
    }

    protected function getService() {
        if ($this->findType === 'detail') {
            $subClassList = $this->Mobile->getServiceDetail($this->requestParams['Mobile']['property']['subclass_id'], $this->requestParams['Mobile']['property']['bussiness_id']);
            $this->utf8_encode_deep($subClassList);
            $returnArr = array('cod' => 0, 'msg' => $subClassList);
        } else {
            $returnArr = array('cod' => 1, 'msg' => "Não foi possivel realizar sua requisição.");
        }
        echo json_encode($returnArr);
        exit();
    }

    protected function getSchedule() {
        if ($this->findType === 'get') {
            require('Component/ScheduleComponent.php');
            $cheduleController = new ScheduleComponent();
            $freeTime = $cheduleController->getFreeTimeFromSecundaryUser($this->requestParams['Mobile']['property']);
            $returnArr = array('cod' => 0, 'msg' => $freeTime);
        } else {
            if ($this->findType === 'set') {
                if($this->Mobile->addScheduleForUser($this->requestParams['Mobile']['property']) !== false){
                    $returnArr = array('cod' => 0, 'msg' => "true");
                }else{
                    $returnArr = array('cod' => 2, 'msg' => "Não foi possivel salvar o agendamento.");
                }
            } else {
                $returnArr = array('cod' => 1, 'msg' => "Não foi possivel realizar sua requisição.");
            }
        }
        echo json_encode($returnArr);
        exit();
    }

    protected function getProfissional() {
        if ($this->findType === 'get') {
            $profissionalList = $this->Mobile->getProfessionalList($this->requestParams['Mobile']['property']['subclass_id'], $this->requestParams['Mobile']['property']['bussiness_id'], $this->requestParams['Mobile']['property']['service_id']);
            $this->utf8_encode_deep($profissionalList);
            $returnArr = array('cod' => 0, 'msg' => $profissionalList);
        } else {
            $returnArr = array('cod' => 1, 'msg' => "Não foi possivel realizar sua requisição.");
        }
        echo json_encode($returnArr);
        exit();
    }

    protected function getData() {

        if ($this->findType === 'query') {
            $modelClassName = get_class($this->model);
            $query = $this->requestParams[$modelClassName]['query'];
            $data = $this->General->executQuery($query);
        }
        $this->appData = utf8_encode(serialize($data));
    }

    private function utf8_encode_deep(&$input) {
        if (is_string($input)) {
            $input = utf8_encode($input);
        } else if (is_array($input)) {
            foreach ($input as &$value) {
                $this->utf8_encode_deep($value);
            }
            unset($value);
        } else if (is_object($input)) {
            $vars = array_keys(get_object_vars($input));
            foreach ($vars as $var) {
                $this->utf8_encode_deep($input->$var);
            }
        }
    }
    
     /**
     * Faz select solicitado com conditions e unbind.
     * @return void
     */
    protected function getDataTeste() {
      if ($this->findType === 'query') {
          
           $this->loadModel('Mobile');
          
            $modelClassName = get_class($this->model);
            $query = $this->requestParams[$modelClassName]['query'];
            $data = $this->Mobile->executQuery("select * from users;");
        }
        $this->appData = utf8_encode(serialize($data));
    }

  protected function testandoQuery(){
        $this->appData = $this->Mobile->query("select * from services;");
    }

}
