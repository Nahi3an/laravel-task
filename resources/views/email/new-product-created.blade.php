<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <!-- resources/views/emails/new-product-created.blade.php -->

    <p>Dear {{ $product->user->name }},</p>
    <p>A new product "{{ $product->name }}" has been created.</p>
    <p>Details:</p>
    <ul>
        <li>Name: {{ $product->name }}</li>
        <li>Price: {{ $product->price }}</li>
        <!-- Add more product details as needed -->
    </ul>
    <p>Thank you for using our platform!</p>

</body>

</html>
