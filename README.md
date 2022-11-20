Instalar o Scoop
----------------
Set-ExecutionPolicy RemoteSigned -Scope CurrentUser # Optional: Needed to run a remote script the first time
irm get.scoop.sh | iex

Instalar o symfony-cli
----------------------
scoop install symfony-cli

Instalar o Certificado do servidor
----------------------------------

symfony server:ca:install

Rodar o banco de dados e o PHP My Admin
---------------------------------------
docker-compose up

Rodar a Aplicação
-----------------

symfony server:start