<?php require_once __DIR__.'/functions.php'; ?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= isset($pageTitle) ? e($pageTitle).' | Biblioteca' : 'Biblioteca' ?></title>
<link rel="stylesheet" href="assets/style.css"></head><body>
<aside class="sidebar"><div class="brand"><span class="brand-icon">▤</span><div><b>Biblioteca</b><small>Sistema de gestión</small></div></div>
<nav><a href="index.php" class="<?=basename($_SERVER['PHP_SELF'])==='index.php'?'active':''?>">▦ &nbsp; Panel principal</a>
<a href="libros.php" class="<?=basename($_SERVER['PHP_SELF'])==='libros.php'?'active':''?>">▤ &nbsp; Libros</a>
<a href="miembros.php" class="<?=basename($_SERVER['PHP_SELF'])==='miembros.php'?'active':''?>">♙ &nbsp; Miembros</a>
<a href="prestamos.php" class="<?=basename($_SERVER['PHP_SELF'])==='prestamos.php'?'active':''?>">⇄ &nbsp; Préstamos</a></nav>
<div class="sidebar-bottom">Proyecto académico<br><small>PHP · MySQL · XAMPP</small></div></aside>
<main class="main"><header class="topbar"><div><span class="eyebrow">ADMINISTRACIÓN</span><h2><?=isset($pageTitle)?e($pageTitle):'Panel principal'?></h2></div><div class="user-chip">● &nbsp; Administrador</div></header>
<section class="content"><?php show_flash(); ?>
