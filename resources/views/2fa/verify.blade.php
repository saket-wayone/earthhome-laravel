<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="container">
    <h1>Verify Your Identity</h1>
    <form method="POST" action="{{ route('2fa.verify.check') }}">
        @csrf
        <div class="form-group">
            <label for="one_time_password">Authenticator Code</label>
            <input type="text" name="one_time_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Verify</button>
    </form>
</div>
</body>
</html>

