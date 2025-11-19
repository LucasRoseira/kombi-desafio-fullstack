# 🚐 Sistema de Cadastro de Clientes – Laravel + Docker + Vite

Este projeto consiste em uma API Laravel para cadastro, listagem e filtragem de clientes, com ambiente totalmente automatizado via Docker.  
Ao iniciar os containers, o sistema executa automaticamente:

- Criação do arquivo `.env` (caso não exista)  
- Migrations  
- Seed customizado, inserindo **100 clientes fake**  
- Inicialização do PHP-FPM + Nginx + Vite  

---

## 🧱 Tecnologias Utilizadas

- Laravel 10  
- PHP 8.2  
- MySQL 8  
- Nginx (Alpine)  
- Docker + Docker Compose  
- Node 18 + Vite  
- Faker (pt_BR)

---

## 🚀 Como rodar o projeto

### 1. Clonar o repositório
```bash
git clone https://github.com/sua-conta/seu-repo.git
cd seu-repo
````

### 2. Subir o ambiente Docker

```bash
docker compose up --build
```

A primeira execução pode demorar um pouco, pois o Composer instalará as dependências.

Após iniciar, o container **app** fará automaticamente:

* Criar `.env` se não existir
* Aguardar o MySQL iniciar
* Executar migrations
* Executar `php artisan seed:clients` → insere 100 registros fake
* Iniciar PHP-FPM

O **Vite** será iniciado pelo container `vite`.

---

## 🌐 Acessos

| Serviço         | URL                                            |
| --------------- | ---------------------------------------------- |
| API Laravel     | [http://localhost:8000](http://localhost:8000) |
| Vite Dev Server | [http://localhost:5173](http://localhost:5173) |
| MySQL           | localhost:3306                                 |

---

## 📦 Endpoints principais

### **GET /api/clients**

Lista paginada de clientes, com filtros opcionais:

**Filtros disponíveis:**

* `name`
* `state`
* `city`

---

### **GET /api/states**

Lista todos os estados presentes na base.

---

### **GET /api/cities?state=SP**

Lista todas as cidades do estado informado.

---

### **GET /api/suppliers?state=SP&city=São Paulo**

Lista fornecedores conforme filtros recebidos.

---

### **POST /api/clients**

Cria um novo cliente e dispara um job para envio de e-mail.

---

## 🗃️ Sobre o seed automático

O entrypoint executa o comando customizado:

```bash
php artisan seed:clients
```

Este comando está em:

```
app/Console/Commands/SeedClientsCommand.php
```

Ele insere **100 clientes fictícios** utilizando Faker (pt_BR), permitindo testar paginação, filtros, desempenho e listagem sem depender de dumps externos.

---

## 🧩 Estrutura dos Containers

* **laravel_app** → PHP-FPM + Laravel
* **laravel_web** → Nginx servindo o Laravel
* **laravel_vite** → Node 18 rodando o Vite
* **laravel_db** → MySQL 8

---

## ⚙️ Configuração do Banco via Dump (.sql)

Mesmo tendo seed automático, você pode carregar um dump manualmente.

### 1. Coloque o `.sql` dentro de `/docker/mysql/` (ou outro local).

### 2. Suba apenas o banco:

```bash
docker compose up -d db
```

### 3. Execute o dump:

```bash
docker exec -i laravel_db mysql -u root -proot laravel < seu_dump.sql
```

---

## 🛠️ Processo de Desenvolvimento

### ✔ Docker com entrypoint customizado

O entrypoint automatiza:

* Criação do `.env`
* Espera do MySQL
* Migrations
* Seed automático

→ Ambiente 100% pronto após `docker compose up`.

### ✔ Seed customizado em vez de DatabaseSeeder

Preferido para:

* controle de quantidade de registros
* evitar duplicações
* execução explícita no entrypoint
* logs mais limpos

### ✔ MySQL com healthcheck

Garante que migrations só rodem quando o banco estiver pronto.

### ✔ Vite em container separado

Mantém Node isolado do PHP — boa prática.

---

## ⏱️ Tempo gasto por etapa

| Etapa                           | Tempo    |
| ------------------------------- | -------- |
| Configuração inicial Laravel    | ~1h      |
| Docker (app, db, nginx, vite)   | ~2h      |
| Entrypoint + wait-for-mysql     | ~30 min  |
| Comando seed customizado        | ~30 min  |
| Ajustes em Controller/Service   | ~2h      |
| Desenvolvimento Backend (API)   | ~8h      |
| Desenvolvimento Frontend (Vite) | ~10h     |
| Testes, logs e debugging Docker | ~1h      |
| Documentação                    | ~20 min  |

**⏳ Total aproximado: 25h 20min**

---

## 🧪 Como rodar testes

```bash
docker exec -it laravel_app php artisan test
```

---

## 🧹 Resetar tudo (limpar banco e containers)

```bash
docker compose down -v
docker compose up --build
```