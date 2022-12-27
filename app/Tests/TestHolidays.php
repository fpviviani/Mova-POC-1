<?php
namespace App\Tests;

global $autoload;
require $autoload;

use DateTime;
use Exception;
use App\Validators\ValidateHoliday;

class TestHolidays
{
    /**
     * Create a new class instance.
     *
     * @return void
     */
    public function __construct(){
        $this->holidays = ['2023-01-01', '2022-06-12', '2022-12-24', '2022-12-25', '2022-12-31'];
    }

    /**
     * Goes through each expected holiday and check if their messages are being displayed correctly
     * 
     * @return boolean true if tests are successful, false if they've failed
     */
    public function testHolidays(){
        try{
            $holidayValidator = new ValidateHoliday();
            // Goes through each date
            foreach($this->holidays as $holiday){
                // Call function that will verify that it's a holiday and display it's message
                $holidayObject = new DateTime($holiday);
                $holidayValidation = $holidayValidator->checkForHoliday($holidayObject);
                // Check for errors
                if($holidayValidation['status'] != 200){
                    throw new Exception($holidayValidation['message']);
                }
                // Echo date and message
                echo "\n\t".$holidayValidation['target'].': '.$holidayValidation['message'];
            }
            echo "\n";
            return true;
        }catch(Exception $e){
            // Echo error
            echo "\n\t".'Falha ao testar mensagens especiais. Erro: '."\n\t\t".$e->getMessage()."\n";
            return false;
        }
    }
}
