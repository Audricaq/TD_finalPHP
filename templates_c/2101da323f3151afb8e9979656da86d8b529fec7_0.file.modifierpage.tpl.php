<?php
/* Smarty version 3.1.33, created on 2019-02-09 16:35:07
  from 'C:\wamp64\www\blogiut\templates\modifierpage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c5f013b271fd6_91581715',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2101da323f3151afb8e9979656da86d8b529fec7' => 
    array (
      0 => 'C:\\wamp64\\www\\blogiut\\templates\\modifierpage.tpl',
      1 => 1549657726,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c5f013b271fd6_91581715 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
    <body>
	
<form action = "modifierpage.php" method = "post">
		<input name="texte" id="texte" placeholder="texte">
		<input name="titre" id="titre" placeholder="titre">
		<!-- pour recupéré l'id passé en get -->    
		<input type="hidden" value="" id="id" name="id">
		<input type="submit" value="Modifier"/>
	</form>	
	</body>
</html><?php }
}
