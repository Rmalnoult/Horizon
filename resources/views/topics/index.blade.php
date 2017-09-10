@extends('layouts.app')

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="panel-title pull-left">topics ({{ $topics->count() }})</h3>
			@if(Auth::check() && Auth::user()->hasRole('admin'))
				<a href="/topics/create" class="btn btn-info pull-right"><span class="fa fa-plus"></span> Ajouter un Sujet</a>
			@endif
			<div class="clearfix"></div>
		</div>

		<table class="table table-striped table-hover" id="topics">
			<thead>
				<tr>
					<th>Statut</th>
					<th>Titre</th>
					<th>Edito</th>
					<th>Articles</th>
					<th>Date de création</th>
					<th class="col-md-2">Actions</th>
				</tr>
			</thead>
			<tbody data-link="row" class="rowlink">
				@forelse($topics as $topic)
					<tr>
						<td>
							@if($topic->published)
								<span class="label label-success">Publié</span>
							@else
								<span class="label label-danger">Non publié</span>
							@endif
						</td>
						<td><a href="/topics/{{ $topic->id }}/edit" title="Edit this topic">{{ $topic->title }}</td>
						<td>{{ str_limit($topic->edito, 50) }}</td>
						<td>{{ $topic->articles()->count() }}</td>
						<td>{{ $topic->created_at }}</td>
						<td class="rowlink-skip">
							<div class="btn-group ">
								<a href="/topics/{{ $topic->id }}/edit" class="btn btn-sm btn-info text-center" title="Edit this topic"><span class="fa fa-pencil"></span></a>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="5">Aucun topic.</td>
					</tr>
				@endforelse
			</tbody>
		</table>

		<div class="panel-footer">
			<div class="text-center">{{$topics->render()}}</div>
		</div>
	</div>
</div>
@endsection

