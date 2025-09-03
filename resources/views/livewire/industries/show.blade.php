@section('navbar')
    @livewire('layout.navbar', [
        'title' => $industry->title,
        'parent' => 'Industries',
        'parentRoute' => 'industries',
        'page' => 'show',
    ])
@endsection

<div>
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Title</th>
                <td>{{$industry->title}}</td>
            </tr>
            <tr>
                <th scope="col">Is Visible</th>
                <td>{{$industry->visible ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <th scope="col">Description</th>
                <td>{!!$industry->description!!}</td>
            </tr>
            <tr>
                <th scope="col">Overview</th>
                <td>{!!$industry->overview!!}</td>
            </tr>
            <tr>
                <th scope="col">Solution Overview</th>
                <td>{!!$industry->solution_overview!!}</td>
            </tr>
            <tr>
                <th scope="col">Project Overview</th>
                <td>{!!$industry->project_overview!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Title</th>
                <td>{!!$industry->meta_title!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Description</th>
                <td>{!!$industry->meta_description!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Keywords</th>
                <td>{!!$industry->meta_keywords!!}</td>
            </tr>
            <tr>
                <th scope="col">Image</th>
                <td>
                    <img src="{{asset('storage/' . $industry->image_small)}}" alt="">
                </td>
            </tr>
        </table>
    </div>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>
