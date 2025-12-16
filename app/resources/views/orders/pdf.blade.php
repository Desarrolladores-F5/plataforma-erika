<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de pago</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #111;
        }

        .container {
            border: 1px solid #ddd;
            padding: 24px;
            border-radius: 8px;
        }

        h1 {
            margin-bottom: 16px;
        }

        .row {
            margin-bottom: 10px;
        }

        .label {
            color: #555;
            font-size: 12px;
        }

        .value {
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
            color: #666;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Comprobante de pago</h1>

    <div class="row">
        <div class="label">Curso</div>
        <div class="value">{{ $order->course->title }}</div>
    </div>

    <div class="row">
        <div class="label">Monto pagado</div>
        <div class="value">${{ number_format($order->amount, 0, ',', '.') }}</div>
    </div>

    <div class="row">
        <div class="label">Fecha</div>
        <div class="value">{{ $order->created_at->format('d-m-Y H:i') }}</div>
    </div>

    <div class="row">
        <div class="label">Orden interna</div>
        <div class="value">{{ $order->buy_order }}</div>
    </div>

    <div class="row">
        <div class="label">Token Webpay</div>
        <div class="value">{{ $order->token }}</div>
    </div>

    <div class="footer">
        Este documento acredita el pago exitoso del curso mediante Webpay.
    </div>
</div>

</body>
</html>
