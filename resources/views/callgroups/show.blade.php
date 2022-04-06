@extends('layouts.master')

@section('content')
<div class="container bg-white shadow-sm p-3 mb-5 bg-body rounded">
  <div class="row">
    <div class="col-md-12">
      <div class="py-3">
        <h1>Call Groups</h1>
      </div>
      @if(count($callGroups)>0)
      <ul class="list-group list-group-flush">
        @foreach($callGroups as $group)
        <li class="list-group-item"><a href="{{ route('grouplist', ['groupid' => $group->id]) }}">{{$group->groupname}}</a></li>
        @endforeach
        @else
        <div class="py-5">
          No record found!
        </div>
        @endif
      </ul>
    </div>
  </div>
</div>
@endsection