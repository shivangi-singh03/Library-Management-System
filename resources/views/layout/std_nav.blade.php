@extends('layout.app')

  <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/logout">Logout <span class="sr-only">(current)</span></a>
      </li>
      </ul>
    </div>
</nav>
<div class="container">
  @yield('content')
</div>