<?php
require 'config/database.php'; $pageTitle='Panel principal';
$libros=(int)$pdo->query("SELECT COUNT(*) FROM libros")->fetchColumn();
$miembros=(int)$pdo->query("SELECT COUNT(*) FROM miembros")->fetchColumn();
$activos=(int)$pdo->query("SELECT COUNT(*) FROM prestamos WHERE estado='Prestado'")->fetchColumn();
$vencidos=(int)$pdo->query("SELECT COUNT(*) FROM prestamos WHERE estado='Prestado' AND fecha_devolucion < CURDATE()")->fetchColumn();
$recent=$pdo->query("SELECT p.prestamo_id,p.fecha_prestamo,p.fecha_devolucion,p.estado,l.titulo,CONCAT(m.nombre,' ',m.apellido) miembro FROM prestamos p JOIN libros l ON l.libro_id=p.libro_id JOIN miembros m ON m.miembro_id=p.miembro_id ORDER BY p.prestamo_id DESC LIMIT 6")->fetchAll();
require 'includes/header.php';
?>
<div class="welcome"><div><span class="eyebrow light">BIENVENIDO</span><h1>Tu biblioteca, bajo control.</h1><p>Administra el catálogo, los miembros y los préstamos desde un solo lugar.</p></div><div class="welcome-art">▤</div></div>
<div class="stats">
<div class="stat-card"><div class="stat-icon purple">▤</div><span>Total de libros</span><strong><?=$libros?></strong><small>Libros registrados</small></div>
<div class="stat-card"><div class="stat-icon blue">♙</div><span>Miembros</span><strong><?=$miembros?></strong><small>Personas suscritas</small></div>
<div class="stat-card"><div class="stat-icon orange">⇄</div><span>Préstamos activos</span><strong><?=$activos?></strong><small>Libros pendientes de devolución</small></div>
<div class="stat-card"><div class="stat-icon red">◷</div><span>Préstamos vencidos</span><strong><?=$vencidos?></strong><small>Requieren seguimiento</small></div></div>
<div class="section-head"><div><h3>Préstamos recientes</h3><p>Últimos movimientos registrados en el sistema.</p></div><a class="btn primary" href="prestamos.php">＋ Nuevo préstamo</a></div>
<div class="table-wrap"><table><thead><tr><th>Libro</th><th>Miembro</th><th>Fecha préstamo</th><th>Fecha devolución</th><th>Estado</th></tr></thead><tbody>
<?php if(!$recent): ?><tr><td colspan="5" class="empty">Todavía no hay préstamos registrados.</td></tr><?php endif; ?>
<?php foreach($recent as $r): ?><tr><td><b><?=e($r['titulo'])?></b></td><td><?=e($r['miembro'])?></td><td><?=e($r['fecha_prestamo'])?></td><td><?=e($r['fecha_devolucion'])?></td><td><span class="status <?=$r['estado']==='Devuelto'?'returned':($r['fecha_devolucion']<date('Y-m-d')?'late':'active')?>"><?=e($r['estado']==='Devuelto'?'Devuelto':($r['fecha_devolucion']<date('Y-m-d')?'Vencido':'Prestado'))?></span></td></tr><?php endforeach; ?>
</tbody></table></div>
<?php require 'includes/footer.php'; ?>