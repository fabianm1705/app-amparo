@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="fresh-table full-color-orange d-flex shadow-sm">
              <h5 class="card-title text-white mt-4 mb-4 ml-4">@lang('messages.changePassword')</h5>
          </div>
          <div class="card shadow-sm mt-1">
                <div class="card-body">
                    <form method="POST" action="{{ route('password.change') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nroDoc" class="col-md-4 col-form-label text-md-right">@lang('messages.document')</label>

                            <div class="col-md-6">
                                <input id="nroDoc" type="text" class="form-control @error('nroDoc') is-invalid @enderror" name="nroDoc" value="{{ old('nroDoc') }}" required autocomplete="nroDoc" autofocus>

                                @error('nroDoc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="passwordold" class="col-md-4 col-form-label text-md-right">@lang('messages.password')</label>

                            <div class="col-md-6">
                                <input id="passwordold" type="password" class="form-control @error('passwordold') is-invalid @enderror" name="passwordold" value="{{ old('passwordold') }}" required autocomplete="passwordold">

                                @error('passwordold')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">@lang('messages.newpassword')</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">@lang('messages.confirmNewPassword')</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    @lang('messages.changePassword')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
