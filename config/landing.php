<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Contatos e links da landing page
    |--------------------------------------------------------------------------
    |
    | Valores usados pelos botões da página (Contratar, Acessar Link, Acessar
    | Vídeo, WhatsApp e redes sociais). Quando um valor fica vazio, o botão
    | correspondente cai para um destino alternativo ou deixa de ser exibido,
    | nunca gera link quebrado.
    |
    */

    // Número com DDI e DDD, só dígitos (ex.: 5563999999999).
    'whatsapp' => env('LANDING_WHATSAPP', ''),

    'instagram_url' => env('LANDING_INSTAGRAM_URL', ''),

    'facebook_url' => env('LANDING_FACEBOOK_URL', ''),

    // Destino dos botões "Acessar Link" (portal / área de acesso).
    'portal_url' => env('LANDING_PORTAL_URL', ''),

    // Destino dos botões "Acessar Vídeo" (ex.: canal ou playlist).
    'videos_url' => env('LANDING_VIDEOS_URL', ''),

];
