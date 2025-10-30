@component('mail::message')
<h1 style="margin:0 auto 10px;width: max-content">AZ Nutrition & Smoothies</h1>
<p><strong>Name:</strong> {{$data['name']}}</p>
<p>{{ $data['message'] }}</p>
<p style="font-size: 14px; color: #777; margin-top: 20px;">Thanks!<br>aznutrition-and-smoothie</p>
@endcomponent
