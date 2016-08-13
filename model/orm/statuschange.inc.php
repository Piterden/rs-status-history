<?php namespace StatusHistory\Model\Orm;

use RS\Orm\Type;
use RS\Orm\OrmObject;

/**
* ORM объект
*
* Изменение статуса заказа
*/
class StatusChange extends OrmObject
{
    protected static
        $table = 'order_status_history';

    function _init()
    {
        parent::_init()->append(array(
            'site_id' => new Type\CurrentSite(),
            'order_id' => new Type\Integer(array(
                'maxLength' => '12',
                'description' => t('Идентификатор заказа'),
            )),
            'status_id' => new Type\Integer(array(
                'maxLength' => '12',
                'description' => t('Идентификатор статуса'),
            )),
            'old_status_id' => new Type\Integer(array(
                'maxLength' => '12',
                'description' => t('Идентификатор старого статуса'),
            )),
            'dateof' => new Type\Datetime(array(
                'description' => t('Дата изменения'),
            )),
            'admin_comments' => new Type\Text(array(
                'description' => t('Комментарии администратора (не отображаются пользователю)'),
                'Attr' => array(array('class' => 'fullwide')),
            )),
            'user_text' => new Type\Richtext(array(
                'description' => t('Текст для покупателя'),
                'Attr' => array(array('class' => 'fullwide'))
            ))
        ));
    }
}
