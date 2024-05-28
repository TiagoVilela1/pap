{{-- 
    USA UMA LIBRARIA PRA CONVERTER O FORMATO DAS DADAS
    DE 01-01-2004 PARA 1 DE JANEIRA DE 2024
--}}

@php
    use Carbon\Carbon;
@endphp

<div>
    {{-- SE HOUVER UMA EQUIPA SELECIONADA, O BOTÃO APARECE --}}

    @if ($selectedTeam)
        <button wire:click="clearFilter"
            class="h-14 w-full px-4 mb-2 rounded-lg flex items-center justify-center font-bold text-white bg-red-500 hover:bg-red-700">
            <p class="text-sm">REMOVER FILTRO</p>
        </button>
    @endif

    {{-- PERCORRE O ARRAY DAS EQUIPAS E CRIA UM BOTÃO PARA CADA UMA DELAS, CASO O NOME DA EQUIPA SEJA IGUAL AO DA SELECIONADA, A COR DE FUNDO FICA VERDE --}}

    <div class="overflow-x-auto flex flex-row items-center space-x-2 mb-8">
        @foreach ($teams as $team)
            @if ($team === $selectedTeam)
                <button wire:click="filterEmployees('{{ $team }}')"
                    class="h-14 min-w-[250px] px-4 mb-2 rounded-lg flex items-center justify-center font-bold text-white bg-green-500 hover:bg-green-700">
                    <p class="text-sm">{{ $team }}</p>
                </button>
            @else
                <button wire:click="filterEmployees('{{ $team }}')"
                    class="h-14 min-w-[250px] px-4 mb-2 rounded-lg flex items-center justify-center font-bold text-white bg-yellow-500 hover:bg-yellow-700">
                    <p class="text-sm">{{ $team }}</p>
                </button>
            @endif
        @endforeach
    </div>


    <div class="flex flex-wrap items-center justify-between gap-3">
        @foreach ($filteredEmployees as $employee)
            <div class="bg-gray-200 p-4 mb-4 rounded-md lg:w-[470px] w-full">
                @php
                    // CHAMA UMA API QUE RETORNA UMA IMAGEM COM 1 LETRA, NESTE CASO A PRIMEIRA DO NOME
                    $firstLetter = substr($employee->allocations, 0, 1);
                    $finalUrl = "https://ui-avatars.com/api/?name=$firstLetter&color=7F9CF5&background=EBF4FF";

                    // VERIFICA SE O ESTADO É CONTRATADO OU NÃO E MUDA A COR E O TEXTO CONSOANTE ISSO
                    $stateColor =
                        $employee->state === 'HIRED'
                            ? 'text-green-600'
                            : ($employee->state === 'LEFT'
                                ? 'text-red-600'
                                : '');
                    $stateText =
                        $employee->state === 'HIRED'
                            ? 'Empregado'
                            : ($employee->state === 'LEFT'
                                ? 'Desempregado'
                                : $employee->state);

                    // SE O TEXTO DA DATA DE TERMINO FOR Sync with team É TROCADO PARA INDEFINIDO, SENÃO A DATA USANDO A LIBRARIA CARBON
                    if ($employee->start_date === 'Sync with team') {
                        $startDate = 'Indefinido';
                    } else {
                        $startDate = Carbon::parse($employee->start_date)
                            ->locale('pt_BR')
                            ->isoFormat('D [de] MMMM [de] YYYY');
                    }
                    // SE O TEXTO DA DATA DE ENTRADA FOR Sync with team É TROCADO PARA INDEFINIDO, SENÃO A DATA USANDO A LIBRARIA CARBON
                    if ($employee->end_date === 'Sync with team') {
                        $endDate = 'Indefinido';
                    } else {
                        $endDate = Carbon::parse($employee->end_date)
                            ->locale('pt_BR')
                            ->isoFormat('D [de] MMMM [de] YYYY');
                    }
                @endphp

                <div class="flex items-center mb-4">
                    <img src="{{ $finalUrl }}" alt="{{ $employee->allocations }}"
                        class="rounded-full h-20 w-20 object-cover mr-4">

                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-2">
                            <h1 class="m-0 text-xl font-bold">{{ $employee->allocations }} -</h1>
                            <h1 class="m-0 text-xl font-bold {{ $stateColor }}">{{ $stateText }}</h1>
                        </div>

                        {{-- USA O MAILTO POIS ASSIM AO CLICAR É REDIRECIONADO PARA O EMAIL DIRETAMENTE --}}
                        <a href="mailto:{{ $employee->email }}">
                            <p class="m-0 text-lg text-gray-600">{{ $employee->email }}</p>
                        </a>
                    </div>
                </div>

                <h1 class="m-0 text-sm font-bold">Código da Firma: {{ $employee->employee_id }}</h1>
                <h1 class="m-0 text-sm font-bold">Equipa: {{ $employee->team }}</h1>
                <h1 class="m-0 text-sm font-bold">Localização: {{ $employee->location }}</h1>
                <h1 class="m-0 text-sm font-bold mt-4">Skill: {{ $employee->skill }}</h1>
                <h1 class="m-0 text-sm font-bold">Classificação: {{ $employee->classification }}</h1>
                <h1 class="m-0 text-sm font-bold">Escritório: {{ $employee->office }}</h1>
                <h1 class="m-0 text-sm font-bold">Seniority: {{ $employee->seniority }}</h1>

                <h1 class="m-0 text-sm font-bold mt-4">Esfera: {{ $employee->sphere }}</h1>
                <h1 class="m-0 text-sm font-bold">Código de Encomenda: {{ $employee->billing_code }}</h1>

                <div class="mt-4">
                    <h1 class="m-0 text-sm font-bold">Encomenda: {{ $employee->order }}</h1>
                    <h1 class="m-0 text-sm font-bold">Descrição: {{ $employee->invoice_desc }}</h1>
                    <h1 class="m-0 text-sm font-bold">Desconto: {{ $employee->discount }}</h1>
                    <h1 class="m-0 text-sm font-bold">Avaliação: {{ $employee->rate }}</h1>
                </div>


                <div class="flex gap-1 items-center mt-4">
                    <h1 class="text-sm">Salário: {{ $employee->value }}</h1>
                    <h1 class="text-sm">{{ $employee->currency }}</h1>
                </div>

                <div class="flex flex-col">
                    <h1 class="text-sm m-0">Notas: {{ $employee->notes }}</h1>
                    <h1 class="text-sm m-0">Marcado: {{ $employee->flagged }}</h1>
                </div>

                <div class="flex items-center gap-2 mt-3">
                    <h1 class="text-sm font-bold text-blue-700">{{ $startDate }}</h1>
                    <h1 class="text-sm">-</h1>
                    <h1 class="text-sm font-bold text-red-700">{{ $endDate }}</h1>
                </div>
            </div>
        @endforeach
    </div>
</div>
