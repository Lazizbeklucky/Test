@extends('layout.app')

@section('my_style')

@endsection

@section('content')
   
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{$name}}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">

            <button type="button"  data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-outline-success">Add {{$routeName}}</button>
           

           
             
              <button type="button"  data-toggle="modal" data-target="#exampleModal1" class="btn btn-sm btn-outline-success">Add file</button> 
             
              
            
                  </div>
                </div>
      </div>
       <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
   
    <li class="breadcrumb-item"><a href="/">Home</a></li>
  
     </ol>
</nav>

<div class="row">

<!-- Button trigger modal -->


@foreach($datas->getCellFromCabinet as $item)
  
    <div class="col-md-3">
      
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <a href="cabinet-{{$datas->id}}/cell-{{$item->id}}">
  <div class="card-header">{{$item->name}}</div>
  <div class="card-body">
    <h5 class="card-title">Cell</h5>
    <p class="card-text"></p>
  </div>
  </a>
    <div class="card-footer bg-transparent border-success"><button 
      onclick="selectOption({{$item->id}})" type="button" class="btn btn-outline-primary">Move file</button></div>

</div>


</div>
  
  @endforeach
  
  @foreach($datas->getFilesFromCabinet as $item)
  
    <div class="col-md-3">
      
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">{{$item->name}}</div>
  <div class="card-body">
    <h5 class="card-title">File</h5>
    <p class="card-text">{{$item->body}}</p>
  </div>

</div>

</div>
  
  @endforeach

</div>





<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel123" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
<form action="/changeFolderPlace" method="post">
  @csrf
  <input type="hidden" id="folder_id" name="folderId">
  <input type="hidden" name="url" value="{{Request::path()}}">
  
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel123">Move </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
  <div class="row">
      <div class="form-group w-100">
    <label for="exampleFormControlSelect1">Example select</label>
    <select class="form-control" id="exampleFormControlSelect1" name="folder_place">
      <option value=null selected>null</option>
      
    </select>
  </div>
</div>
   
</div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    </form>
  </div>
</div>
  <!-- modal -->


  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
 <form  action="/file_create" method="post" >
  <input type="hidden" name="id" value="{{$datas->id}}">
  <input type="hidden" name="url" value="{{Request::path()}}">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create file</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" name="file_name" required>
          </div>
         
          <div class="form-group">
            <label for="message-text" class="col-form-label">Body:</label>
            <textarea class="form-control" rows="6" name="body"></textarea>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
 <form  action="create-cell" method="post" >
  <input type="hidden" name="id" value="{{$datas->id}}">
  <input type="hidden" name="url" value="{{Request::path()}}">



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

<!-- end -->


   
    
    </main>
  </div>
</div>
@endsection

@section('my_script')
   <script >
  
    selectOption = (id) =>{

      console.log(id);

           $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        })

         $.ajax({
           type:'post',
           data:{
            'id': id
          },
           url:'/get-all-data',
           success:function(data) 
            {
              $('#folder_id').val(id)
                 // console.log(data)

                $.each( data, function( key, value ) {
                  var text = ''

                  if(value.type==1)
                  {
                 var text = '<option value='+value.id+'>Cabinet('+value.name+')</option>'
                  }
                  else{
                 var text = '<option value='+value.id+'>Cell('+value.name+')</option>'
                  }
                 
                    $('#exampleFormControlSelect1').append(text)
                    });

                 $('#showModal').modal('show')
            }
        }); 
      
    }
   
  </script>
@endsection

