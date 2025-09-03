@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'LPS Cards',
        'parentRoute' => 'lps.cards',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalCards }} Cards
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
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Title</th>
                    <th scope="col">Visible</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cards as $card)
                <tr>
                    <td>
                        @if($card->card_type == "image")
                        <img height="50" src="{{asset('storage/'.$card->image_small)}}" alt="">
                        @else
                        <iframe src="{{$card->url}}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" width="200" height="100" frameborder="0"></iframe>
                        @endif
                    </td>
                    <td>{{$card->title}}</td>
                    <td>{{$card->visible ? "Yes" : "No"}}</td>
                    <td>
                        <a href="{{route('lps.cards.show', $card->id)}}" class="btn bg-success text-white">View</a>
                        <a href="{{route('lps.cards.edit', $card->id)}}" class="btn bg-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($cards,'links') )
            {{ $cards->links() }}
        @endif
    </div>
</div>