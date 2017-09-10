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
								<a href="{{ $article->url }}" target="_blank" style="color: inherit;">
									<div class="row">
										<div class="col-md-2 cover" style="min-height:100px;background-image: url('{{ $article->image  }}')"></div>
										<div class="col-md-10">
											<h4>{{ $article->title }}</h4>
											<p>{{ $article->excerpt }}</p>
										</div>
									</div>
								</a>
							</li>
						@endforeach
					</ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
