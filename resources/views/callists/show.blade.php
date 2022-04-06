@extends('layouts.master')

@section('content')
<div class="container bg-white shadow-sm p-3 mb-5 bg-body rounded">
  <div class="row">
    <div class="col-12">
      <div class="header">
        <h1>Group {{$groupID}}</h1>
      </div>
      <div class="content-table">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">Level</th>
              <th scope="col">Name</th>
              <th scope="col" class="text-center" colspan="4">Action</th>
            </tr>
          </thead>
          <tbody class="">
            @if(count($callists)>0)
            @foreach($callists as $list)
            <tr>
              <td>{{$list->level}}</td>
              <td>{{$list->name}}</td>
              <td>
                <a href="{{ route('moveTop', ['id' => $list->id]) }}" class="btn btn-primary">
                  Top
                </a>
              </td>
              <td>
                <a href="{{ route('moveUp', ['id' => $list->id]) }}" class="btn btn-success">
                  Up
                </a>
              </td>
              <td>
                <a href="{{ route('moveDown', ['id' => $list->id]) }}" class="btn btn-warning">
                  Down
                </a>
              </td>
              <td>
                <a href="{{ route('moveBottom', ['id' => $list->id]) }}" class="btn btn-info">
                  Bottom
                </a>
              </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan=" 6"> No Record Found</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection