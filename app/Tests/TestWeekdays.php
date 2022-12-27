<?php
namespace App\Tests;

global $autoload;
require $autoload;

use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use App\Validators\ValidateWeekday;

class TestWeekdays
{
    /**
     * Goes through each day in current week, check if some of they are holidays, and display the correct message
     * 
     * @return boolean true if tests are successful, false if they've failed
     */
    public function testWeekdays(){
        try{
            // Get current week in a object range to run tests
            $nowDateTimeObject = new DateTime('now');
            $weekFirstDay = $nowDateTimeObject->modify('Last Sunday');   
            $weekFirstDayObject = new DateTime($weekFirstDay->format('Y-m-d'));
            $nextWeekFirstDay = $weekFirstDayObject->modify('Next Sunday');    
            unset($nowDateTimeObject, $weekFirstDayObject);  
            // Get each day of the week as an object
            $interval = new DateInterval('P1D');   
            $weekRange = new DatePeriod($weekFirstDay, $interval, $nextWeekFirstDay);
            $weekdayValidator = new ValidateWeekday();
            // Goes through each day in current week and test it
            foreach($weekRange as $weekDay){
                $weekdayValidation = $weekdayValidator->checkWeekday($weekDay);
                // Check for errors
                if($weekdayValidation['status'] != 200){
                    throw new Exception($weekdayValidation['message']);
                }
                // Echo date and message
                echo "\n\t".$weekdayValidation['target'].': '.$weekdayValidation['message'];
            }
            echo "\n";
            return true;
        }catch(Exception $e){
            // Echo error
            echo "\n\t".'Falha ao testar mensagens semanais. Erro: '."\n\t\t".$e->getMessage()."\n";
            return false;
        }
    }
}
