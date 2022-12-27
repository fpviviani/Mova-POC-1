<?php
namespace App\Validators;

use DateTime;
use Exception;

class ValidateWeekday
{
    /**
     * Create a new class instance.
     *
     * @return void
     */
    public function __construct(){
        // Messages for each respective weekday
        $this->weekdaysMessages = [
            'Sunday' => 'Que você tenha um ótimo domingo!',
            'Monday' => 'Desejamos um início de semana muito produtivo! Boa segunda-feira.',
            'Tuesday' => 'Hoje é terça-feira, um maravilhoso dia para você!',
            'Wednesday' => 'O meio da semana chegou. Uma boa quarta-feira!',
            'Thursday' => 'A semana está quase acabando. Tenha uma ótima quinta-feira!',
            'Friday' => 'Aproveite o seu final de semana. Uma sexta-feira muito boa para você!',
            'Saturday' => 'Desfrute de seu sábado, descanse!',
        ];
    }

    /**
     * Receives a date as parameter, check the respective weekday, check if date is a holiday, and returns respective message
     * 
     * @param $targetDate target date for which the weekday will be checked
     * 
     * @return array containing operation status, target date and date message
     */
    public function checkWeekday($targetDate){
        try{
            // Check date weekday
            $weekday = $targetDate->format('l');
            // Check if date is also a holiday, if so, display special message
            $holidayValidator = new ValidateHoliday();
            $holidayValidation = $holidayValidator->checkForHoliday($targetDate);
            if($holidayValidation['status'] == 200){
                $returnArray = [
                    'status' => 200,
                    'target' => $targetDate->format('d/m/Y'),
                    'message' => $holidayValidation['message']
                ];
            // If not an holiday, display regular weekday message
            }else{
                $returnArray = [
                    'status' => 200,
                    'target' => $targetDate->format('d/m/Y'),
                    'message' => $this->weekdaysMessages[$weekday]
                ];
            }
            return $returnArray;
        }catch(Exception $e){
            // Return error message
            $returnArray = [
                'status' => 500,
                'target' => $targetDate->format('d/m/Y'),
                'message' => $e->getMessage()
            ];
            return $returnArray;
        }
    }
}
