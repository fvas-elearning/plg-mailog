<?php
namespace Ml\Listener;

use Tk\Event\Subscriber;
use Tk\Kernel\KernelEvents;
use Tk\Event\ControllerEvent;
use Tk\Event\GetResponseEvent;
use Tk\Event\Event;
use Ml\Plugin;

/**
 * @author Michael Mifsud <info@tropotek.com>
 * @link http://www.tropotek.com/
 * @license Copyright 2015 Michael Mifsud
 */
class ExampleHandler implements Subscriber
{


    public function __construct()
    {
    }


    /**
     *
     * @param GetResponseEvent $event
     */
    public function onSystemInit(GetResponseEvent $event)
    {
        //$this->plugin = Plugin::getInstance();
        //vd('Example: onSystemInit');

        //vd($event->getRequest()->getAttribute('courseCode'));
        //vd(\Tk\Config::getInstance()->getCourse());

    }

    /**
     * Check the user has access to this controller
     *
     * @param ControllerEvent $event
     * @throws \Tk\Exception
     */
    public function onControllerAccess(ControllerEvent $event)
    {
        $plugin = Plugin::getInstance();
        //$config = $plugin->getConfig();

    }

    /**
     * Check the user has access to this controller
     *
     * @param Event $event
     * @throws \Tk\Exception
     */
    public function onControllerShow(Event $event)
    {
        $plugin = Plugin::getInstance();
        //$config = $plugin->getConfig();
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
            KernelEvents::REQUEST => array('onSystemInit', -10),
            KernelEvents::CONTROLLER => array('onControllerAccess', 0),
            \Tk\PageEvents::CONTROLLER_SHOW => array('onControllerShow', 0)
        );
    }
    
}