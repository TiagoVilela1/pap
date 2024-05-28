<form wire:submit.prevent="save" class="flex flex-col items-start justify-start">
    <div>
        <label for="file" class="text-center text-2xl">Importar ficheiro: {{ $fileName }}</label>
        <input type="file" id="file" wire:model="file" class="hidden"
            onchange="document.getElementById('file').nextElementSibling.innerText = this.files[0].name">
    </div>

    <button
        class="mt-4 px-4 mb-2 rounded-lg flex items-center justify-center font-bold text-white bg-yellow-500 hover:bg-yellow-700 h-12 w-full"
        type="submit">Importar</button>
</form>
