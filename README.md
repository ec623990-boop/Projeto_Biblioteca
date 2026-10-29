# Sistema Biblioteca

Aplicação web em PHP e MySQL/MariaDB para administrar um acervo e apresentar um catálogo de vendas com preços. A interface do leitor é somente para consulta: este projeto não processa pedidos, pagamentos ou checkout online.

## Funcionalidades

- Login com perfis separados de equipe administrativa e leitor.
- Leitores podem criar uma conta e consultar somente o catálogo de vendas.
- O catálogo mostra título, autor, categoria, ano e preço; livros sem preço exibem “Preço sob consulta”.
- A equipe mantém o cadastro do acervo, gerencia contas administrativas, consulta o painel e registra empréstimos.
- Senhas são armazenadas com o mecanismo password_hash do PHP; a validação usa password_verify.
- O acesso aos endpoints administrativos é verificado no servidor, não apenas ocultando links.

## Requisitos

- PHP 8.0 ou superior, com PDO MySQL e extensão mbstring.
- MySQL 8 ou MariaDB com suporte a InnoDB.
- Servidor web com a raiz apontada para a pasta do projeto.

## Instalação em banco novo

1. Importe database/schema.sql em uma instância MySQL/MariaDB. O arquivo cria o banco biblioteca e as tabelas usuarios, livros e emprestimos.
2. Configure a conexão em config/conf.php usando as variáveis host, user, pass e dbname já usadas pelo projeto. Não publique credenciais reais no GitHub.
3. Na raiz do projeto, execute scripts/criar_admin.php pelo terminal PHP. O script solicita nome, e-mail e senha e cria o primeiro usuário com perfil administrativo. A senha não deve ser passada como argumento de linha de comando.
4. Inicie um servidor local na raiz do projeto com: php -S localhost:8000 -t .
5. Abra /pages/login.php. Leitores podem usar o link de criação de conta; a nova conta recebe sempre o perfil leitor.

## Atualizar uma instalação existente

1. Faça backup do banco antes de qualquer alteração.
2. Verifique duplicatas de e-mail com a consulta comentada no início de database/migrate_catalogo_vendas.sql. Resolva eventuais duplicatas antes de continuar.
3. Execute database/migrate_catalogo_vendas.sql uma única vez. Contas existentes recebem perfil leitor por padrão para evitar elevar permissões sem validação; o preço dos livros existentes fica sem valor até a equipe preenchê-lo. Após a migração, crie o primeiro administrador pelo script CLI. Promova contas existentes para equipe somente depois de verificar que pertencem a funcionários autorizados, usando uma atualização pontual pelo e-mail.
4. Publique o código e revise config/conf.php no ambiente de execução.

A migração SQL não pode ser executada novamente sem remover primeiro as colunas e o índice criados. Nunca rode a migração em produção sem backup.

## Perfis e rotas principais

- Equipe: /pages/home.php, /pages/livros.php, /pages/cadastrar_livro.php, /pages/emprestimos.php, /pages/painel.php e /pages/cadastro_usuario.php.
- Leitor: /pages/catalogo_vendas.php. Um leitor autenticado é redirecionado para essa área e não pode abrir rotas administrativas.
- Login: /pages/login.php. Sair: /pages/logout.php.
- A criação pública de contas sempre grava perfil leitor. A criação de contas administrativas exige uma sessão de equipe ou o script CLI de configuração inicial.

## Banco de dados

- usuarios: identidade, e-mail único, hash de senha e perfil admin/leitor.
- livros: dados bibliográficos, quantidade e preço opcional em reais.
- emprestimos: registros usados pela área administrativa; o catálogo de vendas não mostra dados de empréstimos.

O esquema de banco novo está em database/schema.sql. Para instalações existentes, use database/migrate_catalogo_vendas.sql após backup.

## Limites conhecidos

- O catálogo é somente para consulta; carrinho, pedidos, cobrança e integração de pagamento não estão implementados.
- A área atual de empréstimos continua sendo administrativa; leitores não podem consultar nem alterar empréstimos.
- Um preço nulo significa “Preço sob consulta”. A equipe precisa informar os preços dos itens existentes.
- Não há suíte automatizada nem ambiente de banco de dados fornecido neste repositório; valide as configurações e fluxos no ambiente de instalação.
