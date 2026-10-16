# Landing page de portal de acupuntura

Landing page de uma página só para um portal on-line voltado a profissionais de acupuntura, que divulga sistemas on-line (humano, cães e gatos), programas para computador e livros de bolso. O conteúdo é estático, renderizado em Blade a partir de uma única rota.

## Stack

| Peça | Escolha |
| --- | --- |
| Backend | PHP 8.2+ com Laravel 12 |
| Templates | Blade, com a página dividida em partials |
| Estilo | Tailwind CSS 4 (via `@tailwindcss/vite`) e `tailwindcss-animated` |
| Interatividade | Alpine.js 3 |
| Build | Vite 7 com `laravel-vite-plugin` |
| Banco | SQLite (padrão do `.env.example`), usado só por sessão, cache e fila |

## Seções

- **Hero**: chamada "O Futuro da Acupuntura" sobre imagem de fundo.
- **Boas-vindas**: apresentação do portal e carrossel com três slides (Acupuntura Veterinária, Acupuntura Sistêmica, Sistema Online).
- **Produtos**: Acupuntura Sistêmica Online, Acupuntura para Cães e Acupuntura para Gatos, cada um com lista de conteúdos e cards de planos (6 meses, 1 ano e, no sistêmico, 1 ano + Software_MTC).
- **Condições de uso**: regras de acesso ao sistema on-line, suporte técnico e "como funciona".
- **Programas para computador**: Software_CAD4, Software_HAND4, Software_PET e Software_Aurículo.
- **Requisitos e licenças**: requisitos mínimos, instalação, suporte e regras da licença gratuita dos programas.
- **Livros e atlas de bolso**: manuais de acupuntura chinesa e Acupuntura Coreana Passo a Passo, com características de cada obra.
- **Sobre a empresa** e **Contato** (botões de WhatsApp, Instagram e Facebook).

Os botões de ação (Contratar, Acessar Link, Saiba Mais, redes sociais) ainda não têm destino definido no código.

## Detalhes de implementação

- **Página montada por partials**: `index.blade.php` só inclui `head`, `header` e as seções de `resources/views/partials/`, o que mantém cada bloco isolado e fácil de editar.
- **Navegação ativa por scroll**: o componente Alpine `sectionSpy` usa `IntersectionObserver` (só no desktop) para destacar o item do menu da seção visível; as âncoras `atlas`, `programs` e `books` são agrupadas no item "Produtos".
- **Menu mobile com store global**: o estado de abertura fica em `Alpine.store('menu')`, com painel lateral, backdrop e accordion para os produtos.
- **Tema com tokens do Tailwind 4**: cores da marca definidas em `@theme` no `app.css`, e as classes `.light-bg` e `.dark-bg` aplicam um gradiente sobre a textura de fundo recebida pela variável `--bg-image`.

## Como rodar

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
npm install && npm run dev
php artisan serve
```

As migrations são as padrão do Laravel (users, cache e jobs). Elas são necessárias porque sessão, cache e fila usam o driver `database`.

## Estrutura

```
app/Http/Controllers/
  HomeController.php     # retorna a view index
resources/
  css/app.css            # Tailwind, tokens de cor e fundos texturizados
  js/app.js              # stores e componentes Alpine (menu, nav, spy, carrossel)
  views/
    index.blade.php      # monta a página a partir das partials
    partials/            # head, header e uma partial por seção
public/img/              # imagens, ícones e texturas da página
routes/web.php           # rota única GET / -> HomeController@index
```

## Autor

Desenvolvido por [Gustavo Barbosa Lima](https://gustavodev.dev).
