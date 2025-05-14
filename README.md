# 🧾 Montink - Mini ERP de Cupons, Produtos e Pedidos

Este projeto foi desenvolvido como parte do processo seletivo para a vaga de Desenvolvedor Back-End PHP da Montink.

---

## ⚙️ Tecnologias utilizadas

- **Laravel 10**
- **Filament v3** (como painel administrativo moderno)
- **TailwindCSS**
- **Livewire**
- **MySQL**
- API pública do [ViaCEP](https://viacep.com.br/)
- Envio de e-mails nativo do Laravel

---

## 🧠 Decisão técnica

Sim, eu poderia ter feito tudo com **PHP puro**, **CodeIgniter 3** ou **Laravel sem painel** — e ficaria feliz em provar isso no código se necessário 😄

> Mas como o tempo era curto e o escopo exigia um CRUD funcional completo, preferi focar em **resolver o problema com clareza, boas práticas e agilidade**, usando o **Filament como painel administrativo**. 

---

## 🎯 O que foi entregue

✅ Cadastro e edição de produtos com variações e controle de estoque  
✅ Sessão de carrinho com cálculo de subtotal e regras de frete  
✅ Aplicação e validação de cupons com regras de mínimo e validade  
✅ Finalização de pedidos com busca de endereço via CEP  
✅ Envio de e-mail de confirmação após o pedido  
✅ Webhook RESTful para atualizar/cancelar status do pedido  
✅ Uso de camada de serviços (`App\Services`) para manter o código limpo e organizado

---

## 📁 Estrutura resumida

```
app/
├── Filament/
│   └── Resources/
├── Services/
│   ├── ProductService.php
│   ├── CartService.php
│   ├── OrderService.php
│   └── CouponService.php
├── Http/
│   └── Controllers/
│       └── WebhookController.php
routes/
├── web.php
├── api.php
resources/views/
```

---

## 🚀 Como rodar o projeto localmente

```bash
git clone https://github.com/vitorpedroso283/montink-mini-erp.git
cd montik-mini-erp
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
npm install && npm run dev
php artisan serve
```

Acesse: `http://localhost:8000/admin`

---

## 🔑 Acesso ao painel

```bash
php artisan make:filament-user
# Siga as instruções para criar o usuário admin
```

---

## ✅ Observações finais

Este projeto foi desenvolvido com foco em produtividade e boas práticas. Optei por **não reinventar a roda**, mas também **não terceirizar a lógica**: toda a parte de regras de negócio está devidamente separada em **services**, e o Filament foi utilizado apenas como **ferramenta de interface**, sem depender de scaffolding automático para lógica.

Se tiver qualquer dúvida técnica, posso explicar linha por linha — e com gosto.

---

Feito com café, Livewire e umas boas ideias. ☕🚀  
— Vitor
