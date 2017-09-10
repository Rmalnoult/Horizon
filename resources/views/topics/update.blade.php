@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">{{ $topic->title }}</h2>
    {{ Form::open(array('url' => '/topics/'.$topic->id, 'method' => 'PUT', 'class' => 'form-horizontal')) }}
        <div id="articles"></div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Modifier le sujet et l'édito</h4></div>
                    <div class="panel-body">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Titre</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $topic->title }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('edito') ? ' has-error' : '' }}">
                            <label for="edito" class="col-md-4 control-label">Édito</label>

                            <div class="col-md-6">
                                <textarea name="edito" id="edito" cols="30" rows="10" class="form-control">{{ nl2br($topic->edito) }}</textarea>
                                @if ($errors->has('edito'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('edito') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="published" {{ $topic->published ? 'checked' : '' }}> Sujet Publié
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary">
                                <span class="fa fa-save"></span> Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>
@endsection

@section('scripts')
<script>
    var articles = {!! $topic->articles->toJson() !!};
</script>
<script>
	var Articles = new Vue({
		el: '#articles',
        template: `
            <div class="row">
                <input type="hidden" name="encodedArticles" :value="encodedArticles" />
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Articles</h4>
                        </div>
                        <div class="panel-body">
                            <div v-for="article in articles">
                                <div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="source" class="col-md-4 control-label text-right">Source</label>
                                            <div class="col-md-6">
                                                <input id="source" type="text" class="form-control" name="articles[index].source" v-model="article.source">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-md-4 control-label text-right">Titre</label>
                                            <div class="col-md-6">
                                                <input id="title" type="text" class="form-control" name="articles[index].title" v-model="article.title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="url" class="col-md-4 control-label text-right">URL</label>
                                            <div class="col-md-6">
                                                <input id="url" type="text" class="form-control" name="articles[index].url" v-model="article.url">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="image" class="col-md-4 control-label text-right">Image URL</label>
                                            <div class="col-md-6">
                                                <input id="image" type="text" class="form-control" name="articles[index].image" v-model="article.image">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="excerpt" class="col-md-4 control-label text-right">Extrait</label>
                                            <div class="col-md-6">
                                                <textarea id="excerpt" type="text" class="form-control" v-model="article.excerpt"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                            <span v-on:click="AddArticle" class="btn btn-default"><span class="fa fa-plus"></span> Ajouter un article</span>
                        </div>
                    </div>
                </div>
            </div>
        `,
		data: {
            articles: articles,
		},
        computed: {
            encodedArticles: function () {
                return JSON.stringify(this.articles);
            }
        },
        mounted: function () {
        },
        methods: {
            AddArticle: function () {
                this.articles.push({
                    'id': null,
                    'title': '',
                    'url': '',
                    'source': '',
                    'image': '',
                    'excerpt': '',
                })
            }
        }
	});
</script>
@endsection
