<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PokemonList extends Component
{
    public $pokemon;

    /**
     * Create a new component instance.
     */
    public function __construct($pokemon)
    {
        $this->pokemon = $pokemon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pokemon-list');
    }
}
