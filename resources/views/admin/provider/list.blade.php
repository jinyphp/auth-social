@php
    $total_users = user_count();;
@endphp
<x-wire-table>
    <x-wire-thead>
        {{-- 테이블 제목 --}}
        <th width='200'>이름/provider</th>
        <th>client_id / callback</th>
        <th width='100'>users</th>
        <th width='100'>% Percent</th>
        <th width='200'>등록일자</th>
    </x-wire-thead>
    <tbody>
        @if (!empty($rows))
            @foreach ($rows as $item)
                <x-wire-tbody-item :selected="$selected" :item="$item">
                    {{-- 테이블 리스트 --}}
                    <td width='200'>
                        <x-link-void wire:click="edit({{ $item->id }})">
                            {{ $item->name }}
                        </x-link-void>

                        <span class="badge bg-primary">
                            {{ $item->provider }}
                        </span>
                    </td>

                    <td>
                        {{ Str::substr($item->client_id, $start = 0, $length = 30) . '*****' }}
                        <div>
                            {{ $item->callback_url }}
                        </div>
                    </td>
                    <td width='100'>
                        <a href="/admin/auth/oauth/users">
                            {{ $item->users }} of {{ $total_users }}
                        </a>
                    </td>
                    <td class="d-none d-xl-table-cell">
                        @php
                            $percent = $item->users / $total_users * 100;
                            $percent = round($percent, 2);
                        @endphp
                        <div class="progress">
                            <div class="progress-bar bg-primary"
                                role="progressbar" style="width: {{ $percent }}%"
                                aria-valuenow="{{ $percent }}" aria-valuemin="0"
                                aria-valuemax="100">{{ $percent }}%</div>
                        </div>
                    </td>
                    <td width='200'>{{ $item->created_at }}</td>

                </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>
