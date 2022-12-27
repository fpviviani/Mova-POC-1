<?php

require __DIR__.'/index.php';

use App\Tests\TestController;
use App\Validators\ValidateWeekday;

displayConsole();

/**
 * Display console to get user choices
 * 
 * @return void
 */
function displayConsole(){
    try{
        $userChoice = 0;
        $availableOptions = ['1', '2', '3', '4'];
        // Stay in console while user doesn't type to quit
        while($userChoice != 4){
            echo "\n".'Bem vindo!';
            echo "\n".'Escolha uma das opções a seguir:'."\n";
            echo "\n\t".'1 - Receba a mensagem de hoje.';
            echo "\n\t".'2 - Insira uma data e receba a mensagem dela.';
            echo "\n\t".'3 - Testar funções.';
            echo "\n\t".'4 - Sair.'."\n\n";
            $userChoice = (int)readline('Sua escolha: ');
            // Clear console
            echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
            echo '----------------------';
            switch($userChoice){
                case 1:
                case 2:
                    if($userChoice == 2){
                        echo "\n\n";
                        $userDate = (string)readline('Insira uma data no formato d/m/Y: ');
                        if (DateTime::createFromFormat('d/m/Y', $userDate) == false) {
                            echo "\n".'Data inválida. Por favor, digite novamente.';
                            sleep(2);
                            break;
                        }
                    }
                    // Get date (from user input or today) and display a message for it
                    $dateTimeObject = ($userChoice == 1) ? new DateTime('now') : DateTime::createFromFormat('d/m/Y', $userDate);
                    $weekdayValidation = checkUserDate($dateTimeObject);
                    // Check for errors
                    if($weekdayValidation['status'] != 200){
                        throw new Exception($weekdayValidation['message']);
                    }
                    // Echo date and message
                    echo $weekdayValidation['message'];
                    sleep(3);
                    break;
                case 3:
                    // Display console with test options
                    displayTestConsole();
                    break;
                case 4:
                    break;
                default:
                    echo "\n".'Opção inválida. Por favor, tente novamente.';
                    sleep(2);
                    break;
            }
            echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
        }
    }catch(Exception $e){
        // Echo error
        echo "\n\t\t".'Erro de execução. '.$e->getMessage();
    }
}

/**
 * Display console to get user choices about tests
 * 
 * @return void
 */
function displayTestConsole(){
    try{
        $userChoice = 0;
        // Stay in console while user doesn't type to quit
        while($userChoice != 4){
            $testController = new TestController();
            echo "\n\n".'Escolha uma das opções a seguir:'."\n";
            echo "\n\t".'1 - Testar mensagens semanais.';
            echo "\n\t".'2 - Testar mensagens de datas especiais.';
            echo "\n\t".'3 - Testar todas as mensagens.';
            echo "\n\t".'4 - Voltar.'."\n\n";
            $userChoice = (int)readline('Sua escolha: ');
            // Clear console
            echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
            echo '----------------------';
            switch($userChoice){
                case 1:
                    // Run weekday messages tests
                    $testController->testWeekdayMessages();
                    break;
                case 2:
                    // Run holiday messages tests
                    $testController->testHolidaysMessages();
                    break;
                case 3:
                    // Run both messages types tests
                    $testController->testWeekdayMessages();
                    $testController->testHolidaysMessages();
                    break;
                case 4:
                    break;
                default:
                    echo "\n".'Opção inválida. Por favor, tente novamente.';
                    sleep(2);
                    echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
                    break;
            }
            echo "\n".'----------------------';
        }
    }catch(Exception $e){
        echo "\n\t\t".$e->getMessage();
    }
}

/**
 * Check respective message to user target date
 * 
 * @param $targetDate target date for which the weekday will be checked
 * 
 * @return array containing operation status, target date and date message
 */
function checkUserDate($targetDate){
    try{
        echo "\n".'Checando a data escolhida:'."\n";
        // Checking target date weekday (and therefore, if it is a holiday)
        $weekdayValidator = new ValidateWeekday();
        $weekdayValidation = $weekdayValidator->checkWeekday($targetDate);
        // Check for errors
        if($weekdayValidation['status'] != 200){
            throw new Exception($weekdayValidation['message']);
        }
        // Return date and message
        $returnArray = [
            'status' => 200,
            'target' => $targetDate->format('d/m/Y'),
            'message' => "\n\t".$weekdayValidation['target'].': '.$weekdayValidation['message']."\n"
        ];
        return $returnArray;
    }catch(Exception $e){
        // Return date and error message
        $returnArray = [
            'status' => 500,
            'target' => $targetDate->format('d/m/Y'),
            'message' => 'Falha ao checar informações sobre a data. '."\n\t\t".$e->getMessage()
        ];
        return $returnArray;
    }
}
