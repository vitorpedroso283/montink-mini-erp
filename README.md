# 🧾 Montink - Mini ERP de Cupons, Produtos e Pedidos

Este projeto foi desenvolvido como parte do processo seletivo para a vaga de Desenvolvedor Back-End PHP da Montink.

---

## 💡 Sobre a estrutura da aplicação

O enunciado do teste menciona a criação de um "mini ERP" com a possibilidade de cadastrar produtos e comprá-los na mesma tela.

Como desenvolvedor experiente e acostumado a pensar em sistemas que funcionam bem na prática, percebi que a descrição mistura funcionalidades administrativas (ERP/painel) com ações típicas de um cliente final (e-commerce/carrinho).

Por isso, optei por **separar as responsabilidades de forma clara e mais próxima da realidade de projetos robustos**:

-   🛠️ **Filament (admin)**: para gerenciar produtos, variações, estoque e cupons.
-   🛒 **Livewire (usuário final)**: para simular o fluxo de compra — carrinho, aplicação de cupons, verificação de CEP e finalização do pedido.

Essa decisão visa entregar uma arquitetura mais coesa, respeitando o padrão MVC e favorecendo clareza, escalabilidade e manutenção.

---

## ⚙️ Tecnologias utilizadas

-   **Laravel 12**
-   **Filament v3** (painel administrativo)
-   **TailwindCSS**
-   **Livewire** (interface pública)
-   **MySQL**
-   **PHP8.4**
-   API pública do [ViaCEP](https://viacep.com.br/)
-   Envio de e-mails nativo do Laravel

---

## 🧠 Decisão técnica

Sim, eu poderia ter feito tudo com **PHP puro**, **CodeIgniter 3** ou **Laravel puro com Blade** — e já fiz isso com sucesso em outros testes técnicos que resultaram em aprovação. (Links abaixo 👇)

> No entanto, para este desafio, preferi **focar na entrega do problema com clareza, boas práticas e agilidade**, separando admin de front, evitando overengineering e garantindo organização sólida com uso de `Services`, `Models` bem estruturados e lógica separada da camada visual.

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
cd montink-mini-erp
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

## 💼 Outros testes realizados

Este projeto foi feito com Livewire + Filament, pois essa combinação entrega produtividade, clareza visual e agilidade na entrega.

Outros testes que realizei com sucesso:

* ✅ [**Fidelizi**](https://github.com/vitorpedroso283/FIDELITA) – Aprovado como **Desenvolvedor Back-End**. Projeto feito em Laravel puro com API RESTful estruturada.
* ✅ [**Easyjur**](https://github.com/vitorpedroso283/TaskManagerApp) – Aprovado como **Desenvolvedor Full Stack Sênior**. Projeto feito em PHP puro com jQuery, JS e Bootstrap.
  Arquitetura MVC feita do zero, com controle de acesso, CRUD completo e relatórios.

---

## ✅ Observações finais

Este projeto foi desenvolvido com foco em produtividade e boas práticas. Optei por **não reinventar a roda**, mas também **não terceirizar a lógica**: toda a parte de regras de negócio está devidamente separada em **services**, e o Filament foi utilizado apenas como **painel administrativo**, mantendo a interface de compra fora dele por questões de clareza.

Se tiver qualquer dúvida técnica, posso explicar linha por linha — e com gosto.

---

Feito com café, Livewire e umas boas ideias. ☕🚀  
— Vitor
