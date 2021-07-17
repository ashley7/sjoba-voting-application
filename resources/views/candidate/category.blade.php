@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <h2>{{ $title }}</h2>
            <hr>
            <div class="card">


                <div class="card-body">               

                     <form method="POST" action="{{ route('candidate_category.store') }}">
                         @csrf

                         <label>Position Name</label>
                         <input type="text" name="name" class="form-control">                        

                         <hr>
                         <button type="submit" class="btn btn-primary">Save position</button>

                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
