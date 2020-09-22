<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/">Home</a>
  <form action="/search-file" method="POST" class="  w-100">
  	@csrf
  <input class="form-control form-control-dark w-100" type="text" name="search_file" placeholder="Search" aria-label="Search">

  </form>
 
</nav>
