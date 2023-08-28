Index

<script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.3.0/firebase-app.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.3.0/firebase-analytics.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries
  
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
      apiKey: "AIzaSyCQfL5_3eHDBp5mtlDB8KRZeSwY7X1FJ8g",
      authDomain: "autofill-access.firebaseapp.com",
      projectId: "autofill-access",
      storageBucket: "autofill-access.appspot.com",
      messagingSenderId: "324406055777",
      appId: "1:324406055777:web:4034c5a5de9c59a08c2b20",
      measurementId: "G-X8KZ33H1GB"
    };
  
    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
  </script>

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

<img src="{{ asset('assets/icons/add_fill.svg') }}" width="90" height="90" alt="SVG画像" />
