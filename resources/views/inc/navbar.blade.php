<nav class="navbar navbar-expand-md bg-dark">
    <a class="navbar-brand" href="./index">{{config('app.name','LSAPP')}}</a>
  
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="./index">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./about">About Us</a>
        </li>
        <li class="nav-item">
           <a class="nav-link" href="./services">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./posts">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Admin Login</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./posts/create">Create Post</a>
      </ul>
    </div>
  </nav>