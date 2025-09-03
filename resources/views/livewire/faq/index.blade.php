@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Faq',
        'parentRoute' => 'faq',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalFaqs }} Faqs
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
                <label for="searech" class="me-2">Search:</label>
                <div>
                    <input wire:model="keyword" type="text" class="form-control" id="searech" placeholder="Title">
                </div>
            </div>
        </div>
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Faq For</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq)
                <tr>
                    <td>{{$faq->question}}</td>
                    <td>{{$faq->faq_for}}</td>
                    <td>
                        <a href="{{route('faq.edit', $faq->id)}}" class="btn bg-warning">Edit</a>
                        <button wire:click="delete({{$faq->id}})" class="btn bg-danger text-white">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($faqs,'links') )
            {{ $faqs->links() }}
        @endif
    </div>
</div>