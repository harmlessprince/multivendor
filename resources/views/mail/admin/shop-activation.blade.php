@component('mail::message')
    # Shop Activation Request

    Please activate shop. Here are the details.


    Shop Name: {{ $shop->name }}

    Shop Owner: {{ $shop->owner->name }}
    
    @component('mail::button', ['url' => route('shops.index')])
        Manage Shops
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
