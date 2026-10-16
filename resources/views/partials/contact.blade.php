{{-- Seção Contato --}}
    <section
        id="contact"
        class="relative min-h-screen flex flex-col justify-center items-center py-16 px-6 overflow-hidden light-bg scroll-mt-[80px]" 
        style="--bg-image: url('{{ asset('img/textura.png') }}');">

        <div class="max-w-7xl mx-auto relative z-10 w-full flex flex-col items-center justify-center">

            {{-- Título --}}
            <h2 class="text-white text-4xl md:text-5xl font-medium mb-16 text-center">
                Contato
            </h2>

            @php
                $whatsapp = $landing->whatsapp('Olá! Gostaria de mais informações sobre os sistemas de acupuntura.');
                $instagram = $landing->instagram();
                $facebook = $landing->facebook();
            @endphp

            @if (! $whatsapp && ! $instagram && ! $facebook)
                <p class="text-gray-200 text-lg md:text-xl text-center">
                    Nossos canais de atendimento serão divulgados em breve.
                </p>
            @endif

            {{-- Grid de Cards (Mobile: 1 coluna | Desktop: 2 colunas) --}}
            <div class="grid grid-cols-1 gap-8 w-full {{ $whatsapp && ($instagram || $facebook) ? 'md:grid-cols-2 max-w-4xl' : 'max-w-md' }}">

                {{-- Card 1: Fale conosco (só aparece com WhatsApp configurado) --}}
                @if ($whatsapp)
                <div class="border-2 border-[#2BD885] rounded-lg p-8 md:p-10 flex flex-col items-center justify-center text-center min-h-[280px]"
                    style="background-color: rgba(31, 60, 53, 0.8); box-shadow: 0px 0px 3px 2px rgba(43, 216, 133, 0.35);">

                    <h3 class="text-white text-2xl md:text-3xl font-semibold mb-8">
                        Fale conosco para mais informações
                    </h3>

                    <a {{ $landing->attrs($whatsapp) }} class="bg-[#25D366] hover:bg-[#20BA58] text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-transform transform hover:scale-105 flex items-center gap-3 text-base md:text-lg w-full justify-center">
                        <img src="{{ asset('img/icone.whatsApp.png') }}" alt="" class="w-10 h-10 object-contain">
                        WhatsApp
                    </a>
                </div>
                @endif

                {{-- Card 2: Redes Sociais (só aparece com ao menos uma rede configurada) --}}
                @if ($instagram || $facebook)
                <div class="border-2 border-[#2BD885] rounded-lg p-8 md:p-10 flex flex-col items-center justify-center text-center min-h-[280px]"
                    style="background-color: rgba(31, 60, 53, 0.8); box-shadow: 0px 0px 3px 2px rgba(43, 216, 133, 0.35);">

                    <h3 class="text-white text-2xl md:text-3xl font-semibold mb-8">
                        Nossas redes sociais
                    </h3>

                    <div class="flex flex-col gap-4 w-full">
                        {{-- Botão Instagram --}}
                        @if ($instagram)
                            <a {{ $landing->attrs($instagram) }} class="bg-gradient-to-r from-[#F77737] via-[#D946EF] to-[#1D35D9] hover:opacity-90 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 flex items-center gap-3 text-base md:text-lg w-full justify-center">
                                <img src="{{ asset('img/icone.insta.png') }}" alt="" class="w-10 h-10 object-contain">
                                Instagram
                            </a>
                        @endif

                        {{-- Botão Facebook --}}
                        @if ($facebook)
                            <a {{ $landing->attrs($facebook) }} class="bg-[#1877F2] hover:bg-[#165FD9] text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 flex items-center gap-3 text-base md:text-lg w-full justify-center">
                                <img src="{{ asset('img/icone.face.png') }}" alt="" class="w-10 h-10 object-contain">
                                Facebook
                            </a>
                        @endif
                    </div>
                </div>
                @endif

            </div>

        </div>
    </section>