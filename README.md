Questify 🎮


Questify é uma plataforma de gamificação escolar desenvolvida em Laravel, criada para tornar o ambiente de aprendizado mais engajante e dinâmico. O sistema transforma a rotina da sala de aula em uma experiência gamificada, onde alunos acumulam pontos, sobem em rankings e acompanham seu desempenho em tempo real.
🚀 Sobre o Projeto

O Questify foi desenvolvido como projeto escolar para o curso técnico do SENAI, com o objetivo de digitalizar e gamificar a gestão de turmas, atividades e comportamento dos alunos. A plataforma conta com três níveis de acesso — Admin, Instrutor e Aluno — cada um com funcionalidades específicas.

👥 Perfis de Usuário

⚙️ Admin
Responsável pela gestão geral do sistema. Pode criar e deletar instrutores, mover alunos entre turmas e visualizar todos os dados da plataforma.

👨‍🏫 Instrutor
Gerencia suas turmas e alunos de acordo com os turnos em que leciona. Pode criar atividades com pontuação e prazo, confirmar entregas, registrar presença e avaliar o comportamento dos alunos com pontos positivos ou negativos.

👨‍🎓 Aluno
Acompanha seu desempenho pelo dashboard personalizado, visualiza e entrega atividades, e compete nos rankings de pontuação e comportamento com os colegas de turma e turno.

✨ Funcionalidades

Autenticação multi-guard com três níveis de acesso
Cadastro de alunos com foto de perfil e seleção de turma
Dashboard personalizado por perfil de usuário
Sistema de atividades com pontuação automática ao confirmar entrega
Registro de presença por atividade
Avaliação de comportamento com motivos pré-definidos e campo livre
Rankings rotativos de pontuação e comportamento por turma e turno
Filtro de alunos por turnos lecionados pelo instrutor
Barra de pesquisa de alunos por nome ou email
Edição de perfil com troca de foto, nome e senha
Layout responsivo com tema escuro e visual gamificado

🛠️ Tecnologias Utilizadas

PHP 8.3 e Laravel 10
MySQL como banco de dados
Blade como template engine
CSS customizado com tema dark e glassmorphism
Fontes Orbitron e Rajdhani (Google Fonts)

⚙️ Como Rodar o Projeto
bash# Clone o repositório
git clone https://github.com/IzacV/Questify.git

# Instale as dependências
composer install

# Configure o .env
cp .env.example .env
php artisan key:generate

# Configure o banco de dados no .env e rode as migrations
php artisan migrate --seed

# Crie o link de storage
php artisan storage:link

# Inicie o servidor
php artisan serve

👨‍💻 Desenvolvido por
**Izac Mateus** — Projeto Integrador SENAI 2026

**Guilhermachado** — Colaborador do Projeto
