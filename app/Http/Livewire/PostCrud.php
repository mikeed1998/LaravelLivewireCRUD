<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Post;

class PostCrud extends Component
{
    // public $posts, $title, $body, $post_id;
    public $title, $body, $post_id;
    public $isModalOpen = 0;
    public $confirmingPostDeletion = false;
    public $postToDelete = null;

    public function render()
    {
        // $this->posts = Post::all();
        // return view('livewire.post-crud');
        $posts = Post::paginate(5);
        return view('livewire.post-crud', ['posts' => $posts]);
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm()
    {
        $this->title = '';
        $this->body = '';
        $this->post_id = null;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'body' => $this->body
        ]);

        session()->flash('message', $this->post_id ? 'Post updated successfully.' : 'Post created successfully.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->body = $post->body;
        
        $this->openModalPopover();
    }

    public function deleteConfirm($id)
    {
        $this->confirmingPostDeletion = true;
        $this->postToDelete = $id;
    }

    public function delete()
    {
        Post::find($this->postToDelete)->delete();
        session()->flash('message', 'Post deleted successfully.');
        $this->confirmingPostDeletion = false;
    }
}
