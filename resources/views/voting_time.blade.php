@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <h2>{{ $title }}</h2>
            <hr>
            <div class="card">


                <div class="card-body">               

                     <form method="POST" action="{{ route('vote_control.store') }}">
                         @csrf

                         <label>Voting Time</label>
                         <input type="datetime-local" name="starting_time" class="form-control">  


                         <hr>
                         <button class="btn btn-primary">Save</button>

                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
