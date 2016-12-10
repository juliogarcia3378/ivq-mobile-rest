<?php

namespace Proxies\__CG__\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class User extends \AppBundle\Entity\User implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', 'id', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'profile', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'advertiser', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'invalidAttempts', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'member', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'favourite_group', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'favourite_member', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'businesscard', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'media', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'comment', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'likeMedia', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'attendee', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'accessToken', 'token', 'linkedinID', 'username', 'usernameCanonical', 'email', 'emailCanonical', 'enabled', 'salt', 'password', 'plainPassword', 'lastLogin', 'confirmationToken', 'passwordRequestedAt', 'groups', 'locked', 'expired', 'expiresAt', 'roles', 'credentialsExpired', 'credentialsExpireAt'];
        }

        return ['__isInitialized__', 'id', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'profile', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'advertiser', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'invalidAttempts', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'member', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'favourite_group', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'favourite_member', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'businesscard', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'media', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'comment', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'likeMedia', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'attendee', '' . "\0" . 'AppBundle\\Entity\\User' . "\0" . 'accessToken', 'token', 'linkedinID', 'username', 'usernameCanonical', 'email', 'emailCanonical', 'enabled', 'salt', 'password', 'plainPassword', 'lastLogin', 'confirmationToken', 'passwordRequestedAt', 'groups', 'locked', 'expired', 'expiresAt', 'roles', 'credentialsExpired', 'credentialsExpireAt'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (User $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getGroupsId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroupsId', []);

        return parent::getGroupsId();
    }

    /**
     * {@inheritDoc}
     */
    public function isAdmin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isAdmin', []);

        return parent::isAdmin();
    }

    /**
     * {@inheritDoc}
     */
    public function isAdvertiser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isAdvertiser', []);

        return parent::isAdvertiser();
    }

    /**
     * {@inheritDoc}
     */
    public function isMember()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isMember', []);

        return parent::isMember();
    }

    /**
     * {@inheritDoc}
     */
    public function onlyProfe()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'onlyProfe', []);

        return parent::onlyProfe();
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRoles', []);

        return parent::getRoles();
    }

    /**
     * {@inheritDoc}
     */
    public function addRoleAdmin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addRoleAdmin', []);

        return parent::addRoleAdmin();
    }

    /**
     * {@inheritDoc}
     */
    public function addRoleAdvertiser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addRoleAdvertiser', []);

        return parent::addRoleAdvertiser();
    }

    /**
     * {@inheritDoc}
     */
    public function addRoleMember()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addRoleMember', []);

        return parent::addRoleMember();
    }

    /**
     * {@inheritDoc}
     */
    public function setToken($token)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setToken', [$token]);

        return parent::setToken($token);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroups()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroups', []);

        return parent::getGroups();
    }

    /**
     * {@inheritDoc}
     */
    public function setLinkedinID($linkedinID)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLinkedinID', [$linkedinID]);

        return parent::setLinkedinID($linkedinID);
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkedinID()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLinkedinID', []);

        return parent::getLinkedinID();
    }

    /**
     * {@inheritDoc}
     */
    public function setProfile(\AppBundle\Entity\Profile $profile)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProfile', [$profile]);

        return parent::setProfile($profile);
    }

    /**
     * {@inheritDoc}
     */
    public function getProfile()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProfile', []);

        return parent::getProfile();
    }

    /**
     * {@inheritDoc}
     */
    public function setAdvertiser(\AppBundle\Entity\Advertiser $advertiser)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAdvertiser', [$advertiser]);

        return parent::setAdvertiser($advertiser);
    }

    /**
     * {@inheritDoc}
     */
    public function getAdvertiser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAdvertiser', []);

        return parent::getAdvertiser();
    }

    /**
     * {@inheritDoc}
     */
    public function setInvalidAttempts(\AppBundle\Entity\InvalidAttempts $invalidAttempts)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInvalidAttempts', [$invalidAttempts]);

        return parent::setInvalidAttempts($invalidAttempts);
    }

    /**
     * {@inheritDoc}
     */
    public function removeInvalidAttempts()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeInvalidAttempts', []);

        return parent::removeInvalidAttempts();
    }

    /**
     * {@inheritDoc}
     */
    public function getInvalidAttempts()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInvalidAttempts', []);

        return parent::getInvalidAttempts();
    }

    /**
     * {@inheritDoc}
     */
    public function addMember(\AppBundle\Entity\Member $member)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addMember', [$member]);

        return parent::addMember($member);
    }

    /**
     * {@inheritDoc}
     */
    public function removeMember(\AppBundle\Entity\Member $member)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeMember', [$member]);

        return parent::removeMember($member);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembers', []);

        return parent::getMembers();
    }

    /**
     * {@inheritDoc}
     */
    public function addBusinessCard(\AppBundle\Entity\BusinessCard $businesscard)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addBusinessCard', [$businesscard]);

        return parent::addBusinessCard($businesscard);
    }

    /**
     * {@inheritDoc}
     */
    public function removeBusinessCard(\AppBundle\Entity\BusinessCard $businesscard)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeBusinessCard', [$businesscard]);

        return parent::removeBusinessCard($businesscard);
    }

    /**
     * {@inheritDoc}
     */
    public function getBusinessCard()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBusinessCard', []);

        return parent::getBusinessCard();
    }

    /**
     * {@inheritDoc}
     */
    public function addFavouriteGroup(\AppBundle\Entity\FavouriteGroup $favourite_group)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addFavouriteGroup', [$favourite_group]);

        return parent::addFavouriteGroup($favourite_group);
    }

    /**
     * {@inheritDoc}
     */
    public function removeFavouriteGroup(\AppBundle\Entity\FavouriteGroup $favourite_group)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeFavouriteGroup', [$favourite_group]);

        return parent::removeFavouriteGroup($favourite_group);
    }

    /**
     * {@inheritDoc}
     */
    public function getFavouriteGroup()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFavouriteGroup', []);

        return parent::getFavouriteGroup();
    }

    /**
     * {@inheritDoc}
     */
    public function addFavouriteMember(\AppBundle\Entity\FavouriteMember $favourite_member)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addFavouriteMember', [$favourite_member]);

        return parent::addFavouriteMember($favourite_member);
    }

    /**
     * {@inheritDoc}
     */
    public function removeFavouriteMember(\AppBundle\Entity\FavouriteMember $favourite_member)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeFavouriteMember', [$favourite_member]);

        return parent::removeFavouriteMember($favourite_member);
    }

    /**
     * {@inheritDoc}
     */
    public function getFavouriteMember()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFavouriteMember', []);

        return parent::getFavouriteMember();
    }

    /**
     * {@inheritDoc}
     */
    public function addMedia(\AppBundle\Entity\Media $media)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addMedia', [$media]);

        return parent::addMedia($media);
    }

    /**
     * {@inheritDoc}
     */
    public function removeMedia(\AppBundle\Entity\Media $media)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeMedia', [$media]);

        return parent::removeMedia($media);
    }

    /**
     * {@inheritDoc}
     */
    public function getMedia()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMedia', []);

        return parent::getMedia();
    }

    /**
     * {@inheritDoc}
     */
    public function addComment(\AppBundle\Entity\Comment $comment)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addComment', [$comment]);

        return parent::addComment($comment);
    }

    /**
     * {@inheritDoc}
     */
    public function removeComment(\AppBundle\Entity\Comment $media)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeComment', [$media]);

        return parent::removeComment($media);
    }

    /**
     * {@inheritDoc}
     */
    public function getComment()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getComment', []);

        return parent::getComment();
    }

    /**
     * {@inheritDoc}
     */
    public function addLikeMedia(\AppBundle\Entity\LikeMedia $like_)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addLikeMedia', [$like_]);

        return parent::addLikeMedia($like_);
    }

    /**
     * {@inheritDoc}
     */
    public function removeLikeMedia(\AppBundle\Entity\LikeMedia $like_)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeLikeMedia', [$like_]);

        return parent::removeLikeMedia($like_);
    }

    /**
     * {@inheritDoc}
     */
    public function getLikeMedia()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLikeMedia', []);

        return parent::getLikeMedia();
    }

    /**
     * {@inheritDoc}
     */
    public function addRole($role)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addRole', [$role]);

        return parent::addRole($role);
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'serialize', []);

        return parent::serialize();
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($serialized)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'unserialize', [$serialized]);

        return parent::unserialize($serialized);
    }

    /**
     * {@inheritDoc}
     */
    public function eraseCredentials()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'eraseCredentials', []);

        return parent::eraseCredentials();
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsername', []);

        return parent::getUsername();
    }

    /**
     * {@inheritDoc}
     */
    public function getUsernameCanonical()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsernameCanonical', []);

        return parent::getUsernameCanonical();
    }

    /**
     * {@inheritDoc}
     */
    public function getSalt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSalt', []);

        return parent::getSalt();
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailCanonical()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailCanonical', []);

        return parent::getEmailCanonical();
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassword', []);

        return parent::getPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function getPlainPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPlainPassword', []);

        return parent::getPlainPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function getLastLogin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastLogin', []);

        return parent::getLastLogin();
    }

    /**
     * {@inheritDoc}
     */
    public function getConfirmationToken()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getConfirmationToken', []);

        return parent::getConfirmationToken();
    }

    /**
     * {@inheritDoc}
     */
    public function hasRole($role)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasRole', [$role]);

        return parent::hasRole($role);
    }

    /**
     * {@inheritDoc}
     */
    public function isAccountNonExpired()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isAccountNonExpired', []);

        return parent::isAccountNonExpired();
    }

    /**
     * {@inheritDoc}
     */
    public function isAccountNonLocked()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isAccountNonLocked', []);

        return parent::isAccountNonLocked();
    }

    /**
     * {@inheritDoc}
     */
    public function isCredentialsNonExpired()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isCredentialsNonExpired', []);

        return parent::isCredentialsNonExpired();
    }

    /**
     * {@inheritDoc}
     */
    public function isCredentialsExpired()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isCredentialsExpired', []);

        return parent::isCredentialsExpired();
    }

    /**
     * {@inheritDoc}
     */
    public function isEnabled()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isEnabled', []);

        return parent::isEnabled();
    }

    /**
     * {@inheritDoc}
     */
    public function isExpired()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isExpired', []);

        return parent::isExpired();
    }

    /**
     * {@inheritDoc}
     */
    public function isLocked()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isLocked', []);

        return parent::isLocked();
    }

    /**
     * {@inheritDoc}
     */
    public function isSuperAdmin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isSuperAdmin', []);

        return parent::isSuperAdmin();
    }

    /**
     * {@inheritDoc}
     */
    public function isUser(\FOS\UserBundle\Model\UserInterface $user = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isUser', [$user]);

        return parent::isUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function removeRole($role)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeRole', [$role]);

        return parent::removeRole($role);
    }

    /**
     * {@inheritDoc}
     */
    public function setUsername($username)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsername', [$username]);

        return parent::setUsername($username);
    }

    /**
     * {@inheritDoc}
     */
    public function setUsernameCanonical($usernameCanonical)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsernameCanonical', [$usernameCanonical]);

        return parent::setUsernameCanonical($usernameCanonical);
    }

    /**
     * {@inheritDoc}
     */
    public function setCredentialsExpireAt(\DateTime $date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCredentialsExpireAt', [$date]);

        return parent::setCredentialsExpireAt($date);
    }

    /**
     * {@inheritDoc}
     */
    public function setCredentialsExpired($boolean)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCredentialsExpired', [$boolean]);

        return parent::setCredentialsExpired($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailCanonical($emailCanonical)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailCanonical', [$emailCanonical]);

        return parent::setEmailCanonical($emailCanonical);
    }

    /**
     * {@inheritDoc}
     */
    public function setEnabled($boolean)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEnabled', [$boolean]);

        return parent::setEnabled($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function setExpired($boolean)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExpired', [$boolean]);

        return parent::setExpired($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function setExpiresAt(\DateTime $date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExpiresAt', [$date]);

        return parent::setExpiresAt($date);
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassword', [$password]);

        return parent::setPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function setSuperAdmin($boolean)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSuperAdmin', [$boolean]);

        return parent::setSuperAdmin($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function setPlainPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPlainPassword', [$password]);

        return parent::setPlainPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function setLastLogin(\DateTime $time)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastLogin', [$time]);

        return parent::setLastLogin($time);
    }

    /**
     * {@inheritDoc}
     */
    public function setLocked($boolean)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLocked', [$boolean]);

        return parent::setLocked($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function setConfirmationToken($confirmationToken)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setConfirmationToken', [$confirmationToken]);

        return parent::setConfirmationToken($confirmationToken);
    }

    /**
     * {@inheritDoc}
     */
    public function setPasswordRequestedAt(\DateTime $date = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPasswordRequestedAt', [$date]);

        return parent::setPasswordRequestedAt($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getPasswordRequestedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPasswordRequestedAt', []);

        return parent::getPasswordRequestedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function isPasswordRequestNonExpired($ttl)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isPasswordRequestNonExpired', [$ttl]);

        return parent::isPasswordRequestNonExpired($ttl);
    }

    /**
     * {@inheritDoc}
     */
    public function setRoles(array $roles)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRoles', [$roles]);

        return parent::setRoles($roles);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroupNames()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroupNames', []);

        return parent::getGroupNames();
    }

    /**
     * {@inheritDoc}
     */
    public function hasGroup($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasGroup', [$name]);

        return parent::hasGroup($name);
    }

    /**
     * {@inheritDoc}
     */
    public function addGroup(\FOS\UserBundle\Model\GroupInterface $group)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addGroup', [$group]);

        return parent::addGroup($group);
    }

    /**
     * {@inheritDoc}
     */
    public function removeGroup(\FOS\UserBundle\Model\GroupInterface $group)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeGroup', [$group]);

        return parent::removeGroup($group);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', []);

        return parent::__toString();
    }

}