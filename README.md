# Uneafro
Webapp da Uneafro

## Instalação
Se usar um tarball para upload do sistema: criar o diretório no server e descompactar o arquivo;
Caso não use um tarball: clonar o repositório na raiz do server e rodar o comando 'composer install' (é necessário ter o composer instalado no server);
Talvez seja necessário rodar o comando 'php artisan make:key' para gerar a chave da aplicação;
Apontar o diretório do domain ou subdomain para a pasta public da clonagem;
É necessário criar o banco de dados (MySQL) no server e configurar a conexão, dentro do arquivo config/database.php (na seção 'connections', opção 'mysql');
Rodar o comando 'php artisan migrate' para fazer o setup das tabelas no banco
