<h1 align="center">Route Api</h1>

<p align="center">Api Utilizada no projeto <a href="github.com/claitonbarreto">routeweb</a><p>

Softwares usados em desenvolvimento:
- Docker
- Laradock com docker-compose

OBS: Para testar a api em desenvolvimento é necessário criar uma conta de
desenvolvedor em [developer.here.com](developer.here.com)

## Instalação

### - Faça o clone do projeto

`git clone https://github.com/ClaitonBarreto/api-route.git`

### - Crie um arquivo `.env` e copie o conteúdo de `.env.example` para dentro dele.

`cd api-route && cp .env.example .env`

### Dentro do novo arquivo `.env` altere a variável de ambiente `ROUTE_APP_API_KEY` para que fique dessa forma:

`ROUTE_APP_API_KEY=seu_token_here_developer`

## Rodando a API

É recomendado que tenha instalado o [Laradock](laradock.com)

### Com Laradock

Copie o diretório do laradock para que fique concorrente com o diretório da api:

`meus-projetos` <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; `- laradock` <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; `- api-route`

### - Entre no diretório do Laradock e rode o comando para executar o servidor de sua preferência:

`docker-compose up -d nginx`

### - Acesse a pasta de trabalho através do seu servidor:

`docker-compose exec workspace bash`

### - Finalmente acesse o diretório da Api e instale as dependências necessárias:

`composer install`

### - Após instaladas todas as dependências, saia do bash do servidor remoto e sua api estará pronta para ser acessada:

`exit`


Caso esteja rodando em desenvolvimento junto com o [Front-end](link), será necessário configurar a url da api, para isso basta acessar o seu arquivo de `hosts` e adicionar a seguinte linha:
`api.route  127.0.0.1`





