<?php namespace StatusHistory\Config;

use \RS\Router\Route;
use \RS\Event\HandlerAbstract;

/**
* Класс содержит обработчики событий, на которые подписан модуль
*/
class Handlers extends HandlerAbstract
{
    /**
    * Добавляет подписку на события
    *
    * @return void
    */
    function init()
    {
        $this
            ->bind('getroute')  //событие сбора маршрутов модулей
            ->bind('getmenus'); //событие сбора пунктов меню для административной панели
    }

    /**
    * Возвращает маршруты данного модуля. Откликается на событие getRoute.
    * @param array $routes - массив с объектами маршрутов
    * @return array of \RS\Router\Route
    */
    public static function getRoute(array $routes)
    {
        $routes[] = new Route('statushistory-front-ctrl',
        array(
            '/statushistory/'
        ), null, 'Роут модуля StatusHistory');

        return $routes;
    }

    /**
    * Возвращает пункты меню этого модуля в виде массива
    * @param array $items - массив с пунктами меню
    * @return array
    */
    public static function getMenus($items)
    {
        $items[] = array(
            'title' => 'История статусов',
            'alias' => 'statushistory-control',
            'link' => '%ADMINPATH%/statushistory/',
            'parent' => 'modules',
            'sortn' => 40,
            'typelink' => 'link',
        );
        return $items;
    }
}
