@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">{{ $category->title }}</h2>
    {{ Form::open(array('url' => '/categories/'.$category->id, 'method' => 'PUT', 'class' => 'form-horizontal')) }}
        <div id="articles"></div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Modifier le sujet et l'édito</h4></div>
                    <div class="panel-body">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nom</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $category->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Image URL</label>

                            <div class="col-md-6">
                                <input id="image" type="text" class="form-control" name="image" value="{{ $category->image }}" required autofocus>

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                            <label for="color" class="col-md-4 control-label">Couleur</label>

                            <div class="col-md-6">
                                <input id="color" type="text" class="form-control" name="color" value="{{ $category->color }}" required autofocus>

                                @if ($errors->has('color'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('color') }}</strong>
                                    </span>
                                @endif
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