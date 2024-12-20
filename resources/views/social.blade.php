<x-ui-divider>
    <span class="text-body-emphasis fw-medium text-nowrap mx-4">
        소셜 로그인
    </span>
</x-ui-divider>

@php
    $provider = DB::table('user_oauth_providers')
        ->where('enable', 1)
        ->get();
@endphp

@if (session('error'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <div class="alert-message">
            {{ session('error') }}
        </div>
    </div>
@endif


@if (count($provider) > 0)
    {{-- Social Login Link --}}
    <div class="flex justify-center items-center space-x-4">
        <div class="d-flex flex-column flex-sm-row gap-3 pb-4 mb-3 mb-lg-4">
            @foreach ($provider as $item)
                @if($item->provider == 'google')
                <a class="btn btn-lg btn-outline-secondary w-100 px-2"
                    href="/login/{{$item->provider}}">
                    <i class="ci-google ms-1 me-1"></i>
                    {{ $item->name }}
                </a>
                @elseif($item->provider == 'kakao')
                <a class="btn btn-lg btn-outline-secondary w-100 px-2"
                    href="/login/{{$item->provider}}">

                    {{ $item->name }}
                </a>
                @else
                <a class="btn btn-lg btn-outline-secondary w-100 px-2"
                    href="/login/{{$item->provider}}">
                    {{ $item->name }}
                </a>
                @endif
            @endforeach
        </div>
    </div>
@endif

{{-- <div class="d-flex flex-column flex-sm-row gap-3 pb-4 mb-3 mb-lg-4">
    <button type="button" class="btn btn-lg btn-outline-secondary w-100 px-2">

        Google
    </button>
    <button type="button" class="btn btn-lg btn-outline-secondary w-100 px-2">
        <i class="ci-facebook ms-1 me-1"></i>
        Facebook
    </button>
    <button type="button" class="btn btn-lg btn-outline-secondary w-100 px-2">
        <i class="ci-apple ms-1 me-1"></i>
        Apple
    </button>
</div> --}}
