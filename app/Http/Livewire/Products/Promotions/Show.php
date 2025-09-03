<?php

namespace App\Http\Livewire\Products\Promotions;

use Livewire\Component;
use App\Models\ProductPromotion;

class Show extends Component
{
    public $promotion;

    public function mount(ProductPromotion $promotion)
    {
        $this->promotion = $promotion;
    }

    public function delete()
    {
        $this->promotion->delete();
        return redirect(route('products.promotions.index'));
    }

    public function render()
    {
        return view('livewire.products.promotions.show')->extends('layouts.panel');
    }
}
