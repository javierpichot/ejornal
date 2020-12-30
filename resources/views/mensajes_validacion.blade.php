@if (\Session::has('success'))

  <div style="opacity: 1;" class="alert alert-success alert-dismissible fade show mt-2" role="alert">
      {!! \Session::get('success') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>

@endif


@if (\Session::has('error'))

  <div style="opacity: 1;" class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
      {!! \Session::get('error') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>

@endif
