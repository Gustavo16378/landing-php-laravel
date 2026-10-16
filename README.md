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

## Detalhes de implementação

- **Página montada por partials**: `index.blade.php` só inclui `head`, `header` e as seções de `resources/views/partials/`, o que mantém cada bloco isolado e fácil de editar.
- **Navegação ativa por scroll**: o componente Alpine `sectionSpy` usa `IntersectionObserver` (só no desktop) para destacar o item do menu da seção visível; as âncoras `atlas`, `programs` e `books` são agrupadas no item "Produtos".
- **Menu mobile com store global**: o estado de abertura fica em `Alpine.store('menu')`, com painel lateral, backdrop e accordion para os produtos.
- **Botões configuráveis por `.env`**: os destinos dos botões vêm de `config/landing.php`, e a classe `App\Support\Landing` (compartilhada com as views como `$landing`) monta cada link. Os botões "Contratar" e os dos livros abrem o WhatsApp com uma mensagem que já cita o produto e o plano do card.
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

Para gerar os assets de produção, use `npm run build` no lugar de `npm run dev`.

## Configuração dos botões

Os links de contato e de acesso ficam no `.env`:

| Variável | Uso |
| --- | --- |
| `LANDING_WHATSAPP` | Número com DDI e DDD (ex.: `5563999999999`). Qualquer caractere que não seja dígito é ignorado. |
| `LANDING_INSTAGRAM_URL` | URL completa do perfil no Instagram. |
| `LANDING_FACEBOOK_URL` | URL completa da página no Facebook. |
| `LANDING_PORTAL_URL` | Destino dos botões "Acessar Link" (portal ou área de acesso). |
| `LANDING_VIDEOS_URL` | Destino dos botões "Acessar Vídeo". |

Quando um valor fica vazio, a página continua sem links quebrados:

- "Contratar" e os botões dos livros levam à seção de contato se não houver WhatsApp.
- "Acessar Link" e "Acessar Vídeo" usam o WhatsApp como alternativa e, sem ele, a seção de contato.
- Na seção de contato, cada card (WhatsApp, redes sociais) só aparece se o canal estiver configurado.

Depois de alterar o `.env` em produção, rode `php artisan config:cache` de novo.

## Estrutura

```
app/Http/Controllers/
  HomeController.php     # retorna a view index
app/Support/
  Landing.php            # monta os links dos botões a partir da config
config/landing.php       # WhatsApp, redes sociais, portal e vídeos (LANDING_*)
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
