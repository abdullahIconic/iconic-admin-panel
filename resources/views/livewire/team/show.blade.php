@section('navbar')
    @livewire('layout.navbar', [
        'title' => $member->title,
        'parent' => 'Team',
        'parentRoute' => 'team',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Name</th>
            <td>{{$member->name}}</td>
        </tr>
        <tr>
            <th scope="col">Designation</th>
            <td>{{$member->designation}}</td>
        </tr>
        <tr>
            <th scope="col">Email</th>
            <td>{{$member->email}}</td>
        </tr>
        <tr>
            <th scope="col">Facebook</th>
            <td>{{$member->facebook}}</td>
        </tr>
        <tr>
            <th scope="col">Twitter</th>
            <td>{{$member->twitter}}</td>
        </tr>
        <tr>
            <th scope="col">LinkedIn</th>
            <td>{{$member->linkedin}}</td>
        </tr>
        <tr>
            <th scope="col">Visible</th>
            <td>{{$member->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Is Expert</th>
            <td>{{$member->expert ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Expert In</th>
            <td>{{$member->expert_in}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $member->image_small)}}" alt="">
            </td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>