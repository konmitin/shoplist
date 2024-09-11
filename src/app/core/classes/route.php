<?php

// класс маршрутизатора
class Route
{
// метод запускающий маршрутизацию
    public static function start() {

        $controller_name = 'index'; // контроллер по умолчанию
        $action_name = 'index'; // действие по умолчанию

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        //
        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }
        //
        if(!empty($routes[2])) {
            $action_name = $routes[2];
        }
        
        // Добавляем преффиксы
        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $action_name = 'Action_' . $action_name;
        
        // Добавляем файл модели (его может не быть)
        $model_file = strtolower($model_name) . '.php'; // строим имя файла модели 
        $model_path = 'app/models/' . $model_file;  // строим путь до файла модели

        if(file_exists($model_path)) {
            include $model_path;
        }

        // Добавляем файл контроллера, он всегда должен быть, поэтому, если такого файла нет, 
        // то переводим пользователя на страницу 404
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "app/controllers/" . $controller_file;

        if(file_exists($controller_path)) {
            include $controller_path;
        } else {
            Route::ErrorPage404();
        }

        $controller = new $controller_name;
        $action = $action_name;

        // Проверяем есть ли у полученного контроллера полученны метод
        // и если есть, то выполняем, если нет переводим на 404
        if(method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::ErrorPage404();
        }

    }

    public static function ErrorPage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'];
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'/404.php');
    } 
}

?>