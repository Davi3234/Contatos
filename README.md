# Contatos
## Manual de utilização do sistema

- Certifique-se de ter um banco postgresql com as seguintes credenciais: 
  - Nome do banco => contatos_bd;
  - Usuário => postgres;
  - Senha => postgres;
  - Host => localhost;
  - Porta => 5432;
- Primeiro use o comando "php bin/doctrine orm:schema-tool:create --force" para criar as entidades do ORM
- Depois rode o comando "php -S localhost:8080 index.php" para o sistema funcionar