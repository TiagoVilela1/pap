<x-app-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            {{-- CHAMA O COMPONENTE DO LOGO --}}

            <div>
                <x-authentication-card-logo />
            </div>

            <div class="w-full max-w-5xl mt-6 p-6 bg-white shadow-md rounded-lg prose">
                @if (count($employees) <= 0)
                    {{-- VERIFICA SENÃO HÁ DADOS --}}

                    <h1 class="text-center text-2xl">Não há dados ...</h1>
                    <a href="{{ route('import') }}" class="no-underline">
                        <button
                            class="px-4 mb-2 rounded-lg flex items-center justify-center font-bold text-white bg-yellow-500 hover:bg-yellow-700 h-12 w-full">Página
                            para Importar</button>
                    </a>
                @else
                    {{-- CHAMA O COMPONENT LIVEWIRE PARA TER RESPOSTAS EM TEMPO REAL SEM TER QUE DAR REFRESH À PÁGINA --}}

                    @livewire('view-data', ['employees' => $employees, 'teams' => $teams])
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
