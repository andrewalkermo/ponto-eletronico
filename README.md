# Sistema de Ponto Eletrônico

Sistema de ponto eletrônico simples feito em PHP. Com gerenciamento de membros, exportação de tabela .xlsx de horas trabalhadas na semana, e controle de acesso utilizando o AuthType Basic do Apache.

Telas disponíveis:

- **Ponto**: Bater o ponto em três cenários diferentes: sede, projetos e atividade;
- **Painel**: Vizualizar quem está na sede no momento;
- **Membros**: Cadastro, edição e exclusão de membros da plataforma;
- **Relatórios**: Exportação de relatórios semanais contendo a lista de membros e suas horas trabalhadas;
 
**Disponível em:**<br/>
[Sistema de ponto Eletrônico](https://ponto-andrewalkermo.herokuapp.com/)<br/>
Usuário: admin
senha: admin

**Instalação:**<br/>

 1. Faça download do projeto; 
 2. Execute: `$ composer install` para instalar o phpoffice;
 3. Importe o banco de dados MySQL disponível em database/ponto.sql;
 4. Configure o arquivo database/db_connection.conf com os dados do seu banco MySQL;
 5. Para configurar o controle de acesso do Apache consulte: http://www.ninjawp.com.br/como-proteger-uma-pasta-com-password-pelo-htaccess-e-htpasswd
