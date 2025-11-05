<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

# 📌 Projeto Laravel - Lista de Pessoas

Este é um projeto simples em **Laravel** que exibe dados de pessoas, podendo ser carregados de uma **API externa** ou do **banco de dados local**.

---

## 🚀 Funcionalidades

- Página inicial consumindo a API pública [Random User](https://randomuser.me/api/?results=100).
- Página com dados vindos do **Banco de Dados**:
  - Adicionar pessoas via formulário.
  - Visualizar detalhes de cada pessoa.
  - Excluir registros.

---

## 🛠 Tecnologias Utilizadas

Backend: Laravel

Banco de Dados: PostgreSQL

Cache / Fila: Redis

Containerização: Docker & Docker Compose

Dependências PHP: Composer

Front-end: Blade / JavaScript

APIs externas: Random User

---

## 🖼️ Prévia do Projeto

<p align="center">
    <img width="1897" height="865" alt="image" src="https://github.com/user-attachments/assets/124f3766-57c1-496a-a95b-772ac88a7f48" />
</p>

---

## ⚙️ Como Rodar o Projeto

### Usando Docker
Certifique-se de ter o **Docker** e **Docker Compose** instalados.  
Depois basta rodar:

```bash
docker compose up --build
```


---
> ⚙️ **Nota:**  
> O arquivo `.env` foi incluído intencionalmente para facilitar a execução local.  
> Todas as variáveis são de ambiente de desenvolvimento e não contêm informações sensíveis.

