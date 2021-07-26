<div>

    <x-slot name="header">
        Criar Registro
    </x-slot>

    @if(session()->has('message'))
        <h3>{{ session('message') }}</h3>
    @endif

    <form wire:submit.prevent="createExpense">
        <p>
            <label for="">Descrição do Registro</label>
            <input type="text" name="description" class="shadow border-t" wire:model="description">
            
            @error('description')
                <h5>{{ $message }}</h5>
            @enderror
        </p>

        <p>
            <label for="">Valor do Registro</label>
            <input type="text" name="amount" class="shadow border-t" wire:model="amount">

            @error('amount')
                <h5>{{ $message }}</h5>
            @enderror
        </p>

        <p>
            <label for="">Tipo do Registro</label>
            <select name="type" id="" class="shadow border-t" wire:model="type">
                <option value="">Selecione o tipo do registro</option>
                <option value="1">Entrada</option>
                <option value="2">Saída</option>
            </select>
            @error('type')
                <h5>{{ $message }}</h5>
            @enderror
        </p>
        <button type="submit">Criar Registro</button>
    </form>
</div>
