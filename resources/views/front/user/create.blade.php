Create

@if (session('success'))
    {{ session('success') }}
@endif

<ul>
    <li>
        {{ $data ?? null }}
    </li>
</ul>
