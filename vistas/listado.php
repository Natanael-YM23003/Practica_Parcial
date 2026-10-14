<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Pedidos - Cafetería</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <div class="container">
        <h1>Listado de Pedidos Registrados</h1>
        <?php if(empty($pedidos)): ?>{
            <p>No se han agregado datos al registro</p>
        }
        <?php else: ?>
            <table style="border-collapse: collapse;">             
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Tipo de producto</th>
                        <th>Nombre de producto</th>                    
                        <th>Cantidad</th>
                        <th>Total ($)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pedidos as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['cliente']) ?></td>
                        <td><?= ucfirst(htmlspecialchars($p['tipo']))?></td>
                        <td><?= htmlspecialchars($p['producto']) ?></td>
                        <td><?= (int)$p['cantidad'] ?></td>
                        <td>$<?= number_format((float) $p['total'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <br>
        <a href="index.php">Registrar otro pedido</a>
    </div>
</body>
</html>