<x-modal wire:model="modal" title="Upload Video">
    <x-slot:actions>
        <x-button label="Cancel" @click="$wire.myModal = false" />
        <x-button label="Confirm" class="btn-primary" />
    </x-slot:actions>
</x-modal>
