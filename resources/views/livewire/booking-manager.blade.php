<div>
    <div class="p-4 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-bold mb-4">Réserver cette propriété</h2>

        <div>
            <label for="start_date">Date de début :</label>
            <input type="date" id="start_date" wire:model="start_date" class="border p-2 rounded w-full">
            @error('start_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mt-2">
            <label for="end_date">Date de fin :</label>
            <input type="date" id="end_date" wire:model="end_date" class="border p-2 rounded w-full">
            @error('end_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button wire:click="book" class="mt-4 bg-primary text-white p-2 rounded">Réserver</button>

        @if ('$message')
            <div class="mt-2 text-green-600 font-semibold">{{ '$message' }}</div>
        @endif
    </div>

</div>
