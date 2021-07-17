@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <h2>{{ $title }}</h2>
            <hr>
            <div class="card">
                <div class="card-body">

                    <table class="table table-hover table-striped" id="myTable">
                        <thead>
                            <th>ID</th>
                            <th>POSITION</th>
                            <th>NAME</th>
                            <th>PICTURE</th>
                            @if(Auth::user()->user_type == "admin")                                                           
                                <th>ACTION</th> 
                            @endif                            
                        </thead>
                        <tbody>
                            @foreach($candidates as $candidate)

                              <tr>
                                  <td>{{ $candidate->id }}</td>
                                  <td><span class="text-success">{{ $candidate->candidateCategory->name }} </span> </td>
                                  <td>{{ $candidate->name }}</td>
                                  <td><img src="{{  asset('files/'.$candidate->picture) }}" width="140px" height="140px"></td>
                                  @if(Auth::user()->user_type == "admin")                                 
                                  
                                    <td>
                                        <form method="POST" action="{{ route('candidate.destroy',$candidate->id)  }}">
                                            @csrf
                                            {{ method_field("DELETE") }}
                                            <a href="{{ route('candidate.edit',$candidate->id) }}" class="btn btn-primary">Edit</a>
                                            <button onclick="return confirm('Are you sure you want to delete this candidate?');" type="submit" class="btn btn-danger">Remove</button>
                                        </form>
                                        
                                    </td>
                                @endif
                              </tr>

                            @endforeach
                        </tbody>
                    </table>
                    
                     
                </div>
                    
            </div>
        </div>
    </div>
</div>
@endsection