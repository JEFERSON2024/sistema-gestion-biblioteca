# Sistema de Gestión de Biblioteca

Aplicación web académica desarrollada con PHP, MySQL, HTML, CSS y JavaScript, preparada para ejecutarse localmente en XAMPP.

## Requisitos
- XAMPP con Apache y MySQL.
- PHP 7.4 o superior (recomendado PHP 8.x).
- Navegador web.

## Instalación en XAMPP
1. Descomprima `sistema_gestion_biblioteca.zip`.
2. Copie la carpeta `sistema_gestion_biblioteca` dentro de `C:\xampp\htdocs\`.
3. Abra el panel de XAMPP e inicie **Apache** y **MySQL**.
4. Entre a `http://localhost/phpmyadmin`.
5. Seleccione **Importar**, elija el archivo `database.sql` y pulse **Continuar**. El script crea `biblioteca_db` y sus tablas con datos de demostración.
6. Abra `http://localhost/sistema_gestion_biblioteca/`.

## Módulos
- Panel principal con indicadores y préstamos recientes.
- Libros: crear, listar, buscar, editar y eliminar.
- Miembros: crear, listar, buscar, editar y eliminar.
- Préstamos: registrar préstamo, controlar disponibilidad y registrar devoluciones.
- Alertas visuales para préstamos vencidos.

## Modelo de datos
- `libros`: libro_id, titulo, autor, genero, anio_publicacion.
- `miembros`: miembro_id, nombre, apellido, email, fecha_suscripcion.
- `prestamos`: prestamo_id, libro_id, miembro_id, fecha_prestamo, fecha_devolucion, fecha_devolucion_real, estado.

Las relaciones de préstamos con libros y miembros usan claves foráneas. Los registros relacionados no se pueden eliminar mientras tengan préstamos asociados.

## Configuración
La conexión está en `config/database.php`. En una instalación XAMPP estándar, el usuario es `root` y la contraseña está vacía. Si su instalación tiene otra contraseña, actualice `$user` y `$pass`.

## Publicar en GitHub
Desde la carpeta del proyecto:
```bash
git init
git add .
git commit -m "Proyecto sistema de gestion de biblioteca"
git branch -M main
git remote add origin https://github.com/USUARIO/sistema-gestion-biblioteca.git
git push -u origin main
```
Cree antes un repositorio vacío en GitHub y reemplace `USUARIO` por su usuario. No incluya contraseñas reales en el repositorio.

## Nota
Los datos de demostración son opcionales y pueden eliminarse del final de `database.sql` si se desea iniciar con la base vacía.
