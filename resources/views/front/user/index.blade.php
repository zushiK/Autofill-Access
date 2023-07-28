Index

@if (session('success'))
    {{ session('success') }}
@endif

<button>
    <a href="{{ route('user.create') }}">
        新規作成
    </a>
</button>

<ul>
    @foreach ($datas as $item)
        <li>
            <a href="{{ route('user.show', ['id' => $item->id]) }}">
                {{ $item }}
            </a>
        </li>
    @endforeach
</ul>
