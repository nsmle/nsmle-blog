<?php

namespace App\View\Components\Card;

use Illuminate\View\Component;

class PostCard extends Component
{
    public $post;
    
    public $page;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post, $page = null)
    {
        $this->post = $post;
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card.post-card');
    }
}
