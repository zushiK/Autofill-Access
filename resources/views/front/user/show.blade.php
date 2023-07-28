Show

@if (session('success'))
    {{ session('success') }}
@endif

<button>
    <a href="{{ route('user.edit', ['id' => $data->id]) }}">
        編集
    </a>
</button>

<button>
    <a href="{{ route('user.delete', ['id' => $data->id]) }}">
        削除
    </a>
</button>

<ul>
    <li>
        {{ $data }}
    </li>
</ul>
