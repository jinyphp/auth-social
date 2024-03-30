<div>
    <x-navtab class="mb-3 nav-bordered">

        @foreach ($forms as $provider => $form)
            @php
                if($loop->first) $active = "active"; else $active = "";
            @endphp

        @if(is_array($form))
        <x-navtab-item class="show {{$active}}">
            <x-navtab-link class="rounded-0 {{$active}}">
                <span class="d-none d-md-block">{{$provider}}</span>
            </x-navtab-link>


            @foreach($form as $key => $item)

            @if($key == "enable")
            <x-form-hor>
                <x-form-label>{{$key}}</x-form-label>
                <x-form-item>
                    {!! xCheckbox()
                        ->setWire('model.defer',"forms.".$provider.".".$key)
                    !!}
                </x-form-item>
            </x-form-hor>
            @else
            <x-form-hor>
                <x-form-label>{{$key}}</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"forms.".$provider.".".$key)
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>
            @endif
            @endforeach


        </x-navtab-item>
        @endif
        @endforeach
    </x-navtab>
</div>
