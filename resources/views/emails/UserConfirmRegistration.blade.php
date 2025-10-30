@component('mail::message')
<div style="text-align:center;">
    <img src="https://a-znutritionandsmoothies.com/public/img/logo.png" alt="App Icon" style="vertical-align: middle;margin-bottom: -3px;height: 125px;margin-bottom: 35px">
    <h3>Welcome to a-znutritionandsmoothies</h3>
</div>

Dear {{$data['username']}},

Thank you for registering with a-znutritionandsmoothies. Your account has been successfully created.

Your Account Details:
<ul style="padding-left: 16px">
    <li><strong>Email:</strong> {{$data['useremail']}}</li>
    <li><strong>Password:</strong> {{$data['password']}}</li>
</ul>
<p style="width: 160px;margin:auto"><a href="{{url('/login')}}" style="padding:5px 10px;color:rgb(253, 253, 253);background:#dc3838;border-radius:5px;text-decoration:none">Click here to Login </a></p>
<br>
<h4> Click below link to download App:</h4>
<br>
</h5>For Apple User:</h5>
https://apps.apple.com/us/app/a-z-nutrition-and-smoothies/id6476598086
<br>
</h5>For Android User:</h5>
https://play.google.com/store/apps/details?id=com.aznutritionandsmoothie
<br>
Thanks,<br>
a-znutritionandsmoothies
@endcomponent
