<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Test</title>
        
       
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/bootstrap-grid.min.css" rel="stylesheet">
        <link href="/css/bootstrap-reboot.min.css" rel="stylesheet">
        
        


        @yield('my_style')

    </head>

    <body>
    @include('panels.header')
    <div class="container-fluid">
        <div class="row">
    @yield('content')
    

    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
 <form  action="/" method="post" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
 <form  action="/" method="post" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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

   </div>
    </div>
   


      @yield('my_script')
<script src="{{ asset('/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>

    </body>
</html>
