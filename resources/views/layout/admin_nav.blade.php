@extends('layout.app')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/book">Book Details</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/student">Student Details <span class="sr-only">(current)</span></a>
      </li>
    </ul>
</div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="api/details">Student Info <span class="sr-only">(current)</span></a>
      </li>
      </ul>
    </div>

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


