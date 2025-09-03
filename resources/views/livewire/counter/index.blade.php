@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Counter',
        'parentRoute' => 'counter',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalCounters }} Counters
    </div>
    <div class="table-responsive-sm">
        <div class="d-flex gap-5 mb-3">
            <div class="d-flex align-items-center">
                <label for="qty" class="me-2">Items:</label>
                <div>
                    <input wire:model="qty" type="text" class="form-control" id="qty">
                </div>
            </div>
            <div class="d-flex align-items-center">
                <label for="counter_for" class="me-2">Counter For:</label>
                <select wire:model="counter_for" class="form-control">
                    <option value="">All</option>
                    <option value="home">Home</option>
                    <option value="solution">Solutions</option>
                </select>
            </div>
            <div class="d-flex align-items-center">
                <label for="searech" class="me-2">Search:</label>
                <div>
                    <input wire:model="keyword" type="text" class="form-control" id="searech" placeholder="Title">
                </div>
            </div>
        </div>
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th scope="col">Label</th>
                    <th scope="col">Counter For</th>
                    <th scope="col">Digit</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($counters as $counter)
                <tr>
                    <td>{{$counter->label}}</td>
                    <td>{{$counter->counter_for}}</td>
                    <td>{{$counter->digit}}</td>
                    <td>
                        <a href="{{route('counter.edit', $counter->id)}}" class="btn bg-warning">Edit</a>
                        <button wire:click="delete({{$counter->id}})" class="btn bg-danger text-white">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($counters,'links') )
            {{ $counters->links() }}
        @endif
    </div>
</div>