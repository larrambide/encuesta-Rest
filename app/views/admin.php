<div class="media n2 center block" ng-controller="admin">
	<div class="block_pad">
		<h1 class="title">Resultados de Encuesta de Satisfacción al Cliente</h1>

		<div>

			<div class="filters">
				<a href="#" class="filter" ng-click="change_gender(0)" ng-class="gender_filter == 0? 'used' : ''">Genero</a>
				<a href="#" class="filter" ng-click="change_gender(1)" ng-class="gender_filter == 1? 'used' : ''">Hombre</a>
				<a href="#" class="filter" ng-click="change_gender(2)" ng-class="gender_filter == 2? 'used' : ''">Mujer</a>
				<div class="clear"></div>
			</div>

			<div class="filters">
				<a href="#" class="filter" ng-click="change_age(0)" ng-class="age_filter == 0? 'used' : ''">Edad</a>
				<a href="#" class="filter" ng-click="change_age(1)" ng-class="age_filter == 1? 'used' : ''">0 a 5</a>
				<a href="#" class="filter" ng-click="change_age(2)" ng-class="age_filter == 2? 'used' : ''">6 a 12</a>
				<a href="#" class="filter" ng-click="change_age(3)" ng-class="age_filter == 3? 'used' : ''">13 a 18</a>
				<a href="#" class="filter" ng-click="change_age(4)" ng-class="age_filter == 4? 'used' : ''">19 a 24</a>
				<a href="#" class="filter" ng-click="change_age(5)" ng-class="age_filter == 5? 'used' : ''">25 en adelante</a>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			
			<div class="res_block">
				<h3>Análisis general</h3>

				<p class="res_text"><span>Servicios:</span> {{results.servicio}}</p>
				<p class="res_text"><span>Comida:</span> {{results.comida}}</p>
				<p class="res_text"><span>Limpieza:</span> {{results.limpieza}}</p>
				<p class="res_text"><span>Precio:</span> {{results.precio}}</p>

			</div>


			<div class="res_block">
				<h3>Análisis del servicio</h3>

				<p class="res_text" ng-show="results.servicio >= 4.5">El servicio va perfecto</p>
				<p class="res_text" ng-show="results.servicio >= 4 && results.servicio < 4.5">El servicio va muy bien</p>
				<p class="res_text" ng-show="results.servicio >= 3 && results.servicio < 4">El servicio va bien</p>
				<p class="res_text" ng-show="results.servicio >= 1 && results.servicio < 3">El servicio anda mal</p>
				<p class="res_text" ng-show="results.servicio >= 0 && results.servicio < 1">El servicio está muy mal</p>

				<p class="res_text" ng-show="results.comida >= 4.5">El comida está de maravilla</p>
				<p class="res_text" ng-show="results.comida >= 4 && results.comida < 4.5">La comida va muy bien</p>
				<p class="res_text" ng-show="results.comida >= 3 && results.comida < 4">La comida va bien</p>
				<p class="res_text" ng-show="results.comida >= 1 && results.comida < 3">La comida anda mal</p>
				<p class="res_text" ng-show="results.comida >= 0 && results.comida < 1">La comida está muy mal</p>

				<p class="res_text" ng-show="results.limpieza >= 4.5">El limpieza está de maravilla</p>
				<p class="res_text" ng-show="results.limpieza >= 4 && results.limpieza < 4.5">La limpieza va muy bien</p>
				<p class="res_text" ng-show="results.limpieza >= 3 && results.limpieza < 4">La limpieza va bien</p>
				<p class="res_text" ng-show="results.limpieza >= 1 && results.limpieza < 3">La limpieza anda mal</p>
				<p class="res_text" ng-show="results.limpieza >= 0 && results.limpieza < 1">La limpieza está muy mal</p>

				<p class="res_text" ng-show="results.precio >= 4.5">El precio va perfecto</p>
				<p class="res_text" ng-show="results.precio >= 4 && results.precio < 4.5">El precio va muy bien</p>
				<p class="res_text" ng-show="results.precio >= 3 && results.precio < 4">El precio va bien</p>
				<p class="res_text" ng-show="results.precio >= 1 && results.precio < 3">El precio anda mal</p>
				<p class="res_text" ng-show="results.precio >= 0 && results.precio < 1">El precio está muy mal</p>
			</div>

			<div class="res_block">
				<h3>Análisis por genero</h3>

				<p class="res_text" ng-show="results.c_servicio == 2">A las mujeres les gusta más el servicio</p>
				<p class="res_text" ng-show="results.c_servicio == 1">A los hombres les gusta más el servicio</p>

				<p class="res_text" ng-show="results.c_comida == 2">A las mujeres les gusta más la comida</p>
				<p class="res_text" ng-show="results.c_comida == 1">A los hombres les gusta más la comida</p>

				<p class="res_text" ng-show="results.c_limpieza == 2">A las mujeres les gusta más la limpieza</p>
				<p class="res_text" ng-show="results.c_limpieza == 1">A los hombres les gusta más la limpieza</p>

				<p class="res_text" ng-show="results.c_precio == 2">A las mujeres les gusta más el precio</p>
				<p class="res_text" ng-show="results.c_precio == 1">A los hombres les gusta más el precio</p>
			</div>

		</div>
		

		<a href="inicio" class="link return_link">Inicio</a>
	</div>
	
</div>
