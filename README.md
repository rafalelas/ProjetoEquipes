# Projeto Equipes

Sistema web desenvolvido em Laravel para gerenciamento de equipes, usuários e organização de dados internos.
Este projeto foi criado como parte do processo de aprendizado da matéria de Laravel na faculdade e prática em desenvolvimento web no geral, focando em backend, banco de dados e estrutura MVC.

por: Mateus Oliveira e Rafaela Schneider
---

## 🚀 Tecnologias usadas

- PHP 8+
- Laravel
- MySQL
- Blade
- HTML, CSS
- JavaScript

---

## 📌 Funcionalidades

- Cadastro e login de usuários
- CRUD de equipes
- Associação de usuários a equipes
- Interface web com Blade
- Validação de formulários
- Integração com banco de dados

---

## 🛠 Como rodar o projeto

### 1. Clone o repositório

```bash
git clone https://github.com/rafalelas/ProjetoEquipes.git
cd ProjetoEquipes
```

### 2. Instale as dependências

```bash
composer install 
```
### 3. Crie o arquivo de ambiente
```bash
cp .env.example .env
php artisan key:generate
```
### 4. Configure o banco de dados
```bash
DB_DATABASE=projeto_equipes
DB_USERNAME=root
DB_PASSWORD=
```
### 5. Rode as migrations
```bash
php artisan db:seed
```
### 6.Inicie o servidor
```bash
php artisan serve
```
Acesse no navegador
http://localhost:8000

Usuário de teste criado automaticamente:

Email: test@example.com  
Senha: 123456




