@component('mail::message')
# Hi {{ $user->email }} - {{ $user->name }}

Here is your Monthly report
// Session / month
// Unique User / month
// Email Capture Rate / Emails 
// Welcome Place Order Rate / Orders - new customer
// Repeat Rate / Oders - returning customer
// Ecommerce Conversion Rate / Orders - conversion rate

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

@component('mail::button', ['url' => 'http://google.com'])
Click Me
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
