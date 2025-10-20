-- Crear base de datos
CREATE DATABASE IF NOT EXISTS bike_station;
USE bike_station;

-- Tabla tipos_productos
CREATE TABLE tipos_productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabla productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    tipo_producto_id INT,
    imagen VARCHAR(255),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tipo_producto_id) REFERENCES tipos_productos(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insertar datos de ejemplo en tipos_productos
INSERT INTO tipos_productos (nombre, descripcion) VALUES 
('Montaña', 'Bicicletas diseñadas para terrenos difíciles y aventuras off-road'),
('Ruta', 'Bicicletas para carretera y velocidad en pavimento'),
('Urbana', 'Bicicletas para uso diario en ciudad, cómodas y prácticas'),
('BMX', 'Bicicletas para acrobacias y trucos'),
('Eléctrica', 'Bicicletas con asistencia eléctrica para mayor comodidad');

-- Insertar datos de ejemplo en productos
INSERT INTO productos (nombre, descripcion, precio, stock, tipo_producto_id) VALUES 
('Mountain Bike Pro 2024', 'Bicicleta de montaña profesional con suspensión completa', 1500000, 10, 1),
('Mountain Bike Basic', 'Bicicleta de montaña para principiantes', 900000, 15, 1),
('Road Racer 3000', 'Bicicleta de ruta de alta gama con cuadro de carbono', 2000000, 5, 2),
('Road Speed 500', 'Bicicleta de ruta económica pero eficiente', 1200000, 8, 2),
('City Cruiser', 'Bicicleta urbana cómoda con portaequipaje', 800000, 20, 3),
('Urban Flex', 'Bicicleta urbana plegable, ideal para transporte', 950000, 12, 3),
('BMX Street Pro', 'BMX profesional para street y park', 600000, 7, 4),
('E-Bike Urban', 'Bicicleta eléctrica para ciudad con batería de larga duración', 3500000, 4, 5),
('E-Bike Mountain', 'Bicicleta eléctrica de montaña para terrenos difíciles', 4200000, 3, 5),
('Kids Mountain', 'Bicicleta de montaña para niños', 450000, 18, 1);