<?php
namespace App\Tests;

global $autoload;
require $autoload;

use App\Tests\TestHolidays;
use App\Tests\TestWeekdays;

class TestController{

    /**
     * Test weekdays messages
     * 
     * @return void
     */
    public function testWeekdayMessages(){
        // Test weekdays messages
        echo "\n".'Testando as mensagens semanais, para cada dia da semana atual:'."\n";
        $weekdaysTester = new TestWeekdays();
        $weekdaysTester->testWeekdays();
        echo"\n".'Teste concluído com sucesso!';
    }

    /**
     * Test holidays messages
     * 
     * @return void
     */
    public function testHolidaysMessages(){
        // Test holiday messages
        echo "\n".'Testando as mensagens especiais, para cada feriado abrangido:'."\n";
        $holidaysTester = new TestHolidays();
        $holidaysTester->testholidays();
        echo"\n".'Teste concluído com sucesso!'."\n";
    }
}
