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

        if (0 === strpos($pathinfo, '/ivq')) {
            if (0 === strpos($pathinfo, '/ivq/hello')) {
                // api_default_index
                if ($pathinfo === '/ivq/hello') {
                    return array (  '_controller' => 'ApiBundle\\Controller\\DefaultController::indexAction',  '_route' => 'api_default_index',);
                }

                // api_default_index_1
                if ($pathinfo === '/ivq/hello') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_default_index_1;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\DefaultController::indexAction',  '_route' => 'api_default_index_1',);
                }
                not_api_default_index_1:

            }

            if (0 === strpos($pathinfo, '/ivq/profile')) {
                // api_profile_profile
                if ($pathinfo === '/ivq/profile') {
                    return array (  '_controller' => 'ApiBundle\\Controller\\ProfileController::profileAction',  '_route' => 'api_profile_profile',);
                }

                // api_profile_profile_1
                if ($pathinfo === '/ivq/profile') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_profile_profile_1;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\ProfileController::profileAction',  '_route' => 'api_profile_profile_1',);
                }
                not_api_profile_profile_1:

            }

        }

        if (0 === strpos($pathinfo, '/app')) {
            // register_consumer
            if ($pathinfo === '/app/register') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_register_consumer;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\SecurityController::registerConsumerAction',  '_format' => 'json',  '_route' => 'register_consumer',);
            }
            not_register_consumer:

            // login
            if ($pathinfo === '/app/login') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_login;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\SecurityController::loginAction',  '_format' => 'json',  '_route' => 'login',);
            }
            not_login:

            // forgot_password
            if ($pathinfo === '/app/forgot-password') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_forgot_password;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\SecurityController::forgotPasswordAction',  '_format' => 'json',  '_route' => 'forgot_password',);
            }
            not_forgot_password:

        }

        // get_demos
        if ($pathinfo === '/demos') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_demos;
            }

            return array (  '_controller' => 'ApiBundle\\Controller\\DemoController::getDemosAction',  '_format' => 'json',  '_route' => 'get_demos',);
        }
        not_get_demos:

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

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
