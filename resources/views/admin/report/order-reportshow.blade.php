<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.5;font-size: 15px; }
        h1 { text-align: center; }
        .content { margin: 0 auto; width: 95%; }
        .signature { margin-top: 50px; }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        @media only screen and (max-width: 600px) {
            * {
                font-size: 10px;
            }
            table, th {
                font-size: 8px;
            }
            table, td {
                font-size: 8px;
            }
        }
    </style>
    <style>
        .floating-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000; /* Ensure it stays above other content */
        }

        .floating-button .btn {
            background-color:  black; /* Bootstrap primary color */
            color: white;
            padding: 15px 20px;
            border-radius: 50px; /* Makes it look like a pill */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            text-decoration: none;
        }

        .floating-button .btn:hover {
            background-color: black; /* Darker shade on hover */
            text-decoration: none;
        }
    </style>

</head>
<body>
<div class="content">
    <div class="row" style="margin-top: 4px;">

        
            <div class="row" style="margin-top: 20px;">
                <div style="border-top: 1px solid black; border-left: 1px solid #000000; border-right: 1px solid black; margin:0">
                    <h5 style="padding:15px; margin: 0; text-transform: uppercase;" align="center">Order Report </h5>
                </div>
                <table style="width:100% ; text-align: center;">
                    <thead>
                    <tr style="background-color: #5c636a; color: white; font-size: 11px; text-transform: uppercase">
                        <th>SL</th>
                        <th>Order id</th>
                        <th>Product name</th>
                        <th>Price</th>
                        <th>Date</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                   @forelse($orders as $order)
                        <tr style="font-size: 11px">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->product_price }}</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="9">No Data Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
</div>
</body>
</html>