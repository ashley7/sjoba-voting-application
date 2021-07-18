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
                       
                            @if(Auth::user()->user_type == "admin")
                                                   
                                <th>ACTION</th> 
                            @endif                            
                        </thead>
                        <tbody>
                            @foreach($positions as $position)

                              <tr>
                                  <td>{{ $position->id }}</td>
                                  <td>{{ $position->name }}</td>
                                  @if(Auth::user()->user_type == "admin")                                
                                  <td>

                                    <form method="POST" action="{{ route('candidate_category.destroy', $position->id) }}">
                                        @csrf
                                        {{ method_filed("DELETE") }}

                                         <a href="{{ route('candidate_category.edit',$position->id) }}" class="btn btn-primary">Edit</a>

                                         <button class="btn btn-danger" type="submit">Remove</button>

                                    </form>
                                   
                                  </td>
                                @endif
                              </tr>

                            @endforeach
                        </tbody>
                    </table>
                    
                    {{  $positions->links() }}
                     
                </div>
                    
            </div>
        </div>
    </div>
</div>
@endsection