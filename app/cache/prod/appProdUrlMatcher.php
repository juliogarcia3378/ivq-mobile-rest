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
            // index
            if ($pathinfo === '/ivq/index') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_index;
                }

                return array (  '_controller' => 'ApiBundle\\Controller\\DefaultController::indexAction',  '_format' => 'json',  '_route' => 'index',);
            }
            not_index:

            if (0 === strpos($pathinfo, '/ivq/profile')) {
                // profile
                if ($pathinfo === '/ivq/profile') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_profile;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\ProfileController::profileAction',  '_format' => 'json',  '_route' => 'profile',);
                }
                not_profile:

                // update
                if ($pathinfo === '/ivq/profile/update') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_update;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\ProfileController::updateAction',  '_format' => 'json',  '_route' => 'update',);
                }
                not_update:

            }

        }

        if (0 === strpos($pathinfo, '/app')) {
            if (0 === strpos($pathinfo, '/app/event')) {
                // list_event
                if ($pathinfo === '/app/event/list') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_list_event;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\EventsController::listEventAction',  '_format' => 'json',  '_route' => 'list_event',);
                }
                not_list_event:

                // details_event
                if ($pathinfo === '/app/event/detail') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_details_event;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\EventsController::detailsEventAction',  '_format' => 'json',  '_route' => 'details_event',);
                }
                not_details_event:

            }

            if (0 === strpos($pathinfo, '/app/group')) {
                // list_groups
                if ($pathinfo === '/app/group/list') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_list_groups;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\GroupController::listGroupsAction',  '_format' => 'json',  '_route' => 'list_groups',);
                }
                not_list_groups:

                // join_group
                if ($pathinfo === '/app/group/join') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_join_group;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\GroupController::joinGroupAction',  '_format' => 'json',  '_route' => 'join_group',);
                }
                not_join_group:

                // dis_join_group
                if ($pathinfo === '/app/group/disjoin') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_dis_join_group;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\GroupController::disJoinGroupAction',  '_format' => 'json',  '_route' => 'dis_join_group',);
                }
                not_dis_join_group:

                // list_member
                if ($pathinfo === '/app/group/members') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_list_member;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\GroupController::listMemberAction',  '_format' => 'json',  '_route' => 'list_member',);
                }
                not_list_member:

            }

            // register_consumer
            if ($pathinfo === '/app/register') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_register_consumer;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\SecurityController::registerConsumerAction',  '_format' => 'json',  '_route' => 'register_consumer',);
            }
            not_register_consumer:

            // activate_user
            if ($pathinfo === '/app/user/activate') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_activate_user;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\SecurityController::activateUserAction',  '_format' => 'json',  '_route' => 'activate_user',);
            }
            not_activate_user:

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

            // reset_password
            if ($pathinfo === '/app/password/reset') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_reset_password;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\SecurityController::resetPasswordAction',  '_format' => 'json',  '_route' => 'reset_password',);
            }
            not_reset_password:

            // country
            if ($pathinfo === '/app/country/list') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_country;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\StateController::countryAction',  '_format' => 'json',  '_route' => 'country',);
            }
            not_country:

            // state
            if ($pathinfo === '/app/state/list') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_state;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\StateController::stateAction',  '_format' => 'json',  '_route' => 'state',);
            }
            not_state:

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
