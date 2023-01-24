<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

final class Categories extends Component
{
    public function render()
    {
        return view('components.categories', [
            'categories' => Category::all(),
        ]);
    }
}
