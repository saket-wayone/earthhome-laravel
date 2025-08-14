@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Setup Two-Factor Authentication</h1>
    <p>Scan this QR code with your Google Authenticator app:</p>
    <img src="{{ $QRImage }}">
    <form method="POST" action="{{ route('2fa.setup.store') }}">
        @csrf
        <input type="hidden" name="secret" value="{{ $secret }}">
        <button type="submit" class="btn btn-primary">Enable 2FA</button>
    </form>
</div>
@endsection