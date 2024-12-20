<div>
    <x-navtab class="mb-3 nav-bordered">

        <!-- formTab -->
        <x-navtab-item class="show active" >

            <x-navtab-link class="rounded-0 active">
                <span class="d-none d-md-block">기본정보</span>
            </x-navtab-link>


            <x-form-hor>
                <x-form-label>활성화</x-form-label>
                <x-form-item>
                    <input type="checkbox" class="form-check-input"
                        wire:model="forms.enable"
                        {{ isset($forms['enable']) && $forms['enable'] ? 'checked' : '' }}>
                </x-form-item>
            </x-form-hor>


            <x-form-hor>
                <x-form-label>타이틀</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"forms.name")
                        ->setWidth("standard")
                    !!}

                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>Provider</x-form-label>
                <x-form-item>

                    <select class="form-select" wire:model="forms.provider">
                        <option value="">선택</option>
                        <option value="google">google</option>
                        <option value="facebook">facebook</option>
                        <option value="naver">naver</option>
                        <option value="kakao">kakao</option>
                        <option value="apple">apple</option>
                        <option value="github">github</option>

                    </select>
                </x-form-item>
            </x-form-hor>



            <x-form-hor>
                <x-form-label>client_id</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"forms.client_id")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>client_secret</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"forms.client_secret")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>callback_url</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"forms.callback_url")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

        </x-navtab-item>


    </x-navtab>
</div>
