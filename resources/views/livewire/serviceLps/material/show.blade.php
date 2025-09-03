@section('navbar')
    @livewire('layout.navbar', [
        'title' => $material->title,
        'parent' => 'LPS Materials',
        'parentRoute' => 'lps.materials',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$material->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Title</th>
            <td>{{$material->title}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $material->image_medium)}}" alt="">
            </td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>