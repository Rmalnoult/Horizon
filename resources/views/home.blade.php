@extends('layouts.app')

@section('content')
<br>
<div class="">
	<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
		<!-- <p class="text-center">Avant de vous faire un avis, diversifiez vos points de vue.</p> -->
		<div class="panel panel-default">
			<div class="panel-body">
				<p class="text-center" style="margin-bottom: 20px;"><big>Avant de vous faire un avis, diversifiez vos points de vue !</big></p>
				<p class="text-center">Horizon vous propose d'explorer les sujets actuels à travers la presse de différents bords politiques.</p>
				<p class="text-center">Luttons ensemble pour l'éclairage des lanternes. <span class="fa fa-lightbulb-o fa-2x"></span></p>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>


<div id="topics"></div>
@endsection

@section('scripts')
<script>
	var categories = {!! $categories; !!};
</script>
<script src="{{ mix('js/topics.js') }}"></script>
@endsection