<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Library;

/**
 * Redirect Dispatcher Response Transport
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Dispatcher
 */
class DispatcherResponseTransportRedirect extends DispatcherResponseTransportHttp
{
    /**
     * Initializes the config for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param   ObjectConfig $config  An optional ObjectConfig object with configuration options
     * @return  void
     */
    protected function _initialize(ObjectConfig $config)
    {
        $config->append(array(
            'priority' => self::PRIORITY_HIGH,
        ));

        parent::_initialize($config);
    }

    /**
     * Sends content for the current web response.
     *
     * @param DispatcherResponseInterface $response
     * @return DispatcherResponseTransportRedirect
     */
    public function sendContent(DispatcherResponseInterface $response)
    {
        $session  = $response->getUser()->getSession();

        //Set the messages into the session
        $messages = $response->getMessages();
        if(count($messages))
        {
            //Auto start the session if it's not active.
            if(!$session->isActive()) {
                $session->start();
            }

            $session->getContainer('message')->values($messages);
        }

        //Set the redirect into the response
        $response->setContent(sprintf(
            '<!DOCTYPE html>
                <html>
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <meta http-equiv="refresh" content="1;url=%1$s" />
                        <title>Redirecting to %1$s</title>
                    </head>
                    <body>
                        Redirecting to <a href="%1$s">%1$s</a>.
                    </body>
                </html>'
            , htmlspecialchars($response->headers->get('Location'), ENT_QUOTES, 'UTF-8')
        ));

        return parent::sendContent($response);
    }

    /**
     * Send HTTP response
     *
     * If this is a redirect response, send the response and stop the transport handler chain.
     *
     * @param DispatcherResponseInterface $response
     * @return boolean
     */
    public function send(DispatcherResponseInterface $response)
    {
        if($response->isRedirect()) {
            return parent::send($response);
        }
    }
}