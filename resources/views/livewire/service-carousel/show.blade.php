@section('navbar')
    @livewire('layout.navbar', [
        'title' => $carousel->title,
        'parent' => 'Service Carousel',
        'parentRoute' => 'service-carousel',
        'page' => 'show',
    ])
@endsection

<div>
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Is Visible</th>
                <td>{{$carousel->visible ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <th scope="col">Carousel For</th>
                <td>{{$carousel->carousel_for}}</td>
            </tr>
            <tr>
                <th scope="col">Title</th>
                <td>{{$carousel->title}}</td>
            </tr>
            <tr>
                <th scope="col">Overview</th>
                <td>{{$carousel->overview}}</td>
            </tr>
            <tr>
                <th scope="col">Target URL</th>
                <td>{{$carousel->url}}</td>
            </tr>
        </table>
    </div>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>