<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Tickets - Sistema de Tickets Telleria</title>
    <!-- Enlazar Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Cambiar color de la navbar */
        .navbar {
            background-color: #131c3b; /* Color Azul oscuro */
        }
        .navbar a.nav-link {
            color: white;
        }

        /* Estilos adicionales */
        .table {
            background-color: white; /* Fondo blanco para la tabla */
        }

        .table td, .table th {
            background-color: white; /* Fondo blanco para las celdas */
            color: black; /* Texto negro para contraste */
        }

        body {
            background-image: url('imagenes/Numbers.gif'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            height: 100vh;
        } 

        .container {
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);  
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <img src="imagenes/TelleriaSlim.jpg" width="350" height="100" />
            <a class="navbar-brand text-white" href="#">Sistema de soporte técnico Grupo Telleria</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                         <img src="imagenes/LOAD.gif" width="100" height="100" />
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Gestión de Tickets</h1>

        <!-- Tabla de Tickets -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Solicitante</th>
                    <th>Departamento</th>
                    <th>Tipo de Falla</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="ticketTableBody">
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="estadoModal" tabindex="-1" aria-labelledby="estadoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="estadoModalLabel">Cambiar Estado del Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="estadoForm">
                        <input type="hidden" id="ticketId">
                        <div class="mb-3">
                            <label for="estado" class="form-label">Nuevo Estado</label>
                            <select class="form-select" id="estado">
                                <option value="Pendiente">Pendiente</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="Resuelto">Resuelto</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Estado</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function cargarTickets() {
            fetch('obtenerTickets.php')
                .then(response => response.json())
                .then(data => {
                    const tickets = data.tickets;
                    const ticketTableBody = document.getElementById('ticketTableBody');
                    ticketTableBody.innerHTML = '';
                    tickets.forEach(ticket => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${ticket.id || 'N/A'}</td>
                            <td>${ticket.solicitante}</td>
                            <td>${ticket.area}</td>
                            <td>${ticket.tipoFalla}</td>
                            <td>${ticket.descripcion}</td>
                            <td><span class="badge bg-${ticket.estado === 'Pendiente' ? 'warning' : ticket.estado === 'En Proceso' ? 'primary' : 'success'}">${ticket.estado}</span></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="abrirModalEstado('${ticket.id}')">Cambiar Estado</button>
                            </td>
                        `;
                        ticketTableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar los tickets:', error);
                });
        }

        function abrirModalEstado(ticketId) {
            fetch('obtenerTickets.php')
                .then(response => response.json())
                .then(data => {
                    const ticket = data.tickets.find(t => t.id === ticketId);
                    if (ticket) {
                        document.getElementById('ticketId').value = ticket.id;
                        document.getElementById('estado').value = ticket.estado;
                        var estadoModal = new bootstrap.Modal(document.getElementById('estadoModal'));
                        estadoModal.show();
                    } else {
                        console.error('Ticket no encontrado.');
                    }
                })
                .catch(error => {
                    console.error('Error al obtener el ticket:', error);
                });
        }

        document.getElementById('estadoForm').addEventListener('submit', function(event) {
            event.preventDefault(); 
            const ticketId = document.getElementById('ticketId').value;
            const nuevoEstado = document.getElementById('estado').value;

            fetch('actualizarTicket.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: ticketId, estado: nuevoEstado })
            })
            .then(response => {
                if (response.ok) {
                    if (nuevoEstado === 'Resuelto') {
                        // Eliminar el ticket si está resuelto
                        fetch('eliminarTickets.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ id: ticketId })
                        })
                        .then(response => {
                            if (response.ok) {
                                cargarTickets(); // Recargar los tickets
                            } else {
                                console.error('Error al eliminar el ticket.');
                            }
                        })
                        .catch(error => {
                            console.error('Error al eliminar el ticket:', error);
                        });
                    } else {
                        cargarTickets(); // Recargar los tickets
                    }

                    var estadoModal = bootstrap.Modal.getInstance(document.getElementById('estadoModal'));
                    estadoModal.hide();
                } else {
                    console.error('Error al actualizar el estado.');
                }
            })
            .catch(error => {
                console.error('Error al actualizar el estado:', error);
            });
        });
        cargarTickets();
    </script>
</body>
</html>
