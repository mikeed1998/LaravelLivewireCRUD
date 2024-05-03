<div>
    <button wire:click="create()">Create Post</button>
    
    @if($isModalOpen)
        @include('livewire.create')
    @endif

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>
                            <button wire:click="edit({{ $post->id }})">Edit</button>
                            <button wire:click="deleteConfirm({{ $post->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <p>No hay ningún post disponible.</p>
            @endif
        </tbody>
    </table>

    {{ $posts->links() }}
    
    @if ($confirmingPostDeletion)
        <div>
            Are you sure you want to delete this post?
            <button wire:click="delete">Yes</button>
            <button wire:click="$set('confirmingPostDeletion', false)">No</button>
        </div>
    @endif
</div>
