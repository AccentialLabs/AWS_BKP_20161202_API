<?php

class Mobile extends AppModel {

    var $useTable = false;

    //General query function
    public function executQuery($query) {
        return($this->query($query));
    }

    public function loginUser($name, $pass) {

        $query = "SELECT * FROM users WHERE users.email LIKE '$name' AND users.password LIKE '$pass'";
        return($this->query($query));
    }

    public function getSubClassList($classId) {
        $query = "SELECT * 
            FROM services
            INNER JOIN subclasses ON services.subclasse_id = subclasses.id
                AND subclasses.classe_id = " . $classId . "
            INNER JOIN classes ON subclasses.classe_id = classes.id 
            GROUP BY subclasses.id";
        return($this->query($query));
    }

    public function getBussinessList($subClassId, $search = "") {
        if (!empty($search)) {
            $search = " WHERE companies.fancy_name LIKE '%" . $search . "%'";
        }
        $query = "
            SELECT companies.*
            FROM companies
            INNER JOIN services ON services.companie_id = companies.id
            INNER JOIN subclasses ON subclasses.id = services.subclasse_id
                AND subclasse_id = " . $subClassId . "
            " . $search . "
            GROUP BY companies.id
            ORDER BY companies.fancy_name ASC";
        return($this->query($query));
    }

    public function getServiceDetail($subclassId, $bussinessId, $serviceId = "") {
        if (!empty($serviceId)) {
            $serviceId = " AND services.id = " . $serviceId . " ";
        }
        $query = "SELECT services.*, classes.*, subclasses.*
            FROM companies
            INNER JOIN services ON services.companie_id = companies.id
                AND services.companie_id = $bussinessId $serviceId
            INNER JOIN subclasses ON subclasses.id = services.subclasse_id
                AND subclasse_id = $subclassId
            INNER JOIN classes ON classes.id = subclasses.classe_id";
        return($this->query($query));
    }

    public function getProfessionalList($subclassId, $bussinessId, $serviceId) {
        $query = "SELECT service_secondary_users.*, secondary_users.*, services.*, subclasses.*, companies.*
            FROM services
            INNER JOIN service_secondary_users ON service_secondary_users.service_id = services.id
                    AND services.id = " . $serviceId . " AND services.subclasse_id = " . $subclassId . "
            INNER JOIN secondary_users ON service_secondary_users.secondary_user_id = secondary_users.id
                    AND secondary_users.company_id = " . $bussinessId . "
            INNER JOIN subclasses ON services.subclasse_id = subclasses.id
            INNER JOIN companies ON secondary_users.company_id = companies.id";
        return($this->query($query));
    }

    public function addScheduleForUser($paramsArr) {
        extract($paramsArr);
		
		$serviceDetail = $this->getServiceDetail($subclass_id, $bussiness_id, $service_id);
		
        $serviceInfo = $serviceDetail[0];
        $endTime = date("H:i", strtotime('+' . $serviceInfo['services']['time'] . ' minutes', strtotime($schedule_hour)));
        $query = " INSERT INTO schedules (
            classe_name,
            subclasse_name,
            date,
            service_id,
            time_begin,
            time_end,
            client_name,
            client_phone,
            status,
            valor,
            user_id,
            companie_id,
            secondary_user_id) VALUES (
            '" . $serviceInfo['classes']['name'] . "',
            '" . $serviceInfo['subclasses']['name'] . "',
            '" . $schedule_date . "',
            '" . $service_id . "',
            '" . $schedule_hour . ":00',
            '" . $endTime . ":00',
            '" . $user_name . "',
            '" . $user_phone . "',
            '1',
            '" . $serviceInfo['services']['value'] . "',
            '" . $user_id . "',
            '" . $bussiness_id . "',
            '" . $professional_id . "')";
        return $this->query($query);
    }

}
