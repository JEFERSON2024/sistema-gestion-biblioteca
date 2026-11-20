CREATE DATABASE IF NOT EXISTS biblioteca_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE biblioteca_db;
CREATE TABLE IF NOT EXISTS libros (
 libro_id INT AUTO_INCREMENT PRIMARY KEY,
 titulo VARCHAR(180) NOT NULL,
 autor VARCHAR(150) NOT NULL,
 genero VARCHAR(100) DEFAULT NULL,
 anio_publicacion YEAR DEFAULT NULL,
 creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS miembros (
 miembro_id INT AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(100) NOT NULL,
 apellido VARCHAR(100) NOT NULL,
 email VARCHAR(160) NOT NULL UNIQUE,
 fecha_suscripcion DATE NOT NULL,
 creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS prestamos (
 prestamo_id INT AUTO_INCREMENT PRIMARY KEY,
 libro_id INT NOT NULL,
 miembro_id INT NOT NULL,
 fecha_prestamo DATE NOT NULL,
 fecha_devolucion DATE NOT NULL,
 fecha_devolucion_real DATE DEFAULT NULL,
 estado ENUM('Prestado','Devuelto') NOT NULL DEFAULT 'Prestado',
 creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_prestamo_libro FOREIGN KEY(libro_id) REFERENCES libros(libro_id) ON UPDATE CASCADE ON DELETE RESTRICT,
 CONSTRAINT fk_prestamo_miembro FOREIGN KEY(miembro_id) REFERENCES miembros(miembro_id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;
-- Datos de demostración (opcionales; elimine estas líneas si desea iniciar vacío)
INSERT INTO libros(titulo,autor,genero,anio_publicacion) VALUES
('Cien años de soledad','Gabriel García Márquez','Novela',1967),
('Don Quijote de la Mancha','Miguel de Cervantes','Clásico',1605),
('La ciudad y los perros','Mario Vargas Llosa','Novela',1963);
INSERT INTO miembros(nombre,apellido,email,fecha_suscripcion) VALUES
('Ana','Pérez','ana.perez@ejemplo.com',CURDATE()),
('Carlos','Mendoza','carlos.mendoza@ejemplo.com',CURDATE());
