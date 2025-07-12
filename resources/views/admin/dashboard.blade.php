{{-- admin.dashboard --}}
<h1 class="text-2xl">Welcome, mighty admin!</h1>


<form method="POST" action="{{ route('logout') }}" class="inline">
    @csrf
    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">
        Logout
    </button>
</form>
