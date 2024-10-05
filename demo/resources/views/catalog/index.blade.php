@extends('catalog.common.base')

@section('content')
    {{-- <div style="padding-top: 60px; padding-bottom:60px">
        <a href="{{ route('catalog.leave') }}" class="text-decoration-none">
            <div class="card" style=" margin:20px; width: 10rem;">
                <div class="card-body">
                    <img src="{{ URL::asset('image/leaveimage.png') }}" alt="">
                    <h5 class="card-title">Leave</h5>

                </div>
            </div>
        </a>
    </div> --}}
    <div style="padding-top: 60px; padding-bottom:60px">
      <a href="{{ route('catalog.leave') }}" class="text-decoration-none">
          <div class="card" style="margin: 20px; width: 10rem;">
              <img src="{{ URL::asset('image/leaveimage.png') }}" alt="Leave Image" class="card-img-top" style="height: 150px; object-fit: cover;">
              <div class="card-body">
                  <h5 class="card-title">Leave</h5>
              </div>
          </div>
      </a>
  </div>
  
@endsection
