<?php

namespace App\Support;

use Illuminate\Support\HtmlString;

/**
 * Monta os destinos dos botões da landing a partir de config/landing.php.
 *
 * Todos os métodos devolvem uma URL válida ou null, para a view decidir
 * entre exibir o botão ou escondê-lo.
 */
class Landing
{
    /** Link wa.me com mensagem pré-preenchida, ou null sem número configurado. */
    public function whatsapp(string $message = ''): ?string
    {
        $number = preg_replace('/\D+/', '', (string) config('landing.whatsapp'));

        if ($number === '') {
            return null;
        }

        $url = 'https://wa.me/'.$number;

        return $message === '' ? $url : $url.'?text='.rawurlencode($message);
    }

    public function instagram(): ?string
    {
        return $this->url('landing.instagram_url');
    }

    public function facebook(): ?string
    {
        return $this->url('landing.facebook_url');
    }

    /** Portal configurado; sem ele, WhatsApp com a mensagem; sem os dois, a seção de contato. */
    public function portal(string $fallbackMessage): string
    {
        return $this->url('landing.portal_url')
            ?? $this->whatsapp($fallbackMessage)
            ?? '#contact';
    }

    /** Vídeos configurados; sem eles, WhatsApp com a mensagem; sem os dois, a seção de contato. */
    public function videos(string $fallbackMessage): string
    {
        return $this->url('landing.videos_url')
            ?? $this->whatsapp($fallbackMessage)
            ?? '#contact';
    }

    /** Botões de compra: WhatsApp com a mensagem do plano, ou a seção de contato. */
    public function purchase(string $message): string
    {
        return $this->whatsapp($message) ?? '#contact';
    }

    /**
     * Atributos href (escapado) e, para links externos, target/rel de nova aba.
     * Uso na view: <a {{ $landing->attrs($url) }} class="...">.
     */
    public function attrs(string $url): HtmlString
    {
        $attrs = 'href="'.e($url).'"';

        if (str_starts_with($url, 'http')) {
            $attrs .= ' target="_blank" rel="noopener noreferrer"';
        }

        return new HtmlString($attrs);
    }

    private function url(string $key): ?string
    {
        $value = trim((string) config($key));

        return filter_var($value, FILTER_VALIDATE_URL) ? $value : null;
    }
}
