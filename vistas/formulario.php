<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafeteria - Pedido</title>
</head>

<body>
    <div class="container">
        <h1>Registrar Pedido</h1>
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="cliente">Nombre del cliente: </label>
                <input type="text" id="cliente" name="cliente" value="<?= htmlspecialchars($dato['cliente'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Tipo de producto: </label>
                <label><input type="radio" name="tipo" value="bebida" <?= (isset($dato['tipo']) && $dato['tipo'] === "bebida") ? 'checked' : '' ?> required>Bebida</label>
                <label><input type="radio" name="tipo" value="postre" <?= (isset($dato['tipo']) && $dato['tipo'] === "postre") ? 'checked' : '' ?>>Postre</label>
            </div>
            <div class="form-group">
                <label for="producto">Nombre de producto: </label>
                <input type="text" id="producto" name="producto" value="<?= htmlspecialchars($dato['producto'] ?? '') ?>" required>          
            </div>
            <div class="form-group">
                <label for="precioBase">Precio base del producto: $</label>
                <input type="number" step="0.01" id="precioBase" name="precioBase" value="<?= htmlspecialchars($dato['precioBase'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad del producto (1 - 20): </label>
                <input type="number" min="1" max="20" id="cantidad" name="cantidad" value="<?= htmlspecialchars($dato['cantidad'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="tamano">Tamano de los productos (solo para bebidas):  </label>
                <select name="tamano" id="tamano">
                    <option value="">Seleccione Tamaño</option>
                    <?php foreach (\Cafeteria\Enums\Tamano::cases() as $t): ?>
                        <option value="<?= $t->value ?>" <?= (isset($dato['tamano']) && $dato['tamano'] === $t->value) ? 'selected' : '' ?>><?= $t->name ?> (<?= $t->value ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div> 
            <button type="submit">Guardar pedido</button>
        </form>
    </div>
</body>

</html>