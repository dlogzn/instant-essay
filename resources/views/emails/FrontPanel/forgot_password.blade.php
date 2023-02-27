<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body style="text-align: center;">
    <div style="height: 60px; width: 100%; padding-top: 30px;">
        <img src="{{ $message->embed(storage_path() . '/app/public/images/default/logo.png') }}" style="height: 120px;">
    </div>

    <div style="margin-top: 30px; font-size: 30px; font-weight: 800;">Resetting Forgotten Password</div>

    <div style="margin-top: 15px;">
        Hi {{ $user->name }},
    </div>
    <div style="margin-top: 15px;">
        Thanks for requesting reset password of your account. To reset your account password, you need the Verification Code. Please use the following Verification Code for further proceeding.
    </div>
    <div style="margin-top: 15px;">
        Verification Code: <span style="font-weight: bold; color: #00afef;">{{ $user->verification_code }}</span>
    </div>

    <div style="margin-top: 15px;">
        Note that the verification code will expire within an hour. So you have to use it within this time period.
    </div>
    <div style="margin-top: 15px;">
        Best Regards,<br>
        Instant Essay Support Team
    </div>

    <div style="margin-top: 30px; padding-top: 15px; color: #636363; height: 40px; font-size: 0.7rem;">
        &copy; {{ date('Y') }} Instant Essay. All Rights Reserved.
    </div>

</body>
</html>
