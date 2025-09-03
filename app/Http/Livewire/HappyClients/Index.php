<?php

namespace App\Http\Livewire\HappyClients;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\HappyClient;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalClients;

    public function mount()
    {
        $this->totalClients = HappyClient::count();
    }

    public function updatingQty()
    {
        $this->resetPage();
    }

    public function updatingKeyword()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->totalClients = HappyClient::where(function ($query) {
            $query->where('name', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.happy-clients.index', [
            'clients' => HappyClient::where(function ($query) {
                $query->where('name', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
