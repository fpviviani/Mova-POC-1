# Visão geral

Desenvolva um programa que exiba uma mensagem diferente para cada dia da
semana, usando o padrão Strategy. Pense que em datas especiais, podemos ter alguma
variação.

# Inicialização

Para abrir o programa, vá até a pasta raiz por um terminal e execute o arquivo `Run.php`.<br/>
Será exibido um <i>display</i> para o usuário escolher algumas opções.<br/>
As opções estão descritas na seguinte tabela: 

| Opção | Descrição |
|-----:|---------------|
|     1|Receber a mensagem para o dia de hoje.|
|     2|Receber a mensagem para uma data específica.|
|     3|Rodar testes.|
|     4|Sair.|

## Opção 1

Ao escolher a opção 1, o usuário será apresentado à mensagem pertinente ao dia presente.<br/>
Se o dia for um feriado, a mensagem será referente ao feriado; caso não, se referenciará ao dia da semana.

## Opção 2

Ao escolher a opção 2, o usuário será apresentado a um input no terminal, que solicitará para o mesmo digitar uma data.<br/>
Após escolher uma data, a mensagem pertinente ao dia será demonstrada.<br/>
Se o dia for um feriado, a mensagem será referente ao feriado; caso não, se referenciará ao dia da semana.

## Opção 3

Ao escolher a opção 3, o usuário será apresentado a um novo <i>display</i>, com novas opções, referentes aos testes.<br/>

| Opção | Descrição |
|-----:|---------------|
|     1|Testar mensagens semanais.|
|     2|Testar mensagens de datas especiais.|
|     3|Testar todas as mensagens.|
|     4|Voltar|

###### Opção 3.1

Ao escolher esta opção, o usuário rodará o código pertinente por testar as mensagens referentes aos dias da semana.<br/>
O programa escolherá a semana atual, e exibirá a mensagem para cada dia dessa semana.<br/>
Vale salientar que, se algum dia dessa semana for feriado, a mensagem exibida será a mensagem especial de feriado.

###### Opção 3.2

Ao escolher esta opção, o usuário rodará o código pertinente por testar as mensagens referentes aos dias especiais.<br/>
O programa selecionará uma data para cada feriado, validará se são datas especiais de fato, e exibirá suas mensagens.

###### Opção 3.3

Ambas as opções acima executarão.

###### Opção 3.4

O programa votlara ao <i>display</i> anterior.

## Opção 4 

Ao escolher a opção 4, o programa se encerrará.

# Estruturação

O código do projeto está estruturado da seguinte maneira:

- app
  - Tests
  - Validators
- vendor
- composer.json
- composer.lock
- index.php
- Run.php

## app
###### Tests

Dentro desta pasta são localizados os códigos responsáveis pelo gerenciamento e execução dos testes.

###### Validators

Nesta pasta estão presentes as classes responsáveis por validar qual dia da semana é a data alvo, se a data é um feriado,
e qual a mensagem pertinente para tal dia.

## vendor/composer.json/composer.lock

Aqui são localizados os arquivos de configuração do composer.

## index.php 

Código em PHP responsável por requerer o autoload do composer, que, por sua vez, é o responsável pelo mapeamento das classes.

## Run.php 

Arquivo contendo o código que contém os <i>displays</i> com o qual o usuário interagirá.
