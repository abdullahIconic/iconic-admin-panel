@section('navbar')
    @livewire('layout.navbar', [
        'title' => $card->title,
        'parent' => 'LPS Cards',
        'parentRoute' => 'lps.cards',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$card->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Title</th>
            <td>{{$card->title}}</td>
        </tr>
        @if($card->card_type == "image")
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $card->image_medium)}}" alt="">
            </td>
        </tr>
        @else
        <tr>
            <th scope="col">Video</th>
            <td>
                <iframe src="{{$card->url}}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" width="100%" height="300px" frameborder="0"></iframe>
            </td>
        </tr>
        @endif
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>