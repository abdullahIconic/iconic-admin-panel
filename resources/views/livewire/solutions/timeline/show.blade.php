@section('navbar')
    @livewire('layout.navbar', [
        'title' => $timeline->title,
        'parent' => 'Solution Timeline',
        'parentRoute' => 'solutions.timeline',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$timeline->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Title 1</th>
            <td>{{$timeline->title_1}}</td>
        </tr>
        <tr>
            <th scope="col">Overview 1</th>
            <td>{{$timeline->overview_1}}</td>
        </tr>
        <tr>
            <th scope="col">Title 2</th>
            <td>{{$timeline->title_2}}</td>
        </tr>
        <tr>
            <th scope="col">Overview 2</th>
            <td>{{$timeline->overview_2}}</td>
        </tr>
        <tr>
            <th scope="col">Title 3</th>
            <td>{{$timeline->title_3}}</td>
        </tr>
        <tr>
            <th scope="col">Overview 3</th>
            <td>{{$timeline->overview_3}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $timeline->image_medium)}}" alt="">
            </td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>