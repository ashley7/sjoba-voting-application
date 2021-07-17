@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <h2>{{ $title }}</h2>
            <hr>
            <div class="card">


                <div class="card-body">               

                     <form method="POST" action="{{ route('candidate.store') }}" enctype="multipart/form-data">
                         @csrf

                         <label>Candidate Name</label>
                         <input type="text" name="name" class="form-control"> 

                         <br><label>Candidate Picture</label> <br>
                         <input type="file" name="picture"><hr>

                         <label>Select position</label>
                         <select class="form-control" name="position_id">
                             @foreach($positions as $position)

                               <option value="{{ $position->id }}">{{$position->name}}</option>

                             @endforeach
                         </select>
                        

                         <hr>
                         <button class="btn btn-primary">Save candidate</button>

                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection