# Projeto-Atendimento

# Introdução
Este protótipo ainda esta e fase de desenvolvimento porem ja é possivel utilizar o chat para simular um dialogo em realtime com dois usuarios `é preciso estar logado para poder acessar o chat`.

Tecnologia ultilizada para o chat:
- `PUSHER [https://pusher.com]`
- `Funcionalidades de interface feita com JQuery e Bootstrap`
- `Mysql 8.0`
- `Apache 2.4`
- `PHP 7.2 (sem framework)`

# Usuarios pre-cadastrados

- `Atendente_1 (login:atendente_1@gmail.com,senha:1234)`
- `Atendente_2 (login:atendente_2@gmail.com,senha:1234)`
- `Cliente_1 (login:cliente_1@gmail.com,senha:1234)`
- `Cliente_2 (login:cliente_2@gmail.com,senha:1234)`

# Requisitos:
-`instalação do docker [https://docs.docker.com/install/]`

# Iniciar projeto

Execute na raiz do projeto 
- `./iniciar_projeto.sh`
(Precisa estar com o usuario administrador)

Se deseja derrubar os containers do projeto execute o camando:
- `./derrubar_containers.sh`
Este script fará um backup do banco antes de derrubar o container com o mysql,
na pasta `dump/scripts/db.sql` você encontra o ultimo backup.
Para subir o projeto com o backup execute:
- `./subir_containers.sh`

Em seguida acesse o projeto:[http://localhost:8001] ou [http://localhost:8001/chat]

Para acessar o banco mysql use:

- `docker-compose exec db mysql -u root -p` 

Objetivo do projeto é a aquisição de conhecimento nas tecnologias utilizadas sem a utilicação de frameworks!