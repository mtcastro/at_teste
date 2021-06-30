# at_teste
Aplicação que monitora o status de um conjunto de urls e notifica quando fica inativo.


Este projeto foi desenvolvido em Laravel/php, utilizando Filas para processar as consultar das URLs 
em paralelo sem comprometer a performasse do sistema e Cron para solicitar o processo de consultas
das URLs em intervalos programado.

Para executar esse projeto você tem que:

    1º Configurar o projeto:
    Após baixar o projeto, crie um banco de dados mySql. Feito isso abra o arquivo .env e set o nome do 
    banco que você criou em DB_DATABASE. Configure o serviço de email de sua preferencia no mesmo arquivo (MAIL_HOST, MAIL_PORT e etc).

    2ª Intalar as dependencias
    Abra o termina na raiz do projeto e execute o comando "composer install"

    3º Execute as migrações do banco de dados
    Abra o termina na raiz do projeto e execute o comando "php artisan migrate"

    4º Inicie o servidor local
    Abra o termina na raiz do projeto e execute o comando "php artisan serve"

    5º inicie o processo de Filas do laravel
    Abra o termina na raiz do projeto e execute o comando "php artisan queue:work"

    6º Adicione o comando de consultas ao CRON do seu sistema operacional base linux
    */30 * * * * php (diretório raiz do projeto)/artisan consultar

Abra o o painel em seu navegador http://127.0.0.1:8000/ e adicione as url a ser monitorada. Na sessão notificação
você deve configurar o email para receber as notificações. O painel não atualiza os dados das consultas automáticamente,
é preciso atualizar a pagina para acompanhar as modificações no painel.
