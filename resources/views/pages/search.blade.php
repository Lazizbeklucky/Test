@extends('layout.app')

@section('my_style')

@endsection

@section('content')

    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Searching result = {{$data}}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">

           
                  </div>
                </div>
      </div>
      
   
<div class="row">

<!-- Button trigger modal -->

  @dd($items)
@foreach($items as $item)
  
    <div class="col-md-3">
<a href="{{$item->path!=null ? $item->path: '/'}}">
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">{{$item->name}}</div>
  <div class="card-body">
    <h5 class="card-title">{{$nameCheck[$item->type]}}</h5>
    <p class="card-text"></p>
  </div>
</div>
   
</a>

</div>
  
  @endforeach

  @foreach($files as $item)
  
    <div class="col-md-3">
<a href="{{$item->path}}">
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">{{$item->name}}</div>
  <div class="card-body">
    <h5 class="card-title">File</h5>
    <p class="card-text">{{$item->body}}</p>
  </div>
</div>
   
</a>

</div>
  
  @endforeach

</div>



</main>
  </div>
</div>
@endsection

@section('my_script')
  
@endsection

