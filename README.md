<h1>Bot Telegram com JWT Authentication</h1>

<p>Este projeto implementa um bot do Telegram utilizando JWT (JSON Web Token) para autenticação. Ele permite enviar mensagens automáticas para os usuários de forma segura, utilizando a verificação do token JWT para garantir que apenas usuários autorizados possam interagir com o bot.</p>

<h2>Tecnologias utilizadas</h2>
<ul>
    <li>PHP (Laravel)</li>
    <li>JWTAuth para autenticação</li>
    <li>API Telegram - BOT</li>
    <li>MySQL ou outro banco de dados relacional</li>
</ul>

<h2>Requisitos</h2>
<ul>
    <li>PHP 7.3 ou superior</li>
    <li>Composer</li>
    <li>MySQL ou outro banco de dados relacional</li>
    <li>Postman ou qualquer ferramenta para fazer requisições HTTP</li>
</ul>

<h2>Configuração</h2>

<h3>1. Clonando o repositório</h3>
<p>Clone o repositório em seu ambiente local:</p>
<pre><code>git clone https://github.com/nickoleevr/laravel-bot-telegram.git</code></pre>

<h3>2. Instalando dependências</h3>
<p>Acesse o diretório do projeto e instale as dependências usando o Composer:</p>
<pre><code>cd laravel-bot-telegram
composer install</code></pre>

<h3>3. Configurando o ambiente</h3>
<p>Crie um arquivo <code>.env</code> na raiz do projeto (se ainda não existir) com as variáveis de configuração do banco de dados e JWT:</p>
<pre><code>cp .env.example .env</code></pre>
<p>Edite o arquivo <code>.env</code> para configurar o banco de dados:</p>
<pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha</code></pre>
<p>Adicione as configurações do JWT:</p>
<pre><code>JWT_SECRET=suachavesecreta</code></pre>
<p>Adicione também o token e id do chat do seu bot do Telegram:</p>
<pre><code>TELEGRAM_BOT_TOKEN=seutoken</code></pre>
<pre><code>TELEGRAM_CHAT_ID=seuid</code></pre>

<h3>4. Gerando a chave JWT</h3>
<p>Execute o comando para gerar a chave secreta do JWT:</p>
<pre><code>php artisan jwt:secret</code></pre>

<h3>5. Rodando as migrações</h3>
<p>Crie as tabelas necessárias no banco de dados:</p>
<pre><code>php artisan migrate</code></pre>

<h3>6. Criando o Usuário</h3>
<p>Como o cadastro de usuários é feito manualmente, você pode usar o <strong>Tinker</strong> do Laravel ou diretamente a interface de seu banco de dados para criar um usuário.</p>
<p>Para criar um usuário no Laravel, execute o comando:</p>
<pre><code>php artisan tinker</code></pre>
<p>Dentro do Tinker, crie um usuário:</p>
<pre><code>App\Models\User::create([
    'email' => 'usuario@exemplo.com',
    'password' => bcrypt('sua-senha')
]);</code></pre>

<h2>Endpoints</h2>

<h3>1. Login (Geração do JWT)</h3>
<ul>
    <li><strong>Método:</strong> POST</li>
    <li><strong>Rota:</strong> /api/login</li>
    <li><strong>Parâmetros:</strong>
        <ul>
            <li><code>email</code>: O e-mail do usuário cadastrado.</li>
            <li><code>password</code>: A senha do usuário.</li>
        </ul>
    </li>
</ul>

<p><strong>Exemplo de Requisição (Postman)</strong></p>
<ul>
    <li><strong>URL:</strong> api/auth/login</li>
    <li><strong>Método:</strong> POST</li>
    <li><strong>Corpo (JSON):</strong>
        <pre><code>{
  "email": "usuario@exemplo.com",
  "password": "sua-senha"
}</code></pre>
    </li>
</ul>

<p><strong>Exemplo de Resposta</strong></p>
<p>Se as credenciais estiverem corretas, você receberá um token JWT:</p>
<pre><code>{
  "token": "seu-token-jwt-gerado-aqui"
}</code></pre>

<h3>2. Envio da Mensagem (Requer JWT no Bearer)</h3>
<ul>
    <li><strong>Método:</strong> GET</li>
    <li><strong>Rota:</strong> /api/sendMessageTelegram</li>
    <li><strong>Autenticação:</strong> Bearer Token (JWT)</li>
</ul>

<p><strong>Exemplo de Requisição (Postman)</strong></p>
<ul>
    <li><strong>URL:</strong> api/sendMessageTelegram</li>
    <li><strong>Método:</strong> GET</li>
    <li><strong>Cabeçalhos:</strong>
        <pre><code>Authorization: Bearer seu-token-jwt-gerado-aqui</code></pre>
    </li>
</ul>


<h2>Licença</h2>
<p>Este projeto está licenciado sob a <a href="LICENSE">MIT License</a>.</p>
