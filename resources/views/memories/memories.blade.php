<ul class="list-unstyled">
    @foreach ($memories as $memory)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($memory->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $memory->user->name, ['id' => $memory->user->id]) !!} <span class="text-muted">posted at {{ $memory->created_at }}</span>
                </div>
                <div>
                    {{-- S3の画像のURLから画像として表示する --}}
                    <img src="{{ $memory->image }}" class="img-thumbnail" border="5">
                    
                    <p class="mb-0">{!! nl2br(e($memory->content)) !!}</p>
                </div>
                 <div>
                    @if (Auth::id() == $memory->user_id)
                        {!! Form::open(['route' => ['memories.destroy', $memory->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif
                    @include('memory_favorite.favorite_button', ['user' => $user])
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $memories->render('pagination::bootstrap-4') }}