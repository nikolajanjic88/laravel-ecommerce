<section style="background-color: #eee;">
    <div class="container my-5 py-5">
    @if (count($comments) > 0)
        @foreach ($comments as $comment)
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="fw-bold text-primary mb-1">{{ $comment->user->name }}
                        </h6>
                        <p><i>{{ $comment->created_at }}</i></p>
                    </div>
                    @if ($comment->user_id === Auth::user()->id)
                    <div>
                        <form action="{{ route('product.delete-comment', $comment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $comment->id }}">
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    @endif
                </div>
                <p class="mt-3 mb-4 pb-2">
                    {{ $comment->body }}
                </p>
            </div>
        </div>
       @endforeach
    @else
        <h3>No Comments</h3>
    @endif
        <div class="mt-6 p-4">
            {{$comments->links()}}
        </div>
        <form action="{{ route('product.comment', $product->id) }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div data-mdb-input-init class="form-outline w-100 mt-5">
                <textarea name="body" class="form-control" id="textAreaExample" rows="4"
                style="background: #fff;"></textarea>
                <label class="form-label" for="textAreaExample">Message</label>
            </div>
            @error('body')
                <div class="text-danger text-center">{{ $message }}</div>
            @enderror
            <div class="float-end mt-2 pt-1">
                <button class="btn btn-primary btn-sm">Post comment</button>
            </div>
        </form>
    </div>
</section>
