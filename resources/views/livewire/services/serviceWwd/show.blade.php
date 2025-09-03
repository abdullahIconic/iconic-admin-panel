@section('navbar')
    @livewire('layout.navbar', [
        'title' => $work->title,
        'parent' => 'What We Delivered',
        'parentRoute' => 'services.what-we-delivered',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$work->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Title</th>
            <td>{{$work->title}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $work->image_medium)}}" alt="">
            </td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>