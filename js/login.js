// Validación del formulario de login (SOLO VISUAL - SIN FUNCIONALIDAD)
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const alertDiv = document.getElementById('alertMessage');
    
    // Validaciones básicas
    if (email === '' || password === '') {
        mostrarAlerta(alertDiv, 'danger', 'Por favor completa todos los campos');
        return;
    }
    
    // Validar formato de email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        mostrarAlerta(alertDiv, 'danger', 'Por favor ingresa un correo válido');
        return;
    }
    
    // Validar longitud de contraseña
    if (password.length < 6) {
        mostrarAlerta(alertDiv, 'danger', 'La contraseña debe tener al menos 6 caracteres');
        return;
    }
    
    // Simulación de login exitoso (sin conexión real a PHP)
    mostrarAlerta(alertDiv, 'success', '¡Login exitoso! Redirigiendo al dashboard...');
    
    // Redirigir al dashboard después de 1.5 segundos
    setTimeout(function() {
        window.location.href = 'dashboard.html';
    }, 1500);
});

// Función para mostrar alertas
function mostrarAlerta(elemento, tipo, mensaje) {
    elemento.innerHTML = `
        <div class="alert alert-${tipo} alert-dismissible fade show" role="alert">
            <strong>${tipo === 'success' ? '¡Éxito!' : 'Error:'}</strong> ${mensaje}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
}

// Limpiar alertas cuando el usuario empieza a escribir
document.getElementById('email').addEventListener('input', function() {
    document.getElementById('alertMessage').innerHTML = '';
});

document.getElementById('password').addEventListener('input', function() {
    document.getElementById('alertMessage').innerHTML = '';
});