# 🧹 Limpador de Action Scheduler para WordPress

Plugin leve e funcional que remove periodicamente todas as ações e logs acumulados nas tabelas do **Action Scheduler**, comuns em sites com **WooCommerce** e outros plugins que utilizam tarefas agendadas.

Ideal para sites onde o banco de dados cresce rapidamente por causa de tarefas pendentes, concluídas ou falhas, deixando o site lento e inflando o banco desnecessariamente.

---

## 🔧 Funcionalidades

- 🧼 **Limpa automaticamente** as tabelas `wp_actionscheduler_actions` e `wp_actionscheduler_logs`
- 🗓️ Agendamento automático **a cada 3 dias**
- 📉 Otimização das tabelas após a limpeza (libera espaço no disco)
- 🧠 Interface no painel admin em **Ferramentas → Limpador Action Scheduler**
- 🖱️ Botão de **execução manual** pelo painel
- 📅 Mostra a data/hora da **última execução automática**

---

## 📂 Instalação

1. Faça o download do arquivo `wp-clear-actionscheduler.php`
2. Envie para a pasta `wp-content/plugins/`
3. Ative o plugin via **Painel → Plugins**
4. Acesse o menu **Ferramentas → Limpador Action Scheduler**

---

## 💡 Requisitos

- WordPress 5.0 ou superior
- WooCommerce (ou outro plugin que utilize Action Scheduler)
- Permissões para `manage_options` no painel

---

## 📌 Observações

- O plugin usa o sistema `wp-cron`. Para funcionar corretamente, o site precisa ter visitas regulares.
- Para sites críticos, é recomendado usar um cronjob real via servidor.
- Nenhuma configuração adicional é necessária — basta ativar e deixar o plugin trabalhar automaticamente.

---

## 🧠 Autor

**Miguel Faria**  
[Comércio do Site](https://www.comerciodosite.com.br/) – Soluções em Web, E-commerce, APIs e Hospedagem

---

## 🛡️ Licença

Este plugin é distribuído sob a licença MIT. Livre para uso pessoal e comercial.

