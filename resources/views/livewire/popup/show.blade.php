@section('navbar')
    @livewire('layout.navbar', [
        'title' => $popup->title,
        'parent' => 'Popup',
        'parentRoute' => 'popup',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Title</th>
            <td>{{$popup->title}}</td>
        </tr>
        <tr>
            <th scope="col">URL</th>
            <td>{{$popup->url}}</td>
        </tr>
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$popup->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Starting Date</th>
            <td>{{$popup->starting_date}}</td>
        </tr>
        <tr>
            <th scope="col">Ending Date</th>
            <td>{{$popup->ending_date}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $popup->image_medium)}}" alt="">
            </td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>