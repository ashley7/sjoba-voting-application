@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <h2>{{ $title }}</h2>
            <hr>
            <div class="card">


                <div class="card-body">               

                     <form method="POST" action="{{ route('candidate.update',$readCandidate->id) }}" enctype="multipart/form-data">
                         @csrf

                         {{ method_field("PATCH") }}

                         <label>Candidate Name</label>
                         <input type="text" name="name" value="{{$readCandidate->name}}" class="form-control"> 

                         <br><label>Candidate Picture</label> <br>
                         <input type="file" name="picture"><br><br> <img src="{{  asset('files/'.$readCandidate->picture) }}" width="100px" height="140px"><hr>

                         <label>Select position</label>
                         <select class="form-control" name="position_id">
                             @foreach($positions as $position)

                               @if($position->id  == $readCandidate->candidate_category_id)

                               <option selected value="{{ $position->id }}">{{$position->name}}</option>

                               @else

                                <option value="{{ $position->id }}">{{$position->name}}</option>

                               @endif

                             @endforeach
                         </select>
                        

                         <hr>
                         <button type="submit" class="btn btn-primary">Save changes</button>

                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection