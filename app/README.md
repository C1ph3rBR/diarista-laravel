# Diarista Laravel 🧹

Aplicação simples para **cadastro de clientes** e **solicitação de orçamento** de serviço de diarista.

---

## 🧰 Stack

- Laravel 12 (PHP)  
- MySQL (via Docker)  
- Docker + Docker Compose  

---

## 🚀 Como rodar o projeto

### 1. Pré-requisitos

- [Git](https://git-scm.com/)  
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (com Docker Compose instalado e habilitado)

---

### 2. Clonar o repositório

```bash
git clone https://github.com/C1ph3rBR/diarista-laravel.git
cd diarista-laravel
```

Dentro da pasta `diarista-laravel` existe o código Laravel em `app/`.

---

### 3. Criar o `.env` do Laravel

Crie o `.env` a partir do `.env.example`:

**Windows (CMD/PowerShell):**

```bash
copy app\.env.example app\.env
```

**Linux / MacOS:**

```bash
cp app/.env.example app/.env
```

O `.env.example` já está configurado para usar o banco do Docker:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=diarista
DB_USERNAME=laravel
DB_PASSWORD=secret
```

---

### 4. Subir os containers

Na raiz do projeto (`diarista-laravel`):

```bash
docker compose up -d
```

Isso sobe:

- `app` → container com PHP + Apache + Laravel  
- `db` → container MySQL (exposto na porta `3307` do host)

---

### 5. Instalar dependências do Laravel

Se for a primeira vez rodando na máquina:

```bash
docker compose run --rm app composer install
```

---

### 6. Gerar a `APP_KEY`

```bash
docker compose exec app php artisan key:generate
```

---

### 7. Rodar as migrations (criar tabelas)

```bash
docker compose exec app php artisan migrate
```

---

## 🌐 Acessar a aplicação

Com os containers rodando, acesse:

```text
http://localhost:8000/diarista
```

Nessa página é possível:

- Cadastrar os dados do cliente  
- Informar detalhes do imóvel  
- Solicitar orçamento de diarista  

Os dados são gravados nas tabelas:

- `clients`  
- `cleaning_quotes`  

---

## 🗄️ Acessar o banco de dados (opcional)

O MySQL roda no container `db` e está exposto na porta `3307`.

**Dados da conexão:**

- Host: `localhost`  
- Porta: `3307`  
- Database: `diarista`  
- Usuário: `laravel`  
- Senha: `secret`  

**Exemplo via linha de comando:**

```bash
docker compose exec db mysql -ularavel -psecret diarista
```

Você pode usar qualquer cliente (DBeaver, MySQL Workbench, extensões do VS Code etc.)

---

## 🔧 Comandos úteis

Subir containers em background:

```bash
docker compose up -d
```

Ver logs da aplicação:

```bash
docker compose logs -f app
```

Parar os containers:

```bash
docker compose down
```

---

## 📝 Observação (Windows + permissões)

Se aparecer erro de permissão em `storage` ou `bootstrap/cache` (ex: `Failed to open stream: Permission denied`), rode:

```bash
docker compose exec app bash -c "cd /var/www/html/app && chmod -R 777 storage bootstrap/cache"
```

---
