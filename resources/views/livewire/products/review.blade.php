@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Reviews',
        'parent' => 'Products',
        'parentRoute' => 'products',
        'page' => 'reviews',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalReviews }} Review(s)
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
                <label for="search" class="me-2">Search:</label>
                <div>
                    <input wire:model="keyword" type="text" class="form-control" id="search" placeholder="Comment or Email">
                </div>
            </div>
        </div>
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Title</th>
                    <th scope="col">Reviewer</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                <tr>
                    <td>
                        <img height="50" src="{{asset('storage/'.$review->product->image_small)}}" alt="">
                    </td>
                    <td>{{$review->product->title}}</td>
                    <td>{{$review->name}}</td>
                    <td>{{$review->rating}}</td>
                    <td>{{$review->comment}}</td>
                    <td>
                        @if($review->status == 1)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <button wire:click="toggleStatus({{$review->id}})" class="btn @if($review->status == 1) bg-danger @else bg-success @endif text-white">
                            @if($review->status == 1) Deactivate @else Activate @endif
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($reviews,'links') )
            {{ $reviews->links() }}
        @endif
    </div>
</div>
