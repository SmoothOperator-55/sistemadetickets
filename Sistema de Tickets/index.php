<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Tickets Telleria</title>
    <!-- Enlazar Bootstrap para estilos y modales -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #131c3b; 
        }
        .navbar a.nav-link {
            color: white;
        }
         body {
            background-image: url('imagenes/Mainwall.jpg'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            height: 100vh;
            } 

          .container {
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);  
        }

        .rgb-button {
            background: linear-gradient(90deg, red, orange, yellow, green, blue, indigo, violet);
            background-size: 400%;
            color: white;
            border: none;
          }

        .rgb-button {
            background: linear-gradient(90deg, red, orange, yellow, green, blue, indigo, violet);
            background-size: 400%;
            color: white;
            border: none;
            animation: rgbHover 3s infinite;
          }

        @keyframes rgbHover {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .custom-modal-header {
            background-color: #131c3b; /* Azul oscuro */
            color: white; /* Texto en blanco */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 15px 20px;
        }

        .custom-modal .modal-body {
            padding: 20px;
            color: #333; /* Texto oscuro */
        }

        .custom-modal .form-label {
            color: #131c3b; /* Texto azul oscuro para coherencia */
        }

        .custom-modal .form-select,
        .custom-modal .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .custom-modal .btn-primary {
            background-color: #131c3b;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .custom-modal .btn-primary:hover {
            background-color: #0d1a2d; /* Un tono más oscuro en hover */
        }

        .custom-modal {
            background-color: #f8f9fa; /* Color suave para el fondo del modal */
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); /* Sombra para dar profundidad */
        }

        .custom-modal-header {
            background-color: #131c3b; /* Azul oscuro */
            color: white; /* Texto en blanco */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 15px 20px;
        }

        .custom-modal .modal-body {
            padding: 20px;
            font-size: 1rem;
            color: #333; /* Texto oscuro */
        }

        .custom-modal .modal-footer {
            background-color: #f1f1f1; /* Fondo suave para el pie del modal */
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            padding: 15px;
        }

        .custom-modal .btn-primary {
            background-color: #131c3b;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .custom-modal .btn-primary:hover {
            background-color: #0d1a2d; /* Un tono más oscuro en hover */
        }
        .custom-label {
            color: #131c3b; /* Cambia el color al que desees */
            font-weight: bold; /* Opcional: Hace el texto en negrita */
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
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center mt-5">
        <h1 class="mb-4" style="font-size: 2.5rem; color: #white;">Bienvenido al Sistema de Tickets del Área de Transformación Planta Sahagun</h1>
       <p class="mb-5" style="font-size: 1.2rem; color: #whitesmoke;">Aquí puedes crear un ticket de soporte técnico para reportar problemas en tu equipo de computo, mantenimiento y más.</p>
    <button class="btn btn-primary btn-lg shadow rgb-button" style="padding: 15px 30px; font-size: 1.2rem;" data-bs-toggle="modal" data-bs-target="#ticketModal">Crear Ticket</button>

       <!-- Modal de Iniciar Sesión -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de Login -->
                <form id="loginForm">
                   <div class="mb-3">
    <label for="email" class="form-label custom-label">Usuario</label>
    <input type="text" class="form-control" id="email" placeholder="Ingresa tu usuario">
</div>
<div class="mb-3">
    <label for="password" class="form-label custom-label">Contraseña</label>
    <input type="password" class="form-control" id="password" placeholder="Contraseña">
</div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">Iniciar Sesión</button>
                  
                </form>
                <div id="errorMessage" class="text-danger mt-3"></div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal de Crear Ticket -->
    <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="ticketModalLabel">Crear Ticket de Soporte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <form id="ticketForm">
                    <div class="mb-3">
                        <label for="department" class="form-label">Área</label>
                        <select class="form-select" id="department">
                            <option value="" selected disabled>Selecciona el departamento</option>
                            <option value="Ingenieria">Ingeniería</option>
                            <option value="Recursos Humanos">Recursos Humanos</option>
                            <option value="Finanzas">Finanzas</option>
                            <option value="Logística">Logística</option>
                            <option value="Producción">Producción</option>
                            <option value="Mantenimiento">Mantenimiento</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="solicitante" class="form-label">Nombre del Solicitante</label>
                        <input type="text" class="form-control" id="solicitante" placeholder="Nombre de quien hace la solicitud">
                    </div>
                    <div class="mb-3">
                        <label for="tipoFalla" class="form-label">Tipo de Falla o Mantenimiento</label>
                        <select class="form-select" id="tipoFalla">
                            <option value="Red">Problemas de red</option>
                            <option value="Mantenimiento">Mantenimiento</option>
                            <option value="Lentitud">Problemas de rendimiento</option>
                            <option value="Componentes">Cambio de componentes</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción del Problema</label>
                        <textarea class="form-control" id="descripcion" rows="3" placeholder="Describe el problema o la solicitud"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Ticket</button>
                </form>
            </div>
        </div>
    </div>
</div>


   <!-- Modal de Confirmación de Ticket -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="confirmModalLabel">¡Ticket Enviado!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tu ticket ha sido enviado correctamente. Nuestro equipo de soporte técnico se pondrá en contacto contigo a la brevedad.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>



<!-- Seccion de scripts, por favor documentarse antes de modificar -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Manejo del formulario de inicio de sesión
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el envío por defecto

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        // Simular una llamada al servidor para obtener los usuarios desde el JSON
        fetch('admin.json')
            .then(response => response.json())
            .then(data => {
                const usuarios = data.usuarios;
                const usuarioValido = usuarios.find(user => user.correo === email && user.contrasena === password);

                if (usuarioValido) {
                    // Redirigir a la página de admin
                    window.location.href = 'admin.php';
                } else {
                    // Mostrar mensaje de error
                    document.getElementById('errorMessage').innerText = 'Usuario o contraseña incorrectos.';
                }
            })
            .catch(error => {
                console.error('Error al leer el archivo JSON:', error);
            });
    });

    // Manejo del envío del formulario de ticket
    document.getElementById('ticketForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío por defecto
        const area = document.getElementById('department').value;
        const solicitante = document.getElementById('solicitante').value;
        const tipoFalla = document.getElementById('tipoFalla').value;
        const descripcion = document.getElementById('descripcion').value;

        // Crear el objeto ticket
        const nuevoTicket = {
            area: area,
            solicitante: solicitante,
            tipoFalla: tipoFalla,
            descripcion: descripcion
        };

        // Enviar el ticket al servidor
        fetch('guardarTicket.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(nuevoTicket)
        })
        .then(response => response.json())
        .then(data => {
            if(data.mensaje === "Ticket guardado correctamente") {
                // Mostrar modal de confirmación
                var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
                confirmModal.show();

                // Limpiar el formulario
                document.getElementById('ticketForm').reset();
            } else {
                alert("Error al enviar el ticket: " + data.mensaje);
            }
        })
        .catch(error => {
            console.error('Error al enviar el ticket:', error);
        });
    });
</script>
</body>
</html>


    </script>
</body>
</html>
