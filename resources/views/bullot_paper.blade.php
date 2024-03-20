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

                    <div class="textsuccess">

                      <h4>{{ $readCandidateCategory->name }}</h4>

                    </div>

                    <div class="table-responsive">

                      <table class="table">
                            <thead>
                              <th style="width: 50%;">CANDIDATE NAME</th> <th style="width: 25%;"><center>CANDIDATE PHOTO</center></th> <th style="width: 25%;">VOTE</th>
                            </thead>

                            <tbody>
                                @foreach($readCandidateCategory->candidates as $candidate)

                              <tr>                          
                               
                                <td>
                                    <span class="text-success"  style="vertical-align: middle; text-align: center;"> <strong> {{ $candidate->name }} </strong></span>
                                </td>


                                <td>
                                    <center>
                                        <img src="{{  asset('files/'.$candidate->picture) }}" width="140px" height="140px">
                                    </center>
                                   
                                </td>

                                <td>
                                    @if(App\Vote::voted($readCandidateCategory->id,$candidate->id))

                                        <input type="radio" checked name="radio{{$readCandidateCategory->id}}" id="candidate{{$candidate->id}}" value="{{$candidate->id}}" class="form-control" style="vertical-align: middle;">
                                    @else
                                        <input type="radio" name="radio{{$readCandidateCategory->id}}" id="candidate{{$candidate->id}}" value="{{$candidate->id}}" class="form-control"  style="vertical-align: middle;">
                                    @endif
                                </td>
                                 
                              </tr>

                              @push('scripts')

                               <script type="text/javascript">

                                $(document).ready(function(){

                                        $("#candidate{{$candidate->id}}").click(function(){

                                            $("#display{{$readCandidateCategory->id}}").text("Processing ...");

                                            $.ajax({
                                                    type: "POST",
                                                    url: "/vote",
                                                data: {
                                                    candidate_selected: $("#candidate{{$candidate->id}}:checked").val(),
                                                     _token: "{{Session::token()}}"
                                                },
                                                success: function(result){

                                                    $("#display{{$readCandidateCategory->id}}").text(result);

                                                }

                                              })
                                             
                                        });

                                    });
                                </script>


                              @endpush

                            @endforeach
                            </tbody>
                      </table>
                  </div>

                      <span class="text-info" id="display{{$readCandidateCategory->id}}"></span>

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

    .name_size{
        font-size: 30px;
    }
 </style>

@endsection

 