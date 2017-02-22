<img src="{{ $message->embed($pathToFile) }}">
 <img src="{{ $message->embedData($data, $name) }}">

 php artisan make:mail OrderShipped --markdown=emails.orders.shipped