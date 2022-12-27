<?php
namespace App\Validators;

use DateTime;
use Exception;

class ValidateHoliday
{
    /**
     * Create a new class instance.
     *
     * @return void
     */
    public function __construct(){
        // Exceptional treatment for following holidays
        $this->holidaysMessages = [
            '01/01' => 'Esperamos que esse novo ano lhe traga tudo o que deseja!',
            '12/06' => 'Um feliz dia dos namorados!',
            '24/12' => 'Comemore a chegada do natal com quem você ama!',
            '25/12' => 'Desejamos um feliz natal!',
            '31/12' => 'Aproveite a chegada de um novo ano!'
        ];
    }
    
    /**
     * Receives a date as parameter, check if the date is a holiday and then returns a special message
     * 
     * @param $targetDate target date for which the weekday will be checked
     * 
     * @return array containing operation status, target date and date message
     */
    public function checkForHoliday($targetDate){
        try{
            // Get date and check its day and month
            $dayMonth = $targetDate->format('d/m');
            // Check if date is a holiday, if so, display special message
            if(array_key_exists($dayMonth, $this->holidaysMessages)){
                $returnArray = [
                    'status' => 200,
                    'target' => $targetDate->format('d/m/Y'),
                    'message' => $this->holidaysMessages[$dayMonth]
                ];
            // If not, just return message stating it
            }else{
                $returnArray = [
                    'status' => 400,
                    'target' => $targetDate->format('d/m/Y'),
                    'message' => 'A data não é um feriado.'
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
