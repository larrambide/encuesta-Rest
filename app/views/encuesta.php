<div class="media n2 p34 center block" ng-controller="encuesta">
	<div class="block_pad">
		<h1 class="title">¿Qué te parecio tu estancia?</h1>

		<p class="important_text">Selecciona una opción por cada pregunta</p>

		<div>
			<p class="ask_text" ng-show="ask == 1">¿Eres hombre o mujer?</p>
			<p class="ask_text" ng-show="ask == 2">¿Qué edad tienes?</p>
			<p class="ask_text" ng-show="ask == 3">¿Qué te pareció el Servicio?</p>
			<p class="ask_text" ng-show="ask == 4">¿Qué te pareció la comida?</p>
			<p class="ask_text" ng-show="ask == 5">¿Qué te pareció la higiene?</p>
			<p class="ask_text" ng-show="ask == 6">¿Qué te pareció el precio?</p>

			<div class="ask_block" ng-show="ask == 1">
				<a href="#" class="ask_link" ng-click="select_answer(1)">Hombre</a>
				<a href="#" class="ask_link" ng-click="select_answer(2)">Mujer</a>
			</div>

			<div class="ask_block" ng-show="ask == 2">
				<a href="#" class="ask_link" ng-click="select_answer(1)">0 a 5</a>
				<a href="#" class="ask_link" ng-click="select_answer(2)">6 a 12</a>
				<a href="#" class="ask_link" ng-click="select_answer(3)">13 a 18</a>
				<a href="#" class="ask_link" ng-click="select_answer(4)">19 a 24</a>
				<a href="#" class="ask_link" ng-click="select_answer(5)">25 en adelante</a>
			</div>

			<div class="ask_block" ng-show="ask > 2 && ask < 7">
				<a href="#" ng-click="select_answer(5)"><img width="48px" src="public/img/iconos/c5.jpg" /></a>
				<a href="#" ng-click="select_answer(4)"><img width="48px" src="public/img/iconos/c4.jpg" /></a>
				<a href="#" ng-click="select_answer(3)"><img width="48px" src="public/img/iconos/c3.jpg" /></a>
				<a href="#" ng-click="select_answer(2)"><img width="48px" src="public/img/iconos/c2.jpg" /></a>
				<a href="#" ng-click="select_answer(1)"><img width="48px" src="public/img/iconos/c1.jpg" /></a>
			</div>

			<div class="ask_block" ng-show="ask == 7">
				<p class="success">Gracias por llenar la encuesta</p>
			</div>

			<a href="#" class="button" ng-click="go_before()" ng-show="ask >= 2 && ask < 7">Anterior</a>
			<a href="#" class="button" ng-click="go_next()"  ng-show="ask <= 6 && yet_fill >= ask">Siguiente</a>

		</div>

		

		<a href="inicio" class="link return_link">Inicio</a>
	</div>
	
</div>