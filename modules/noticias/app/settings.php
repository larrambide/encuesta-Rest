<?php

$noticias = new giga();

$noticias->load_from_app($app);

$noticias->is_module = true;
$noticias->name = 'noticias';
$noticias->base_route = 'noticias';

//$noticias->set_js('app',array('app.js'));
//$noticias->set_css('app',array('noticias.css'));

?>