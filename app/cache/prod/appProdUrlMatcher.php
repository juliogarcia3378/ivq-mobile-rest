<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/ivq/hello')) {
            // acme_api_default_index
            if ($pathinfo === '/ivq/hello') {
                return array (  '_controller' => 'Acme\\ApiBundle\\Controller\\DefaultController::indexAction',  '_route' => 'acme_api_default_index',);
            }

            // acme_api_default_index_1
            if ($pathinfo === '/ivq/hello') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_acme_api_default_index_1;
                }

                return array (  '_controller' => 'Acme\\ApiBundle\\Controller\\DefaultController::indexAction',  '_route' => 'acme_api_default_index_1',);
            }
            not_acme_api_default_index_1:

        }

        // index
        if ($pathinfo === '/login') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_index;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_format' => 'json',  '_route' => 'index',);
        }
        not_index:

        // nelmio_api_doc_index
        if (0 === strpos($pathinfo, '/api/doc') && preg_match('#^/api/doc(?:/(?P<view>[^/]++))?$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_nelmio_api_doc_index;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'nelmio_api_doc_index')), array (  '_controller' => 'Nelmio\\ApiDocBundle\\Controller\\ApiDocController::indexAction',  'view' => 'default',));
        }
        not_nelmio_api_doc_index:

        // fos_oauth_server_token
        if ($pathinfo === '/oauth/v2/token') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_oauth_server_token;
            }

            return array (  '_controller' => 'fos_oauth_server.controller.token:tokenAction',  '_route' => 'fos_oauth_server_token',);
        }
        not_fos_oauth_server_token:

        // get_demos
        if ($pathinfo === '/demos') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_demos;
            }

            return array (  '_controller' => 'Acme\\ApiBundle\\Controller\\DemoController::getDemosAction',  '_format' => 'json',  '_route' => 'get_demos',);
        }
        not_get_demos:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
