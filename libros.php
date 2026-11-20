<?php
require 'config/database.php'; require 'includes/functions.php'; $pageTitle='Gestión de libros';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $id=(int)($_POST['libro_id']??0); $titulo=trim($_POST['titulo']??''); $autor=trim($_POST['autor']??''); $genero=trim($_POST['genero']??''); $anio=(int)($_POST['anio_publicacion']??0);
 if($titulo===''||$autor===''){flash('El título y el autor son obligatorios.','error');redirect('libros.php');}
 if($id){$s=$pdo->prepare("UPDATE libros SET titulo=?,autor=?,genero=?,anio_publicacion=? WHERE libro_id=?");$s->execute([$titulo,$autor,$genero,$anio?:null,$id]);flash('Libro actualizado correctamente.');}
 else{$s=$pdo->prepare("INSERT INTO libros(titulo,autor,genero,anio_publicacion) VALUES(?,?,?,?)");$s->execute([$titulo,$autor,$genero,$anio?:null]);flash('Libro registrado correctamente.');} redirect('libros.php');
}
if(isset($_GET['eliminar'])){try{$s=$pdo->prepare("DELETE FROM libros WHERE libro_id=?");$s->execute([(int)$_GET['eliminar']]);flash('Libro eliminado.');}catch(PDOException $e){flash('No se puede eliminar: el libro tiene préstamos asociados.','error');}redirect('libros.php');}
$edit=null;if(isset($_GET['editar'])){$s=$pdo->prepare("SELECT * FROM libros WHERE libro_id=?");$s->execute([(int)$_GET['editar']]);$edit=$s->fetch();}
$q=trim($_GET['q']??'');$s=$pdo->prepare("SELECT l.*, (SELECT COUNT(*) FROM prestamos p WHERE p.libro_id=l.libro_id AND p.estado='Prestado') ocupados FROM libros l WHERE l.titulo LIKE ? OR l.autor LIKE ? OR l.genero LIKE ? ORDER BY l.libro_id DESC");$like="%$q%";$s->execute([$like,$like,$like]);$rows=$s->fetchAll();
require 'includes/header.php'; ?>
<div class="section-head"><div><h3>Catálogo de libros</h3><p>Registra y administra los ejemplares de la biblioteca.</p></div><span class="count-pill"><?=count($rows)?> registros</span></div>
<div class="panel form-panel"><h3><?=$edit?'Editar libro':'Registrar nuevo libro'?></h3><form method="post" class="form-grid">
<input type="hidden" name="libro_id" value="<?=e($edit['libro_id']??'')?>"><label>Título<input required name="titulo" value="<?=e($edit['titulo']??'')?>" placeholder="Nombre del libro"></label>
<label>Autor<input required name="autor" value="<?=e($edit['autor']??'')?>" placeholder="Nombre del autor"></label><label>Género<input name="genero" value="<?=e($edit['genero']??'')?>" placeholder="Ej. Novela"></label>
<label>Año de publicación<input type="number" min="0" max="2100" name="anio_publicacion" value="<?=e($edit['anio_publicacion']??'')?>" placeholder="2024"></label>
<div class="form-actions"><button class="btn primary" type="submit"><?=$edit?'Guardar cambios':'＋ Registrar libro'?></button><?php if($edit):?><a class="btn secondary" href="libros.php">Cancelar</a><?php endif;?></div></form></div>
<form class="searchbar"><input name="q" value="<?=e($q)?>" placeholder="Buscar por título, autor o género..."><button class="btn secondary">Buscar</button><?php if($q):?><a class="btn ghost" href="libros.php">Limpiar</a><?php endif;?></form>
<div class="table-wrap"><table><thead><tr><th>ID</th><th>Título</th><th>Autor</th><th>Género</th><th>Año</th><th>Disponibilidad</th><th>Acciones</th></tr></thead><tbody>
<?php if(!$rows):?><tr><td colspan="7" class="empty">No se encontraron libros.</td></tr><?php endif; foreach($rows as $r):?><tr><td>#<?=e($r['libro_id'])?></td><td><b><?=e($r['titulo'])?></b></td><td><?=e($r['autor'])?></td><td><?=e($r['genero'])?></td><td><?=e($r['anio_publicacion'])?></td><td><span class="status <?=$r['ocupados']?'active':'returned'?>"><?=$r['ocupados']?'Prestado':'Disponible'?></span></td><td class="actions"><a href="?editar=<?=$r['libro_id']?>">Editar</a><a class="danger-link" data-confirm="¿Eliminar este libro?" href="?eliminar=<?=$r['libro_id']?>">Eliminar</a></td></tr><?php endforeach;?>
</tbody></table></div><?php require 'includes/footer.php'; ?>