{{ auth()->guard('web')->user() }}
ダッシュボード

<a href="{{ route('logout') }}">
    <button>ログアウト</button>
</a>
