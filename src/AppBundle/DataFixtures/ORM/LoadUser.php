<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Core\ComunBundle\Util\Util;
use AppBundle\Entity\Profile;
use AppBundle\Entity\Follow;
use AppBundle\Entity\Member;
use AppBundle\Entity\State;
use AppBundle\Entity\Address;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
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
	$em = $this->container->get('doctrine')->getEntityManager();
    $userManager = $this->container->get('fos_user.user_manager');
    $states = $em->getRepository("AppBundle:State")->findAll();


    for ($i=0; $i <100 ; $i++) { 
    	$key=array_rand($states,1);
	
	    $user = $userManager->createUser();
        $user->setUsername("user".$i);
        $user->setEmail("user".$i."@gmail.com");
        $user->setConfirmationToken("");
        $user->addRoleMember();
        $user->setEnabled(true);
        $encoder_service = $this->container->get('security.encoder_factory');
        $encoder = $encoder_service->getEncoder($user);
        $encoded_pass = $encoder->encodePassword("user".$i, $user->getSalt());
        $user->setPassword($encoded_pass);

        $profile = new Profile();
        $profile->setName("name".$i);
        $profile->setLastName("lastname".$i);
        $profile->setAvatar("");
        $random =Util::randomize(6);
        $profile->setPhone("70235".$random);
        $user->setProfile($profile);

 		$address = new Address();
        $address->setState($em->getRepository("AppBundle:State")->find($states[$key]->getId()));
        $address->setAddress("Address ".$random);
        $address->setCity("City ".$random);
        $zip =Util::randomize(4);
        if ($zip<1000) $zip=$zip +3000;
        $address->setZip(Util::randomize(4));
        $em->persist($address);
        $profile->setAddress($address);
        $userManager->updateUser($user);
        
    }

     $groups= $em->getRepository("AppBundle:Groups")->findAll();
     $users= $em->getRepository("AppBundle:User")->findAll();
     //creating the fixtures for follower
     
    /* for ($i=0; $i <10 ; $i++) { 
     	 $following  = $users[(int)(Util::randomize(2))];
     	  for ($j=0;$j<10;$j++){
     	  	{
     	  	 	$follower = $users[(int)(Util::randomize(2))];
     	   	} while($following->getId()==$follower->getId())


     	  }
       
      }
      $em->flush();
*/


    //creating the fixtures for members

         
        for ($i=0; $i <100 ; $i++) { 
        	
        $member = new Member();

        $member->setGroups($groups[(int)(Util::randomize(2))]);
        $member->setUser($users[(int)(Util::randomize(2))]);
        $em->persist($member);
        }
        $em->flush();
    }
}