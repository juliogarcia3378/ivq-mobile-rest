<?php

/*
 * This file is part of the FOSOAuthServerBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\OAuthServerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use OAuth2\OAuth2;
use OAuth2\OAuth2ServerException;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;

class TokenController
{
    /**
     * @var OAuth2
     */
    protected $server;

    /**
     * @param OAuth2 $server
     */
    public function __construct(OAuth2 $server)
    {
        $this->server = $server;
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Rest\Get("/oauth/v2/token")
     * @ApiDoc(
     *  section = "Authentication", 
     *     headers={
     *         {
                    "name"="no-store,private",
     *             "Cache-Control"="no-store,private",
     *             "Connection"="Close"
     *         }
     *     },
     *  description=" (Step 2) Returns the tokens for the user logged",
     *  requirements={
     *      {
     *          "name"="grant_type",
     *          "dataType"="string",
     *          "description"="word 'password'"
     *      },
            {
     *          "name"="client_id",
     *          "dataType"="string",
     *          "description"="client_id from login response"
     *      },
            {
     *          "name"="client_secret",
     *          "dataType"="string",
     *          "description"="client secret token from login response"
     *      },
            {
     *          "name"="username",
     *          "dataType"="string",
     *          "description"="Username"
     *      },
            {
     *          "name"="password",
     *          "dataType"="password",
     *          "description"="password"
     *      }
     *  }
     * )
     */
    public function tokenAction(Request $request)
    {

        try {
            return $this->server->grantAccessToken($request);
        } catch (OAuth2ServerException $e) {
            return $e->getHttpResponse();
        }
    }
}
