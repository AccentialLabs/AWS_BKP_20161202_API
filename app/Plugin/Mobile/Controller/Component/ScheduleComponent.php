<?php

class ScheduleComponent extends Component {

    function __construct() {
        $this->Mobile = ClassRegistry::init('Mobile');
    }

    public function getFreeTimeFromSecundaryUser($paramsArr) {
        $serviceInfo = $this->getServiceTime($paramsArr['subclass_id'], $paramsArr['bussiness_id']);
        $profissionalSchedule = $this->getSchedulesFromUser($paramsArr['professional_id'], $paramsArr['schedule_date']);
        return $this->breakSchedule($serviceInfo['time'], $serviceInfo['interval'], $profissionalSchedule);
    }

    private function getServiceTime($subclass_id, $bussiness_id) {
        $query = "SELECT services.time, companies.schedule_begin,  companies.schedule_end
	FROM companies
	INNER JOIN services ON services.companie_id = companies.id
		AND services.companie_id = " . $bussiness_id . "
	INNER JOIN subclasses ON subclasses.id = services.subclasse_id
			AND subclasse_id = " . $subclass_id;

        $returnArr['time'] = $this->Mobile->executQuery($query)[0]['services']['time'];
        $returnArr['interval'][] = $this->Mobile->executQuery($query)[0]['companies']['schedule_begin'] . "-" . $this->Mobile->executQuery($query)[0]['companies']['schedule_end'];
        return $returnArr;
    }

    private function getSchedulesFromUser($secundaryUserId, $date) {
        $query = "SELECT schedules.* 
            FROM schedules
            WHERE schedules.secondary_user_id = " . $secundaryUserId . "
                AND schedules.date = '" . substr($date, 0, 10) . "'
            ORDER BY schedules.time_begin ASC";
        $hourList = array();
        foreach ($this->Mobile->executQuery($query) as $schedule) {
            $hourList[] = $schedule['schedules']['time_begin'] . "-" . $schedule['schedules']['time_end'];
        }
        return $hourList;
    }

    private function breakSchedule($duration, $arrInterval, $arrSchudule) {
        $defaultbreakTime = 15;
        $timeInterval = array();
        foreach ($arrInterval as $interval) {
            $hourBegin = new DateTime(explode("-", $interval)[0]);
            $hourEnd = new DateTime(explode("-", $interval)[1]);
            while ($hourBegin < $hourEnd) {
                $timeInterval[] = $hourBegin->format('H:i:s');
                date_add($hourBegin, date_interval_create_from_date_string($defaultbreakTime . ' minutes'));
            }
        }
        foreach ($arrSchudule as $schedule) {
            $hourBegin = new DateTime(explode("-", $schedule)[0]);
            $hourEnd = new DateTime(explode("-", $schedule)[1]);
            date_sub($hourBegin, date_interval_create_from_date_string($duration . ' minutes'));
            foreach ($timeInterval as $key => $time) {
                $possibleSchedule = new DateTime($time);
                if ($hourBegin <= $possibleSchedule && $possibleSchedule < $hourEnd) {
                    unset($timeInterval[$key]);
                }
            }
        }
        return array_values($timeInterval);
    }

}
