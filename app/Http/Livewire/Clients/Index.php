<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Client;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalClients;

    public function mount()
    {
        $this->totalClients = Client::count();
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
        $this->totalClients = Client::where(function ($query) {
            $query->where('name', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.clients.index', [
            'clients' => Client::where(function ($query) {
                $query->where('name', 'like', '%'.$this->keyword.'%');
            })->orderByDesc('id')->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
