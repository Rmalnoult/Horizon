@extends('layouts.app')

@section('content')
<h2 class="title-label">Topics</h2>

<div class="container">
	<div id="topics"></div>
</div>
@endsection

@section('scripts')
<script>
	var topics = {!! json_encode($topics); !!};
</script>
<script src="{{ mix('js/topics.js') }}"></script>
@endsection