# PASO 2: Crear vista welcome básica
cat > resources/views/welcome.blade.php << 'EOF'
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Laravel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-secondary">
                    <div class="card-body text-center">
                        <h1 class="card-title">🚀 Laravel 12</h1>
                        <p class="card-text">Bienvenido al proyecto backend_woo</p>
                        <a href="/login" class="btn btn-primary">
                            Ir al Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
EOF

echo "✅ Vista welcome.blade.php creada correctamente"