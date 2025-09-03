@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Section Data',
        'parentRoute' => 'section-data',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalSections }} Sections
    </div>
    <div class="table-responsive-sm">
        <div class="d-flex gap-5 mb-3">
            <div class="d-flex align-items-center">
                <label for="qty" class="me-2">Items:</label>
                <div>
                    <input wire:model="qty" type="text" class="form-control" id="qty">
                </div>
            </div>
            {{-- <div class="d-flex align-items-center">
                <label for="qty" class="me-2">Counter For:</label>
                <select wire:model="page_name" class="form-control">
                    <option value="">All</option>
                    <option value="home">Home</option>
                    <option value="services">Services</option>
                    <option value="rental">Rental Service</option>
                    <option value="products">Products</option>
                    <option value="solutions">Solutions</option>
                    <option value="blog">Blog</option>
                    <option value="activities">Activities</option>
                    <option value="offer">Offer</option>
                    <option value="career">Career</option>
                    <option value="team">Team</option>
                    <option value="about">About</option>
                    <option value="contact">Contact</option>
                    <option value="support">Support</option>
                </select>
            </div> --}}
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
                    <th scope="col">Title</th>
                    <th scope="col">Page</th>
                    <th scope="col">Section</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections as $section)
                <tr>
                    <td>{{$section->title}}</td>
                    <td>{{$section->page}}</td>
                    <td>{{$section->section}}</td>
                    <td>
                        <a href="{{route('section-data.show', $section->id)}}" class="btn bg-success text-white">View</a>
                        <a href="{{route('section-data.edit', $section->id)}}" class="btn bg-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($sections,'links') )
            {{ $sections->links() }}
        @endif
    </div>
</div>