<?php
namespace StatusHistory\Controller\Admin;

use RS\Html\Table;
use RS\Html\Filter;
use RS\Controller\Admin\Crud;
use StatusHistory\Model\StatusHistoryApi;
use RS\Html\Table\Type as TableType;
use RS\Html\Toolbar\Button as ToolbarButton;

/**
* Контроллер Управление списком магазинов сети
*/
class Control extends Crud
{
    function __construct()
    {
        //Устанавливаем, с каким API будет работать CRUD контроллер
        parent::__construct(new StatusHistoryApi());
    }

    function helperIndex()
    {
        $helper = parent::helperIndex(); //Получим helper по-умолчанию
        $helper->setTopTitle('Админ. часть модуля StatusHistory'); //Установим заголовок раздела

        //Отобразим таблицу со списком объектов
        $helper->setTable(new Table\Element(array('Columns' => array(
            new TableType\Checkbox('id', array(
                'ThAttr' => array('width' => 20)
            )),
            new TableType\Text('title', 'Название', array(
                'Sortable' => SORTABLE_BOTH,
                'href' => $this->router->getAdminPattern('edit', array(
                    ':id' => '@id'
                )),
                'LinkAttr' => array('class' => 'crud-edit')
            )),
            new TableType\Actions(
                'id',
                array(new TableType\Action\Edit($this->router->getAdminPattern('edit', array(
                    ':id' => '~field~'
                )))),
                array('SettingsUrl' => $this->router->getAdminUrl('tableOptions'))
            )
        ))));

        //Добавим фильтр значений в таблице по названию
        $helper->setFilter(new Filter\Control( array(
            'Container' => new Filter\Container( array(
                'Lines' =>  array(
                    new Filter\Line( array('items' => array(
                        new Filter\Type\Text('title', 'Название', array(
                            'SearchType' => '%like%'
                        ))
                    )))
                )
            ))
        )));

        return $helper;
    }
}
