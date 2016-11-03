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
use AppBundle\Entity\country;
use AppBundle\Entity\State;
use AppBundle\Repository\GroupCategoryRepository;
use AppBundle\Repository\StateRepository;

class LoadGroupData implements FixtureInterface, ContainerAwareInterface
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
        //creating the country
        $em = $this->container->get('doctrine')->getEntityManager();
        $country = new country();
        $country->setCode('US');
        $country->setName('United States of America');
        $em->persist($country);
        $em->flush();


        //creating the states 
        $state = new State();
        $state->setcountry($country);
        $state->setCode('AL');
        $state->setName('Alabama');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('AK');
        $state->setName('Alaska');
        $em->persist($state);
        
        $state = new State();
        $state->setcountry($country);
        $state->setCode('AZ');
        $state->setName('Arizona');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('AR');
        $state->setName('Arkansas');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('CA');
        $state->setName('California');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('CO');
        $state->setName('Colorado');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('CT');
        $state->setName('Connecticut');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('DE');
        $state->setName('Delaware');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('DC');
        $state->setName('District of Columbia');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('FL');
        $state->setName('Florida');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('GA');
        $state->setName('Georgia');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('HI');
        $state->setName('Hawaii');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('ID');
        $state->setName('Idaho');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('IL');
        $state->setName('Illinois');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('IN');
        $state->setName('Indiana');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('IA');
        $state->setName('Iowa');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('KS');
        $state->setName('Kansas');
        $em->persist($state);
      
        $state = new State();
        $state->setcountry($country);
        $state->setCode('KY');
        $state->setName('Kentucky');
        $em->persist($state);

        $state = new State();
        $state->setcountry($country);
        $state->setCode('LA');
        $state->setName('Louisiana');
        $em->persist($state);
      
        $state = new State();
        $state->setcountry($country);
        $state->setCode('ME');
        $state->setName('Maine');
        $em->persist($state);

        $em->flush();

        $groupCategory = new GroupCategory();
        $groupCategory->setName("Internet");
        $em->persist($groupCategory);

        $groupCategory = new GroupCategory();
        $groupCategory->setName("Food Delivery");
        $em->persist($groupCategory);

        $groupCategory = new GroupCategory();
        $groupCategory->setName("Services");
        $em->persist($groupCategory);
        
        $groupCategory = new GroupCategory();
        $groupCategory->setName("Green Labor");
        $em->persist($groupCategory);
        
        $groupCategory = new GroupCategory();
        $groupCategory->setName("Technologies");
        $em->persist($groupCategory);
        
        $groupCategory = new GroupCategory();
        $groupCategory->setName("Social Marketing");
        $em->persist($groupCategory);
        $em->flush();
        

        $states = $em->getRepository("AppBundle:State")->findAll();

    for ($i=0; $i <100 ; $i++) { 
         $key=array_rand($states,1);
        $group = new Groups();
        $random =(Util::randomize(6))%5 ;
        $categories = $em->getRepository("AppBundle:GroupCategory")->findAll();
        $group->setCategory($categories[$random]);
        $group->setName("Group".$i);
        $group->setDescription(" Some description is needed here");
        $random =Util::randomize(6);
        $group->setPhone("70235".$random);
        $group->setEmail("group".$i."@gmail.com");
        $group->setWebsite("group".$i.".info.com");

        $address = new Address();
        $address->setState($em->getRepository("AppBundle:State")->find($states[$key]->getId()));
        $address->setAddress("Address ".$random);
        $address->setCity("City ".$random);
        $zip =Util::randomize(4);
        if ($zip<1000) $zip=$zip +3000;
        $address->setZip(Util::randomize(4));

        $group->setAddress($address);
        $em->persist($group);
        
    }   
       $em->flush();
    
    }
}