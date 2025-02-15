<?php
namespace Tk\Ml\Listener;

use Tk\Event\Subscriber;
use Tk\Event\Event;
use Tk\Ml\Db\MailLog;
use Tk\Ml\Plugin;

/**
 * @author Michael Mifsud <info@tropotek.com>
 * @see http://www.tropotek.com/
 * @license Copyright 2015 Michael Mifsud
 */
class MenuHandler implements Subscriber
{

    /**
     * @var \Bs\Controller\Iface
     */
    protected $controller = null;


    /**
     * @param Event $event
     * @throws \Tk\Exception
     */
    public function onControllerInit(Event $event)
    {
        /** @var \Bs\Controller\Iface $controller */
//        $this->controller = \Tk\Event\Event::findControllerObject($event);

        $config = \Bs\Config::getInstance();
        $user = $config->getAuthUser();

        if ($user) {
            $dropdownName = Plugin::getInstance()->getData()->get('plugin.menu.nav.dropdown', 'nav-dropdown');
            $sideName = Plugin::getInstance()->getData()->get('plugin.menu.nav.side', 'nav-side');

            $dropdownMenu = $config->getMenuManager()->getMenu($dropdownName);
            $sideMenu = $config->getMenuManager()->getMenu($sideName);

            $type = $user->getType();


            if ($type == 'admin') {
                $url = \Bs\Uri::createHomeUrl(MailLog::createMailLogUrl('/manager.html'));
//                if ($dropdownMenu)
//                    $dropdownMenu->prepend(\Tk\Ui\Menu\Item::create('Mail Log', $url, 'fa fa-envelope'), 'About');
                if ($sideMenu)
                    $sideMenu->append(\Tk\Ui\Menu\Item::create('Mail Log', $url, 'fa fa-envelope'));
            }
        }

    }



    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
            \Tk\PageEvents::CONTROLLER_INIT => array('onControllerInit', 0)
        );
    }
    
}