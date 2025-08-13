<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automatización AM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../public/css/home.css">
</head>
<body>

    <div class="sidebar">
        <h5 class="px-3 mb-4">Automatización AM</h5>
        <ul class="nav flex-column px-3">
            <li class="nav-item mb-2">
                <a class="nav-link active d-flex align-items-center" href="#">
                    <i class="bi bi-house-door-fill"></i> Inicio
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link d-flex align-items-center" href="#">
                    <i class="bi bi-folder-fill"></i> Archivos
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link d-flex align-items-center" href="#">
                    <i class="bi bi-pc-display-horizontal"></i> Equipos
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link d-flex align-items-center" href="#">
                    <i class="bi bi-funnel-fill"></i> Filtrar
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        
        <div class="topbar d-flex justify-content-between align-items-center">
            <div class="input-group" style="width: 400px;">
                <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control bg-light border-0" placeholder="Buscar...">
            </div>
            <div class="d-flex align-items-center">
                <i class="bi bi-bell-fill fs-4 text-muted me-4"></i>
                <img src="https://i.pravatar.cc/40" class="rounded-circle" alt="Avatar">
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Activos Recientes</h2>
            <div>
                <button class="btn btn-outline-secondary">Exportar</button>
                <button class="btn btn-primary">Nueva Factura</button>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center"><input class="form-check-input" type="checkbox"></th>
                            <th scope="col">Factura</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Total</th>
                            <th scope="col" class="text-center">Estado</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><input class="form-check-input" type="checkbox"></td>
                            <td>
                                <div>INV-00123</div>
                                <small class="text-muted">Factura de Compra</small>
                            </td>
                            <td>
                                <div>Brayan Ardila</div>
                                <small class="text-muted">brayan.a@correo.com</small>
                            </td>
                            <td>12 Ago, 2025</td>
                            <td>$1,500.00</td>
                            <td class="text-center">
                                <span class="badge rounded-pill bg-success-subtle text-success-emphasis">Pagada</span>
                            </td>
                            <td class="text-center">
                                <a href="#" class="text-secondary"><i class="bi bi-eye-fill"></i></a>
                                <a href="#" class="text-secondary mx-2"><i class="bi bi-pencil-fill"></i></a>
                                <a href="#" class="text-danger"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center"><input class="form-check-input" type="checkbox"></td>
                            <td>
                                <div>INV-00124</div>
                                <small class="text-muted">Factura de Venta</small>
                            </td>
                            <td>
                                <div>Manuela Quintero</div>
                                <small class="text-muted">manuela.q@correo.com</small>
                            </td>
                            <td>11 Ago, 2025</td>
                            <td>$850.50</td>
                            <td class="text-center">
                                <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis">Pendiente</span>
                            </td>
                            <td class="text-center">
                                <a href="#" class="text-secondary"><i class="bi bi-eye-fill"></i></a>
                                <a href="#" class="text-secondary mx-2"><i class="bi bi-pencil-fill"></i></a>
                                <a href="#" class="text-danger"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>