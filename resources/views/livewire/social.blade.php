<div>

    {{-- Social Login Link --}}
    @if(count($providers)>0)
        @foreach($providers as $item)


        <div class="d-grid mt-3">
            {{-- <a href="{{route('oauth-redirect',$item->name)}}" class="btn btn-google"> --}}
            <a href="/login/{{$item}}" class="btn btn-google">
                <span class="me-3">
                    @includeIf("social::icons.".$item)
                </span>
                Continue with {{ $item }}
            </a>
        </div>
        @endforeach
    @endif

</div>
