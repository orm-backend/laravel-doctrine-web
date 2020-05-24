@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Change Password') }}</div>
				<div class="card-body">
					<form method="POST" action="{{ route('password.edit') }}">
						@csrf
						<div class="form-group row">
							<label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Current') }}</label>
							<div class="col-md-6">
								<input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror"
									name="old_password" autocomplete="old-password" value="{{ old('old_password') }}">
								@error('old_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New') }}</label>
							<div class="col-md-6">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
									name="password" autocomplete="new-password" value="{{ old('password') }}">
								@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Repeat') }}</label>
							<div class="col-md-6">
								<input id="password_confirmation" type="password"
									class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
									autocomplete="new-password" value="{{ old('password_confirmation') }}">
								@error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
