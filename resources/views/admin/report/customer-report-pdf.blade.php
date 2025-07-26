<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
<h2 style="text-align: center;"> Customer Report</h2>

<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Order Code</th>
        <th>Customer Id </th>
        <th>Customer Name</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        @foreach($order->orderDetails as $orderDetail)
            <tr>
                <td>{{ $orderDetail->created_at->format('Y-m-d') }}</td>
                <td>{{ $order->order_code }}</td>
                <td>{{ $order->customer->id }}</td>
                <td>{{ $order->customer->name }}</td>
                <td>{{ $order->customer->email }}</td>
                <td>{{ $order->customer->mobile }}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
</body>
</html>


