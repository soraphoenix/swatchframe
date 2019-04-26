@extends('layouts/main')

@section('title')
  Design Storm - Inspiration for developers
@endsection

@section('content')
  <div id="site-section">
    <div class="container">
      <div id="home">
        <div class="search-area">
          <div class="search-container">
            <form class="" action="results" method="POST">
              @csrf
              <h1>DesignStorm</h1>
              <input class="search" type="text" value="" placeholder="Search" name="search">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
