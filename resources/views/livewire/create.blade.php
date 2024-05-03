<div>
    <input type="text" wire:model="title" placeholder="Title">
    @error('title') <span class="error">{{ $message }}</span> @enderror
    <textarea wire:model="body" placeholder="Body"></textarea>
    @error('body') <span class="error">{{ $message }}</span> @enderror
    <button wire:click="store()">Save</button>
    <button wire:click="closeModalPopover()">Cancel</button>
</div>
