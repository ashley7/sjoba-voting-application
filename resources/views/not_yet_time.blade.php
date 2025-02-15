@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $title }}</h3>
    <p>Voting start time: {{ empty($voteTime) ? "Not set": Carbon\Carbon::parse($voteTime->starting_time)->format('Y-m-d h:i a') }}</p>
    <p>Voting end time: {{ empty($voteTime) ? "Not set": Carbon\Carbon::parse($voteTime->end_time)->format('Y-m-d h:i a') }}</p>
</div>

Current time: {{ now() }}
@endsection
 