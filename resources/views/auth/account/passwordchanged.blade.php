@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">{{ __('Change Password') }}</div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ __('Password changed successfully.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection