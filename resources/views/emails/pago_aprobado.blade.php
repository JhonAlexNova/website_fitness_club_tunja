<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
    .container { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 10px; overflow: hidden; }
    .header { background: #1a1a1a; color: #fff; padding: 30px; text-align: center; }
    .header h1 { margin: 0; font-size: 24px; letter-spacing: 2px; }
    .body { padding: 30px; color: #333; }
    .badge { background: #28a745; color: #fff; display: inline-block; padding: 8px 20px; border-radius: 20px; font-weight: bold; margin: 10px 0; }
    .detail { background: #f8f8f8; border-radius: 8px; padding: 15px; margin: 20px 0; }
    .detail p { margin: 5px 0; }
    .footer { background: #1a1a1a; color: #aaa; text-align: center; padding: 15px; font-size: 12px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>FITNESS CLUB</h1>
    </div>
    <div class="body">
      <p>Hola, <strong>{{ $usuario->primer_nombre }} {{ $usuario->primer_apellido }}</strong></p>
      <p>¡Tu pago ha sido aprobado exitosamente!</p>
      <span class="badge">✅ PAGO APROBADO</span>
      <div class="detail">
        <p><strong>Referencia:</strong> {{ $factura->referencia }}</p>
        <p><strong>Total:</strong> ${{ number_format($factura->total, 0, ',', '.') }} COP</p>
        <p><strong>Fecha:</strong> {{ $factura->updated_at->format('d/m/Y H:i') }}</p>
      </div>
      <p>Ya puedes disfrutar de todos los beneficios de tu membresía. ¡Te esperamos!</p>
    </div>
    <div class="footer">
      <p>Fitness Club Tunja &copy; {{ date('Y') }}</p>
    </div>
  </div>
</body>
</html>