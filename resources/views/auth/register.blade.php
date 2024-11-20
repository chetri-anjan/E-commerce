<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="">
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #403f3f;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    width: 400px;
    padding: 40px;
    background-color: #ffffff;
    border-radius: 20px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

h2 {
    text-align: center;
    margin-bottom: -17px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="password"],
button,
input[type="file"] {
    width: 100%;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-sizing: border-box;
}

.error-message {
    color: red;
    font-size: 0.8em;
}

.login-link {
    text-decoration: none;
    color: black;
    font-size: 0.9em;
    float: left;
    margin-right: 10px;
}

.register-button {
    background-color: black;
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 15px 0;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

.register-button:hover {
    background-color: #0056b3;
}


    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="register-form">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                @if($errors->has('name'))
                    <span class="error-message">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                @if($errors->has('email'))
                    <span class="error-message">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" />
                @if($errors->has('password'))
                    <span class="error-message">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                @if($errors->has('password_confirmation'))
                    <span class="error-message">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <!-- Phone -->
            <!-- <div class="form-group">
                <label for="phone">Phone</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required autofocus autocomplete="phone" />
                @if($errors->has('phone'))
                    <span class="error-message">{{ $errors->first('phone') }}</span>
                @endif
            </div> -->

            <!-- Address -->
            <!-- <div class="form-group">
                <label for="address">Address</label>
                <input id="address" type="text" name="address" value="{{ old('address') }}" required autofocus autocomplete="address" />
                @if($errors->has('address'))
                    <span class="error-message">{{ $errors->first('address') }}</span>
                @endif
            </div> -->

            <!-- Photo -->
            <!-- <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" name="photo"  autofocus autocomplete="photo" />
                @if($errors->has('photo'))
                    <span class="error-message">{{ $errors->first('photo') }}</span>
                @endif
            </div> -->

            <!-- User Role -->
            <!-- <div class="form-group">
                <label for="role">User Role</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Select User Role</option>
                    < <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Normal User</option>
                    <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>Company User</option>
                </select>
            </div> -->
            <div class="form-group">
                <a href="{{ route('login') }}" class="login-link">Already registered?</a>
                <button type="submit" class="register-button">Register</button>
            </div>
        </form>
    </div>
</body>
</html>
