@extends('layouts.app')

@section('content')
<br>
<div class="">
	<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
		<p class="text-center">Horizon vous propose d'explorer des sujets actuels en sortant de votre zone de confort. De l'exteme gauche à l'extreme droite, en passant par l'international, explorez les points de vue qui vous entourent.</p>
	</div>
</div>
<br>
<br>
<br>

<div id="topics"></div>
@endsection

@section('scripts')
<script>
	var categories = {!! $categories; !!};
</script>
<script src="{{ mix('js/topics.js') }}"></script>
@endsection