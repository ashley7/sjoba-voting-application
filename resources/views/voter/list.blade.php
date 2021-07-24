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
                            <th>NAME</th>
                            <th>PHONE NUMBER</th>
                            @if(Auth::user()->user_type == "admin")
                            <th>PIN</th>
                              
                                <th>ACTION</th> 
                            @endif                            
                        </thead>
                        <tbody>
                            @foreach($voters as $voter)
                              <tr>
                                  <td>{{ $voter->id }}</td>
                                  <td>{{ $voter->name }}</td>
                                  <td>{{ $voter->phone_number }}</td>
                                  @if(Auth::user()->user_type == "admin")
                                  <td>{{  $voter->pin  }}</td>
                                                                    
                                    <td>
                                        <form method="POST" action="{{ route('voters.destroy',$voter->id) }}">
                                            @csrf
                                            {{ method_field("DELETE") }}

                                            <a href="{{ route('voters.edit',$voter->id) }}" class="btn btn-primary">Edit</a>

                                            @if($voter->user_type == "voter")

                                                <button onclick="return confirm('Are you sure you want to delete all this voter');" type="submit" class="btn btn-danger">Delete</button>

                                            @endif
                                            
                                        </form>
                                        
                                    </td>
                                @endif
                              </tr>

                            @endforeach
                        </tbody>
                    </table>
                    
                    {{  $voters->links() }}
                     
                </div>
                    
            </div>
        </div>
    </div>
</div>
@endsection