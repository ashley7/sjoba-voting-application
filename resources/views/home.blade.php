@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <h2>{{ $title }}</h2>
            <hr>


                <form method="POST" action="{{  route('vote_control.destroy','all')  }}">
                    @csrf
                    {{ method_field('DELETE') }}

                    <button onclick="return confirm('Are you sure you want to delete all the votes');" class="btn btn-danger">Delete all votes</button>

                    <hr>

                </form>
            <div class="card">
                <div class="card-body">

                    <span class="name_size">Total Voters: {{ App\User::count() }}</span>

                    @foreach($readCandidateCategories as $readCandidateCategory)

                    <?php  $total = 0; ?>

                    <div class="textsuccess">

                      <h4>{{ $readCandidateCategory->name }}</h4>

                    </div>

                    <div class="table-responsive">

                      <table class="table">
                            <thead>
                              <th style="width: 50%;">CANDIDATE NAME</th> <th style="width: 25%;"><center>CANDIDATE PHOTO</center></th> <th style="width: 25%;">NUMBER OF VOTES</th>
                            </thead>

                            <tbody>
                                @foreach($readCandidateCategory->candidates as $candidate)

                                 <?php 

                                   $count = App\Vote::numberOfVotes($candidate->id);

                                   $total = $total + $count;


                                  ?>

                              <tr>                          
                               
                                <td>
                                    <span class="text-success name_size"> <strong> {{ $candidate->name }} </strong></span>
                                </td>


                                <td>
                                    <center>
                                        <img src="{{  asset('files/'.$candidate->picture) }}" width="140px" height="140px">
                                    </center>
                                   
                                </td>

                                <td>
                                   <center>
                                       <span class="text-success vote_number"> {{ $count }} </span>
                                   </center>
                                </td>
                                 
                              </tr>                             

                            @endforeach

                              <tr class="table-primary">                          
                               
                                <td>TOTAL</td> <td></td> <td> <center> <span class="name_size">{{  $total }} </span></center></td>
                              </tr>
                            </tbody>
                      </table>

                  </div>

                     

                    @endforeach
                     

                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
 <style>
     .textsuccess{
        background-color: #38c172 !important;
        color: #FFF;
        padding: 5px;
     }

     table, th, td {
      border: 1px solid #38c172;
    }

    .vote_number{
        font-size: 50px;
    }

    .name_size{
        font-size: 20px;
    }
 </style>

@endsection