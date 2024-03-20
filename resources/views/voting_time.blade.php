@extends('layouts.app')

@section('content')
<div class="container">
    
    <h2>{{ $title }}</h2>
    <hr>
    <div class="card">
        <div class="card-body">               

                <form method="POST" action="{{ route('vote_control.store') }}" class="col-md-6">
                    @csrf

                    <label>Voting Time</label>
                    <input type="datetime-local" name="starting_time" value="{{ empty($voting_time) ? '':$voting_time->starting_time }}" class="form-control">  

                    <label>Voting Time</label>
                    <input type="datetime-local" name="end_time" value="{{ empty($voting_time) ? '':$voting_time->end_time }}" class="form-control">  

                    <hr>
                    <button type="submit" class="btn btn-primary">Save</button>

                </form>
        </div>
            
    </div>
</div>
@endsection
