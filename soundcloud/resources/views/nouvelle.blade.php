@extends('layouts.app')

@section('content')

@include('_errors')
<div class="containerForm">
    <div class="contentFormUp">
        <h3>Nouvelle chansons</h3>
        <form action="/create" data-pjax method="POST" enctype="multipart/form-data">
            <input class="name" type="text" name="nom" required placeholder="Titre" value="{{old('nom')}}"/><br/>
            <input class="style" type="text" name="style" required placeholder="Style" value="{{old('style')}}"/><br/>
            <label for="music" class="BtLog">Musique</label>
            <input id="music" class="input-file" type="file" name="chanson" required/>
            <label for="photo" class="BtLog margin_20">Photo</label>
            <input id="photo" class="input-file" type="file" name="photo" />  <br/>       
            <input class="BtLog" type="submit" value="Upload"  />  
            {{@csrf_field()}}      
        </form>
    </div>  
</div>
@endsection