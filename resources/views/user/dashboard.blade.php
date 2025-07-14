@extends('layouts.app')

@section('content')
<!-- Pass Laravel user to Vue -->
<script>
  window.Laravel = {
    user: @json(Auth::user())
  };
</script>

<div id="app">
  <!-- Vue Router will inject the current component here -->
  <router-view></router-view>
</div>
@endsection
