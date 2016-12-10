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
            if (0 === strpos($pathinfo, '/ivq/group')) {
                // join_group
                if ($pathinfo === '/ivq/group/join') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_join_group;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\GroupController::joinGroupAction',  '_format' => 'json',  '_route' => 'join_group',);
                }
                not_join_group:

                // disjoin_group
                if ($pathinfo === '/ivq/group/disjoin') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_disjoin_group;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\GroupController::disjoinGroupAction',  '_format' => 'json',  '_route' => 'disjoin_group',);
                }
                not_disjoin_group:

                // list_member
                if ($pathinfo === '/ivq/group/members') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_list_member;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\GroupController::listMemberAction',  '_format' => 'json',  '_route' => 'list_member',);
                }
                not_list_member:

            }

            // list_my_group
            if ($pathinfo === '/ivq/my-groups') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_list_my_group;
                }

                return array (  '_controller' => 'ApiBundle\\Controller\\GroupController::listMyGroupAction',  '_format' => 'json',  '_route' => 'list_my_group',);
            }
            not_list_my_group:

            // view_group
            if ($pathinfo === '/ivq/group/view') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_view_group;
                }

                return array (  '_controller' => 'ApiBundle\\Controller\\GroupController::viewGroupAction',  '_format' => 'json',  '_route' => 'view_group',);
            }
            not_view_group:

            if (0 === strpos($pathinfo, '/ivq/event')) {
                // attendees
                if ($pathinfo === '/ivq/event/attendees') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_attendees;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\AttendeeController::attendeesAction',  '_format' => 'json',  '_route' => 'attendees',);
                }
                not_attendees:

                if (0 === strpos($pathinfo, '/ivq/event/c')) {
                    // confirm_attendance
                    if ($pathinfo === '/ivq/event/confirm') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_confirm_attendance;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\AttendeeController::confirmAttendanceAction',  '_format' => 'json',  '_route' => 'confirm_attendance',);
                    }
                    not_confirm_attendance:

                    // cancel_attendance
                    if ($pathinfo === '/ivq/event/cancel') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_cancel_attendance;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\AttendeeController::cancelAttendanceAction',  '_format' => 'json',  '_route' => 'cancel_attendance',);
                    }
                    not_cancel_attendance:

                }

            }

            // search_followers
            if ($pathinfo === '/ivq/follower/search') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_search_followers;
                }

                return array (  '_controller' => 'ApiBundle\\Controller\\FollowerController::searchFollowersAction',  '_format' => 'json',  '_route' => 'search_followers',);
            }
            not_search_followers:

            if (0 === strpos($pathinfo, '/ivq/broadcast')) {
                // broadcast_list
                if ($pathinfo === '/ivq/broadcast/list') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_broadcast_list;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\BroadcastController::broadcastListAction',  '_format' => 'json',  '_route' => 'broadcast_list',);
                }
                not_broadcast_list:

                // broadcast_view
                if ($pathinfo === '/ivq/broadcast/view') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_broadcast_view;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\BroadcastController::broadcastViewAction',  '_format' => 'json',  '_route' => 'broadcast_view',);
                }
                not_broadcast_view:

            }

            if (0 === strpos($pathinfo, '/ivq/media')) {
                // media_list
                if ($pathinfo === '/ivq/media') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_media_list;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\MediaController::mediaListAction',  '_format' => 'json',  '_route' => 'media_list',);
                }
                not_media_list:

                // add_media
                if ($pathinfo === '/ivq/media/add') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_add_media;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\MediaController::addMediaAction',  '_format' => 'json',  '_route' => 'add_media',);
                }
                not_add_media:

                // delete_media
                if ($pathinfo === '/ivq/media/delete') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_delete_media;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\MediaController::deleteMediaAction',  '_format' => 'json',  '_route' => 'delete_media',);
                }
                not_delete_media:

            }

            // add_media_to_event
            if ($pathinfo === '/ivq/events/media/add') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_add_media_to_event;
                }

                return array (  '_controller' => 'ApiBundle\\Controller\\MediaController::addMediaToEventAction',  '_format' => 'json',  '_route' => 'add_media_to_event',);
            }
            not_add_media_to_event:

            if (0 === strpos($pathinfo, '/ivq/favorites')) {
                if (0 === strpos($pathinfo, '/ivq/favorites/groups')) {
                    // list_favourite_groups
                    if ($pathinfo === '/ivq/favorites/groups/list') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_list_favourite_groups;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\FavouriteController::listFavouriteGroupsAction',  '_format' => 'json',  '_route' => 'list_favourite_groups',);
                    }
                    not_list_favourite_groups:

                    // add_group_favourite
                    if ($pathinfo === '/ivq/favorites/groups/add') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_add_group_favourite;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\FavouriteController::addGroupFavouriteAction',  '_format' => 'json',  '_route' => 'add_group_favourite',);
                    }
                    not_add_group_favourite:

                    // remove_group
                    if ($pathinfo === '/ivq/favorites/groups/remove') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_remove_group;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\FavouriteController::removeGroupAction',  '_format' => 'json',  '_route' => 'remove_group',);
                    }
                    not_remove_group:

                }

                if (0 === strpos($pathinfo, '/ivq/favorites/members')) {
                    // list_favourite_members
                    if ($pathinfo === '/ivq/favorites/members/list') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_list_favourite_members;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\FavouriteController::listFavouriteMembersAction',  '_format' => 'json',  '_route' => 'list_favourite_members',);
                    }
                    not_list_favourite_members:

                    // add_member_favourite
                    if ($pathinfo === '/ivq/favorites/members/add') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_add_member_favourite;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\FavouriteController::addMemberFavouriteAction',  '_format' => 'json',  '_route' => 'add_member_favourite',);
                    }
                    not_add_member_favourite:

                    // remove_member
                    if ($pathinfo === '/ivq/favorites/members/remove') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_remove_member;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\FavouriteController::removeMemberAction',  '_format' => 'json',  '_route' => 'remove_member',);
                    }
                    not_remove_member:

                }

            }

            // get_my_business_card
            if ($pathinfo === '/ivq/business-card/generate') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_my_business_card;
                }

                return array (  '_controller' => 'ApiBundle\\Controller\\BusinessCardController::getMyBusinessCardAction',  '_format' => 'json',  '_route' => 'get_my_business_card',);
            }
            not_get_my_business_card:

            // list_my_business_card
            if ($pathinfo === '/ivq/me/business-card/list') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_list_my_business_card;
                }

                return array (  '_controller' => 'ApiBundle\\Controller\\BusinessCardController::listMyBusinessCardAction',  '_format' => 'json',  '_route' => 'list_my_business_card',);
            }
            not_list_my_business_card:

            if (0 === strpos($pathinfo, '/ivq/business-card')) {
                // list_business_card
                if ($pathinfo === '/ivq/business-card/list') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_list_business_card;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\BusinessCardController::listBusinessCardAction',  '_format' => 'json',  '_route' => 'list_business_card',);
                }
                not_list_business_card:

                // view_business_card
                if ($pathinfo === '/ivq/business-card/view') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_view_business_card;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\BusinessCardController::viewBusinessCardAction',  '_format' => 'json',  '_route' => 'view_business_card',);
                }
                not_view_business_card:

                // new_business_card
                if ($pathinfo === '/ivq/business-card/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_new_business_card;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\BusinessCardController::newBusinessCardAction',  '_format' => 'json',  '_route' => 'new_business_card',);
                }
                not_new_business_card:

                // create_business_card
                if ($pathinfo === '/ivq/business-card/create') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_create_business_card;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\BusinessCardController::createBusinessCardAction',  '_format' => 'json',  '_route' => 'create_business_card',);
                }
                not_create_business_card:

                // add_media_to_business_card
                if ($pathinfo === '/ivq/business-card/media/add') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_add_media_to_business_card;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\BusinessCardController::addMediaToBusinessCardAction',  '_format' => 'json',  '_route' => 'add_media_to_business_card',);
                }
                not_add_media_to_business_card:

            }

            // get_demos
            if ($pathinfo === '/ivq/testing') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_demos;
                }

                return array (  '_controller' => 'ApiBundle\\Controller\\DemoController::getDemosAction',  '_format' => 'json',  '_route' => 'get_demos',);
            }
            not_get_demos:

            if (0 === strpos($pathinfo, '/ivq/coupon')) {
                // list_coupons
                if ($pathinfo === '/ivq/coupon/list') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_list_coupons;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\CouponController::listCouponsAction',  '_format' => 'json',  '_route' => 'list_coupons',);
                }
                not_list_coupons:

                // view_coupon
                if ($pathinfo === '/ivq/coupon/view') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_view_coupon;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\CouponController::viewCouponAction',  '_format' => 'json',  '_route' => 'view_coupon',);
                }
                not_view_coupon:

            }

            if (0 === strpos($pathinfo, '/ivq/survey/v')) {
                // view_survey
                if ($pathinfo === '/ivq/survey/view') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_view_survey;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\CouponController::viewSurveyAction',  '_format' => 'json',  '_route' => 'view_survey',);
                }
                not_view_survey:

                // vote_survey
                if ($pathinfo === '/ivq/survey/vote') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_vote_survey;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\CouponController::voteSurveyAction',  '_format' => 'json',  '_route' => 'vote_survey',);
                }
                not_vote_survey:

            }

            // index
            if (preg_match('#^/ivq/(?P<id>[^/]++)/index$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PATCH') {
                    $allow[] = 'PATCH';
                    goto not_index;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'index')), array (  '_controller' => 'ApiBundle\\Controller\\DefaultController::indexAction',  '_format' => 'json',));
            }
            not_index:

            if (0 === strpos($pathinfo, '/ivq/comment')) {
                // list_comments_by_media
                if ($pathinfo === '/ivq/comments/list') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_list_comments_by_media;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\CommentController::listCommentsByMediaAction',  '_format' => 'json',  '_route' => 'list_comments_by_media',);
                }
                not_list_comments_by_media:

                // add_comment
                if ($pathinfo === '/ivq/comment/add') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_add_comment;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\CommentController::addCommentAction',  '_format' => 'json',  '_route' => 'add_comment',);
                }
                not_add_comment:

            }

            if (0 === strpos($pathinfo, '/ivq/me')) {
                // add_liketo_media
                if ($pathinfo === '/ivq/media-attached/like') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_add_liketo_media;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\CommentController::addLiketoMediaAction',  '_format' => 'json',  '_route' => 'add_liketo_media',);
                }
                not_add_liketo_media:

                if (0 === strpos($pathinfo, '/ivq/member')) {
                    // member_profile
                    if ($pathinfo === '/ivq/member/profile') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_member_profile;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\MemberController::memberProfileAction',  '_format' => 'json',  '_route' => 'member_profile',);
                    }
                    not_member_profile:

                    // follow_member
                    if ($pathinfo === '/ivq/member/follow') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_follow_member;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\MemberController::followMemberAction',  '_format' => 'json',  '_route' => 'follow_member',);
                    }
                    not_follow_member:

                    // unfollow_member
                    if ($pathinfo === '/ivq/member/unfollow') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_unfollow_member;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\MemberController::unfollowMemberAction',  '_format' => 'json',  '_route' => 'unfollow_member',);
                    }
                    not_unfollow_member:

                }

            }

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

                if (0 === strpos($pathinfo, '/ivq/profile/follow')) {
                    // get_following
                    if ($pathinfo === '/ivq/profile/following') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_following;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\ProfileController::getFollowingAction',  '_format' => 'json',  '_route' => 'get_following',);
                    }
                    not_get_following:

                    // get_follower
                    if ($pathinfo === '/ivq/profile/followers') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_follower;
                        }

                        return array (  '_controller' => 'ApiBundle\\Controller\\ProfileController::getFollowerAction',  '_format' => 'json',  '_route' => 'get_follower',);
                    }
                    not_get_follower:

                }

                // update
                if ($pathinfo === '/ivq/profile/update') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_update;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\ProfileController::updateAction',  '_format' => 'json',  '_route' => 'update',);
                }
                not_update:

            }

        }

        if (0 === strpos($pathinfo, '/app')) {
            // reset_token
            if ($pathinfo === '/app/token/reset') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_reset_token;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\SecurityController::resetTokenAction',  '_format' => 'json',  '_route' => 'reset_token',);
            }
            not_reset_token:

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

            // list_groups
            if ($pathinfo === '/app/group/list') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_list_groups;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\GroupController::listGroupsAction',  '_format' => 'json',  '_route' => 'list_groups',);
            }
            not_list_groups:

            // list_nearby_groups
            if ($pathinfo === '/app/nearby') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_list_nearby_groups;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\GroupController::listNearbyGroupsAction',  '_format' => 'json',  '_route' => 'list_nearby_groups',);
            }
            not_list_nearby_groups:

            // search_groups
            if ($pathinfo === '/app/group/search') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_search_groups;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\GroupController::searchGroupsAction',  '_format' => 'json',  '_route' => 'search_groups',);
            }
            not_search_groups:

            // list_categories
            if ($pathinfo === '/app/category/list') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_list_categories;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\CategoryController::listCategoriesAction',  '_format' => 'json',  '_route' => 'list_categories',);
            }
            not_list_categories:

            // linkedin_login
            if ($pathinfo === '/app/linkedin/login') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_linkedin_login;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\LinkedinController::linkedinLoginAction',  '_format' => 'json',  '_route' => 'linkedin_login',);
            }
            not_linkedin_login:

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

                // list_media_by_event
                if ($pathinfo === '/app/event/media/list') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_list_media_by_event;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\EventsController::listMediaByEventAction',  '_format' => 'json',  '_route' => 'list_media_by_event',);
                }
                not_list_media_by_event:

            }

        }

        if (0 === strpos($pathinfo, '/testing')) {
            // api_demo_getdemos
            if ($pathinfo === '/testing') {
                return array (  '_controller' => 'ApiBundle\\Controller\\DemoController::getDemosAction',  '_route' => 'api_demo_getdemos',);
            }

            // api_demo_getdemos_1
            if ($pathinfo === '/testing') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_demo_getdemos_1;
                }

                return array (  '_controller' => 'ApiBundle\\Controller\\DemoController::getDemosAction',  '_route' => 'api_demo_getdemos_1',);
            }
            not_api_demo_getdemos_1:

        }

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

        // my-business-card
        if (0 === strpos($pathinfo, '/business-card/generate') && preg_match('#^/business\\-card/generate/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'my-business-card')), array (  '_controller' => 'ApiBundle\\Controller\\DefaultController::indexAction',));
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
