<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Groups;
use Core\ComunBundle\Util\Util;
use AppBundle\Entity\GroupCategory;
use AppBundle\Entity\Address;
use AppBundle\Entity\Member;
use AppBundle\Repository\GroupCategoryRepository;
use AppBundle\Repository\StateRepository;

class LoadMemberData implements FixtureInterface, ContainerAwareInterface
{
	     /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
 
    }
}