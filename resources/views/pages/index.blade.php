@extends('layout.app')

@section('my_style')

@endsection

@section('content')

    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Home</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">

            <button type="button"  data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-outline-success">Add {{$routeName}}</button>
                  </div>
                </div>
      </div>
      

<div class="row">

<!-- Button trigger modal -->


@foreach($items as $item)
  
    <div class="col-md-3">
<a href="cabinet-{{$item->id}}">
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">{{$item->name}}</div>
  <div class="card-body">
    <h5 class="card-title">Cabinet</h5>
    <p class="card-text"></p>
  </div>
</div>
   
</a>

</div>
  
  @endforeach

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
 <form  action="/create-cabinet" method="post" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create {{$routeName}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
          @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control"  name="file_name" required>
          </div>
             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-success">Create</button>
      </div>
      </form>
    </div>
  </div>
</div>

</main>
  </div>
</div>
@endsection

@section('my_script')
  <!--  <script>
    function logout_auth()
    {


         $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        })

         $.ajax({
           type:'get',
           url:'/logout_auth',
           success:function() 
            {
                  location.reload();
            }
        }); 

      
    }
       testjq = () => {
        $('#id').html("testssssss")
       }
   </script> -->
@endsection

