@extends('layouts.app')

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="panel-title pull-left">Catégories ({{ $categories->count() }})</h3>
			@if(Auth::check() && Auth::user()->hasRole('admin'))
				<a href="/categories/create" class="btn btn-info pull-right"><span class="fa fa-plus"></span> Ajouter une catégorie</a>
			@endif
			<div class="clearfix"></div>
		</div>

		<table class="table table-striped table-hover" id="categories">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Color</th>
					<th>NB de topics</th>
					<th>Date de création</th>
					<th class="col-md-2">Actions</th>
				</tr>
			</thead>
			<tbody data-link="row" class="rowlink">
				@forelse($categories as $category)
					<tr>
						<td><a href="/categories/{{ $category->id }}/edit" title="Edit this category">{{ $category->name }}</td>
						<td>{{ $category->color }}</td>
						<td>{{ $category->topics()->count() }}</td>
						<td>{{ $category->created_at }}</td>
						<td class="rowlink-skip">
							<div class="btn-group ">
								<a href="/categories/{{ $category->id }}/edit" class="btn btn-sm btn-info text-center" title="Edit this category"><span class="fa fa-pencil"></span></a>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="5">Aucune categorie.</td>
					</tr>
				@endforelse
			</tbody>
		</table>

		<div class="panel-footer">
			<div class="text-center">{{$categories->render()}}</div>
		</div>
	</div>
</div>
@endsection

