<h3>Hi: {{ $account->name }}</h3>
<p>
    You Register Successfully!!!
</p>
<p>
    <a href="{{ route('account.verify', $account->email) }}">Click here to verify to your account</a>
</p>
