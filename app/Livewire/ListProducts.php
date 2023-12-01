<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Http\Request;

class ListProducts extends Component
{
    public $moreValues = [1], $addPost = false, $updatePost = false;

    public $title, $postId, $comment = [], $values = [];

    protected $rules = [
        'values.*' => 'required|string',
        'title' => 'required'
    ];

    public function render()
    {
        $posts = Post::all();
        return view('livewire.list-products', compact('posts'));
    }

    protected function clearForm()
    {
        $this->comment = '';
    }

    public function addRowForValue()
    {
        $this->moreValues[] += 1;
    }

    public function removeRowForValue($key)
    {
        unset($this->moreValues[$key]);
    }

    public function addBtn()
    {
        $this->addPost = true;
    }

    public function store()
    {
        $variation = new Post;
        $variation->title = $this->title;
        $variation->comment = implode(',', $this->values);
        $variation->save();
    }

    public function editPost($id)
    {
        try {
            $post = Post::findOrFail($id);
            if (!$post) {
                session()->flash('error', 'Post not found');
            } else {
                $this->values = explode(',', trim($post->comment));
                $this->postId = $post->id;
                $this->updatePost = true;
                $this->addPost = false;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function updatePostData()
    {
        $variation = Post::whereId($this->postId)->first();
        $variation->title = $this->title;
        $variation->comment = implode(',', $this->values);
        $variation->save();
        $this->updatePost = false;
    }

    public function deletePost($id)
    {
        try {
            Post::find($id)->delete();
            session()->flash('success', "Post Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
