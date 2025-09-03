<?php

namespace App\Http\Livewire\Counter;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Counter;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $counter_for = '';
    public $keyword = '';
    public $totalCounters;

    public function mount()
    {
        $this->totalCounters = Counter::count();
    }

    public function updatingQty()
    {
        $this->resetPage();
    }

    public function updatingKeyword()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Counter::find($id)->delete();
        return redirect(route('counter.index'));
    }

    public function render()
    {
        $this->totalCounters = Counter::where(function ($query) {
            $query->where('label', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.counter.index', [
            'counters' => Counter::where(function ($query) {
                $query->where('label', 'like', '%'.$this->keyword.'%');
            })->where(function ($query) {
                if($this->counter_for){
                    $query->where('counter_for', $this->counter_for);
                }
            })
            ->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
