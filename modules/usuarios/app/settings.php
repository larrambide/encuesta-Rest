<?php

$usuarios= new giga();

$usuarios->load_from_app($app);

$usuarios->is_module = true;
$usuarios->name = 'usuarios';
$usuarios->base_route = 'usuarios';

$usuarios->set_js('app',array('app.js'));
$usuarios->set_css('app',array('usuarios.css'));

?>