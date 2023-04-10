## Documentação do Sistema
#
<p>Este documento descreve o sistema desenvolvido com Laravel 10, Livewire e Tailwind. O sistema inclui as seguintes funcionalidades:</p>


<ul>
    <li>Sistema de Login</li>
    <li>Validação de Força de Senha</li>
    <li>Registro de Usuários em Massa</li>
    <li>Consumo de API Pokemon</li>
    <li>Exportação de Dados da API</li>
</ul>

## Pré-requisitos
#
<ul>
    <li>PHP >= 8.2</li>
    <li>Composer</li>
    <li>Banco de dados MySQL</li>
</ul>

## Instalação
#
<ol>
    <li>Clone o repositório para sua máquina:</li>

```bash 
git clone git@github.com:LeonardoScherer/desafio_dev_gs.git
```

<li>Instale as dependências do composer:</li>

```bash 
cd desafio_dev_gs
composer install
```

<li>Configure as variáveis de ambiente:</li>

```bash 
cp .env.example .env
php artisan key:generate
```
<ul>
<li>Você precisa definir as seguintes variáveis de ambiente no arquivo .env:</li>

```env 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco_de_dados
DB_USERNAME=nome_de_usuario_do_banco_de_dados
DB_PASSWORD=senha_do_usuario_do_banco_de_dados
``` 

<p>Substitua nome_do_banco_de_dados, nome_de_usuario_do_banco_de_dados e senha_do_usuario_do_banco_de_dados pelas suas informações de acesso ao banco de dados. Certifique-se de ter criado o banco de dados antes de executar as migrações.</p>

```env 
MAIL_MAILER=smtp
MAIL_HOST=host
MAIL_PORT=2525
MAIL_USERNAME=seu_usuario
MAIL_PASSWORD=sua_senha
MAIL_ENCRYPTION=tls
``` 
<p>Substitua host, port, seu_usuario e sua_senha pelas suas informações de acesso ao servidor de e-mail.</p>
</ul>

<li>Execute as migrações do banco de dados:</li>

```bash
php artisan migrate
```

<li>Instale as dependencias NPM:</li>

```bash
npm install
npm run build
```

<li>Inicie o servidor web:</li>

```bash
php artisan serve
```

</ol>

## Uso do Sistema
### Sistema de Login

<p>O sistema de login permite que os usuários se autentiquem usando um endereço de e-mail e senha. Ao enviar o formulário de login, o sistema verifica as credenciais do usuário e redireciona para a página inicial se a autenticação for bem sucedida. Se a autenticação falhar, uma mensagem de erro é exibida para o usuário.</p>

### Validação de Força de Senha
<p>A função de validação de força de senha verifica se uma senha é fraca, média ou forte. Uma senha forte deve ter pelo menos 8 caracteres, incluindo letras maiúsculas e minúsculas, números e caracteres especiais. Para verificar a força de uma senha, acesse a página de cadastro e digite uma senha no campo de senha. Uma mensagem será exibida indicando se a senha é fraca, média ou forte.</p>

### Registro de Usuários em Massa

<p>A função de registro de usuários em massa permite que os usuários sejam registrados no sistema a partir de uma planilha que contenha as informações de login, senha e e-mail. Para importar os usuários, acesse a página de registro em massa (http://127.0.0.1:8000/admin/upload-spreadsheet) e selecione o arquivo CSV ou XSLX contendo as informações dos usuários. Certifique-se de que o arquivo contém as colunas corretas.
</p>
<p>* Apenas usuários com is_admin == 1 poderão acessar a parte administrativa</p>

### Consumo de API Pokemon
<p>A função de consumo de API Pokemon permite que os usuários visualizem informações sobre pokemons. Para acessar essa funcionalidade, acesse a página de consulta de pokemons (http://127.0.0.1:8000/pokemons). A página exibirá uma lista com os gif, nome, location_area_encounter e base_experience</p>

### Exportando dados da API
<p>Para exportar os dados apresentados na parte 4 em formato de planilha (CSV ou XLSX), basta clicar no botão "Exportar para CSV" ou "Exportar para XLSX" que está localizado na mesma página onde os dados foram apresentados.</p>

<p>
Ao clicar em um dos botões, o sistema irá gerar um arquivo de planilha com os dados apresentados. O arquivo pode ser baixado e salvo em seu computador para posterior análise.
</p>

### Multi-linguagem
<p>O sistema possui suporte a múltiplos idiomas, permitindo que o usuário possa selecionar o idioma preferido durante o uso da aplicação.

Para alterar o idioma, basta acessar o arquivo config/app.php e alterar o valor da chave 'locale' para o idioma desejado. Por padrão, o sistema está configurado para o idioma português do Brasil (pt-br), mas é possível alterar para outros idiomas, como inglês (en).

Para que a mudança de idioma tenha efeito, é necessário reiniciar o servidor web e limpar o cache do sistema. Para limpar o cache do sistema, basta executar o comando:

```bash
php artisan optimize
```
no terminal. </p>
<p>
Certifique-se de que o idioma escolhido esteja disponível no diretório resources/lang. Caso o idioma desejado não esteja disponível, é possível adicioná-lo criando um novo diretório com o código do idioma (por exemplo, es para espanhol) e adicionar o arquivo "messages.php" com as traduções.

Para adicionar traduções a novas strings, basta editar o arquivo de idioma no diretório "resources/lang/en" no caso da tradução para inglês e adicionar as traduções necessárias neste arquivo. Em seguida, basta usar a função trans('messages.chave') em seu código para acessar a tradução correspondente.
</p>
