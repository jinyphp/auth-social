<x-wire-table>
    <x-wire-thead>
        {{-- 테이블 제목 --}}
        <th width='200'>provider</th>
        <th width='200'>user_id</th>
        <th>이메일</th>
        <th>oauth_id</th>
        <th width='200'>등록일자</th>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            <x-wire-tbody-item :selected="$selected" :item="$item">
                {{-- 테이블 리스트 --}}
                <td width='200'>
                    {{$item->provider}}
                </td>
                <td>
                    {{$item->user_id}}
                </td>
                <td>
                    {{$item->email}}
                </td>
                <td>
                    {{$item->oauth_id}}
                </td>
                <td width='200'>{{$item->created_at}}</td>

            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>

