<div style="border: 1px solid #000; padding: 10px 20px; width: 600px;">
    <h3>Hi, {{ $customer->name }}</h3>
    <p>
        Change Password now!
    </p>
    <p><a href="{{ route('account.reset_password', $token) }}" style="display: inline-block; padding: 7px 25px; color: white; background: blue">Click here get to new Password!!!</a></p>

</div>
