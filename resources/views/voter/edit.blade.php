@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <h2>{{ $title }}</h2>
            <hr>
            <div class="card">


                <div class="card-body">               

                     <form method="POST" action="{{ route('voters.update',$readVote->id) }}">
                         @csrf
                         {{ method_field("PATCH") }}

                         

                         <label>Voter Name</label>
                         <input type="text" value="{{  $readVote->name }}" name="name" class="form-control">

                         <label>Voter phone number</label>
                         <input type="text" value="{{  $readVote->phone_number }}" name="phone_number" placeholder="0772123456" class="form-control">

                         <hr>
                         <button type="submit" class="btn btn-primary">Save changes</button>

                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection