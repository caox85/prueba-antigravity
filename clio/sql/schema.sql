-- Tabla de Usuarios (Administradores, Profesores, etc.)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'teacher', 'student') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Alumnos (Datos específicos del alumno)
-- Por ahora simple, se puede expandir después
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- Si el alumno también va a tener login
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    enrollment_id VARCHAR(20) UNIQUE, -- Matrícula
    grade_group VARCHAR(20), -- Grado y Grupo
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Insertar un usuario admin por defecto (Password: admin123)
-- El password es: $2y$10$8.w... (Hash de 'admin123' generado con PASSWORD_DEFAULT)
-- Nota: En producción, cambia esto inmediatamente.
-- INSERT INTO users (username, password, email, role) VALUES 
-- ('admin', '$2y$10$EpOd.sNqg.y... (hash real necesario)', 'admin@clio.com', 'admin');
