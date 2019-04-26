@extends('layouts/account')

@section('title')
  Account - Projects
@endsection

@section('content')
<div>
  <div class="row">
    <div class="col-md-10">
      <h1>{{ $project->title }}</h1>
      <h6>This is where all of your projects are located - <strong style="color: red;">Author: {{ $project->user->name }}</strong></h6>
    </div>

  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="row">
          <div class="col-md-10">
              <div class="img-section">
                <div class="row">
                  @foreach ($project->inspirations as $inspiration)
                    <div class="col-md-3">
                      <div class="box">
                        <div style="position: relative; background: url('{{ $inspiration->image_url }}') no-repeat center center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; height: 200px;">
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
          </div>
          <div class="col-md-2">
            <center>
              <a href="{{ $project->id }}/edit" class="edit-btn">Edit</a>
              <a href="{{ $project->id }}/delete" onclick="confirm()" class="delete-btn">Delete</a>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
<script>

</script>
@endsection
