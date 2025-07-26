<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
<h2 style="text-align: center;"> Order Report</h2>

<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Order Code</th>
        <th>Product</th>
        <th>Qty</th>
        <th>Price </th>
        <th>Total </th>
    </tr>
    </thead>
    <tbody>
    @forelse($orders as $item)
        <tr>
            <td>{{ $item->created_at->format('Y-m-d') }}</td>
            <td>{{ $item->order->order_code ?? 'N/A' }}</td>
            <td>{{ $item->product->name ?? 'N/A' }}</td>
            <td>{{ $item->product_qty }}</td>
            <td>{{ number_format($item->product_price, 2) }}</td>
            <td>{{ number_format($item->product_price * $item->product_qty, 2) }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No data available for this filter.</td>
        </tr>
    @endforelse
    </tbody>
</table>
</body>
</html>

