@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($topics as $topic)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>{{ $topic->title }}</h3></div>
					<ul class="list-group">
						@foreach($topic->articles as $index => $article)
							@if($index != 0) <hr> @endif
							<li class="list-group-item">
								<div class="col-md-2 cover"></div>
								<div class="col-md-10">
									<h4>{{ $article->title }}</h4>
								</div>
							</li>
						@endforeach
					</ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
