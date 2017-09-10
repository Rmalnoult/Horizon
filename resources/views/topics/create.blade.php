@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Créer un sujet</div>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/topics') }}">
                	<div class="panel-body">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Titre</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

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
								<textarea name="edito" id="edito" cols="30" rows="10" class="form-control"></textarea>
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
                                        <input type="checkbox" name="published" "checked"> Sujet Publié
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="fa fa-save"></span> Enregistrer
                                </button>
                            </div>
                        </div>
                	</div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
