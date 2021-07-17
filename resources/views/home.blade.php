@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <h2>{{ $title }}</h2>
            <hr>
            <div class="card">
                <div class="card-body">


                    @foreach($readCandidateCategories as $readCandidateCategory)

                    <?php  $total = 0; ?>

                    <div class="textsuccess">

                      <h4>{{ $readCandidateCategory->name }}</h4>

                    </div>

                      <table class="table">
                            <thead>
                              <th>CANDIDATE NAME</th> <th><center>CANDIDATE PHOTO</center></th> <th>NUMBER OF VOTE</th>
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
        font-size: 70px;
    }

    .name_size{
        font-size: 30px;
    }
 </style>

@endsection