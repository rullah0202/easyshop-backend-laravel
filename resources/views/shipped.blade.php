<html>

<body>
    <h1>Hi {{ $user->name }},</h1>
    <h3>Your order has been shipped and will arrive soon</h3>
    <p>Stripe confirmation id: {{ $order->payment_intent }}</p>

    @foreach ($items as $item)
        <div style="display: flex; padding: 3px">
            <img width="100" src="http://localhost:8000{{ $item->url }}" alt="">
            <div style="margin-left: 10px">
                <a href="http://localhost:8000/product/{{ $item->id }}" style="padding: 5px">{{ $item->title }}</a>
                <div style="padding: 5px">${{ $item->price }}</div>
            </div>
        </div>
    @endforeach

    <p>Total price: {{ $order->total_decimal }}</p>

    <p>Thank you - Easy Shop</p>
</body>

</html>
