Api de Gerenciamento de Jogos de Futsal:

Essa é a API de Futsal, API construída em Laravel. Está API permite o gerenciamento de jogadores, times, partidas e possui autenticação de usuários com o Laravel Sanctum.

**Configuração:**

Antes de começar a usar a API Laravel, siga as etapas a seguir para configurar o ambiente:

1.	Clonar o repositório:

    1.1	    Git clone https://github.com/JvBR28/Api-Futsal.git

2.	Instalar dependências:	

    2.1.	Use no seu terminal o comando ```composer install```

3.	Configurar Variáveis de Ambiente:

    3.1.	Copie o arquivo ```.env.example```, crie um arquivo chamado ```.env``` cole o código dentro do ```.env``` e configure as seguintes variáveis de ambiente que correspondem a sua maquina:

    3.2.	```DB_CONNECTION```, ```DB_HOST```, ```DB_PORT```, ```DB_DATABASE```, ```DB_USERNAME``` E ```DB_PASSWORD```.

4.	Executar Migrações:

    4.1.	Use o comando no terminal: ```php artisan migrate```

5.	Iniciar o servidor de desenvolvimento:

    5.1.	Use o comando no terminal: ```php artisan serve```

**Endpoints:**


**Register:**

POST: ```/api/register```: Cria um novo usuário

**Login:**

POST ```/api/login```: realiza o login e gera um token para você utilizar nas rotar a seguir

**Players:**

GET ```/api/player```: Mostra todos os jogadores criados.

POST ```/api/player```: Cria um novo jogador.

PATCH ```/api/player/{id}```: Edita um jogador existente.

DELETE ```/api/player/{id}```: Exclui um jogador.

**Teams:**

GET ```/api/teams```: Lista todos os times criados.

GET ```/api/teams/rankings```: Lista times em ordem decrescente de pontos.

GET ```/api/teams/list/{id}```: Lista times existente com todos os jogadores nele.

POST ```/api/teams```: Cria um novo time.

PATCH ```/api/teams/{id}```: Edita um time existente.

DELETE ```/api/teams/{id}```: Exclui um time.

**Games:**

GET ```/api/games```: Lista todos as partidas.

POST ```/api/games```: Cria uma nova partida.

PATCH ```/api/games/{id}```: Edita uma partida existente.

DELETE ```/api/games/{id}```: Deleta uma partida existente.