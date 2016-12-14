<?php

namespace ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Profile;
use AppBundle\Entity\Address;
use AppBundle\Entity\Country;
use AppBundle\Entity\State;
use AppBundle\Entity\BusinessCard;
use AppBundle\Entity\BusinessCardMedia;
use AppBundle\Entity\Media;
use Core\ComunBundle\Enums\EMedia;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Request\Request as MyRequest;

class BusinessCardController extends FOSRestController
{ 
    /**
     * @param Request $request
     * @Route("/business-card/generate")
     * @Rest\Get("/business-card/generate")
     * @ApiDoc(
     *  section = "Business Card",
     *  description="*** Generate my business card ",
            *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="string",
     *          "description"="Generate the business card provided"
     *      }
           }
     * )
     */
    public function getMyBusinessCardAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
            $this->get('security.context')->isGranted('ROLE_ADMIN')  === TRUE) 
        {
              $request = $this->getRequest();
              $id = $request->get('id',NULL);
              $knp = $this->container->get('knp_snappy.image');
              $knp->getInternalGenerator()->setTimeout(1000);
              $pageUrl = $this->generateUrl('my-business-card', array('id'=>$id), true);
              $name=uniqid().'.png';
              $url = 'uploads/share/'.$name;
              $knp->generate($pageUrl, $url );
              $base = $this->getParameter('base_directory');
              $path = $base;

              $file= $this->getRequest()->getUriForPath("/".$url);
              $file = str_replace("/app.php", "", $file);
              $file = str_replace("/app_dev.php", "", $file);

              return new JsonResponse(array( "img"=>$file));
        }
        return new JsonResponse(array( "error"=>"You arent a valid user"));
            
    }



     /**
     * @Route("/me/business-card/list")
     * @Rest\Get("/me/business-card/list")
     * @ApiDoc(
     *  section = "Business Card",
     *  description="Returns the business cards ids for user's logged",

     * )
     */
    public function listMyBusinessCardAction()
        {
        	$user = $this->get('security.context')->getToken()->getUser();
            $profile = $user->getProfile();

	        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
             $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
	    	{

                $businessCards = $user->getBusinessCard();
                $response =array();

                foreach ($businessCards as $key => $bc) {
                    if ($bc->getFinished()==true && $bc->getSaved()==false){
                    $bcard['id']=$bc->getId();
                    $bcard['name']=$bc->getName(). " ". $bc->getLastname();
                    $bcard['picture']=$bc->getPicture()->getURL();
                    $bcard['logo']=$bc->getLogo()->getURL();
                    $bcard['category']=$bc->getCategory()->getName();
                    $response[]=$bcard;}
                }
           
	            return new JsonResponse(array("response"=>$response));
	        }

            return new JsonResponse(array( "message"=>"You dont have enough permissions. "));
        }
      

    /**
    * @Route("/saved-business-card/list")
    * @Rest\Get("/saved-business-card/list")
    * @ApiDoc(
    *  section = "Saved Business Card",
    *  description="Returns the saved business cards for user's logged",

    * )
    */
    public function listMySavedBusinessCardAction()
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $profile = $user->getProfile();
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
             $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
                $businessCards = $user->getBusinessCard();
                $response =array();
                foreach ($businessCards as $key => $bc) {
                    if ($bc->getFinished()==true and $bc->getSaved()==false){
                        $bcard['id']=$bc->getId();
                        $bcard['name']=$bc->getName(). " ". $bc->getLastname();
                        $bcard['picture']=$bc->getPicture()->getURL();
                        $bcard['logo']=$bc->getLogo()->getURL();
                        $bcard['category']=$bc->getCategory()->getName();
                        $response[]=$bcard;
                    }
                }
                return new JsonResponse(array("response"=>$response));
            }

            return new JsonResponse(array("message"=>"You dont have enough permissions. "));
        }

     /**
     * @Route("/business-card/remove")
     * @Rest\Get("/business-card/remove")
     * @ApiDoc(
     *  section = "Business Card",
     *  description="Remove any user's b-cards , personal b-cards or saved ",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="string",
     *          "description"="Remove saved business card "
     *      }
           }

     * )
     */
    public function removeSavedBusinessCardAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $profile = $user->getProfile();
        $request = $this->getRequest();
        $id = $request->get('id',NULL);
        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
        $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
        {
            $em= $this->getDoctrine()->getManager();
            $businessCards = $user->getBusinessCard();
            $response =array();
            foreach ($businessCards as $key => $bc) {
                if ($bc->getId()==$id ){
                    $em->remove($bc);
                    $em->flush();
                    return new JsonResponse(array( "message"=>"Operation Sucesfully"));
                }
            }
                return new JsonResponse(array("message"=>"This business card is not valid."));
            }
        return new JsonResponse(array( "message"=>"You dont have enough permissions. "));
    }

    /**
    * @Route("/saved-business-card/add")
    * @Rest\Get("/saved-business-card/add")
    * @ApiDoc(
    *  section = "Saved Business Card",
    *  description="Add to my saved business cards section a copy for the b-card provided",
    *  requirements={
    *      {
    *          "name"="id",
    *          "dataType"="string",
    *          "description"="business card id"
    *      }
          }

     * )
     */
      public function addToSavedBusinessCardAction()
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $request = $this->getRequest();
            $id = $request->get('id',NULL);
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
             $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
               $em= $this->getDoctrine()->getManager();

                $bc = $em->getRepository("AppBundle:BusinessCard")->find($id);

                 if ($bc->getFinished()!=true){
                    return new JsonResponse(array( "message"=>"This business card is not valid."));
                 }

                 $new_bcard = new BusinessCard();
                 $new_bcard->setName($bc->getName());
                 $new_bcard->setLastname($bc->getLastname()); 
                 $new_bcard->setTitle($bc->getTitle());
                 $new_bcard->setCompany($bc->getCompany());
                 $new_bcard->setCategory($bc->getCategory());
                 $new_bcard->setCompany($bc->getCompany());
                 $new_bcard->setPhone($bc->getPhone());
                 $new_bcard->setEmail($bc->getEmail());
                 $new_bcard->setFax($bc->getFax());
                 $new_bcard->setWebsite($bc->getWebsite());
                 $new_bcard->setNotes($bc->getNotes());
                 $new_bcard->setAbout($bc->getAbout());
                 $new_bcard->setFinished($bc->getFinished());
                 $new_bcard->setSaved(true);
                 $new_bcard->setUser($user);
                 
                 $new_picture = $this->copyFile($bc->getPicture()->getURL());
                 $media = new Media();
                 $media->setURL($new_picture);
                 $media->setFormat($bc->getPicture()->getFormat());
                 $new_bcard->setPicture($media);
                 

                 $new_logo = $this->copyFile($bc->getLogo());
                 $media = new Media();
                 $media->setURL($new_logo);
                 $media->setFormat($bc->getLogo()->getFormat());
                 $new_bcard->setLogo($media);


                 $new_address = new Address();
                 $new_address->setState($bc->getAddress()->getState());
                 $new_address->setAddress($bc->getAddress()->getAddress());
                 $new_address->setZip($bc->getAddress()->getZip());
                 $new_address->setCity($bc->getAddress()->getCity());

                 $em->persist($new_address);
                 $new_bcard->setAddress($new_address);

                 $em->persist($new_bcard);
                 $em->flush();
                 return new JsonResponse(array( "message"=>"Operation Sucesfully"));
            }
            return new JsonResponse(array( "message"=>"You dont have enough permissions. "));
        }

       /**
     * @Route("/business-card/list")
     * @Rest\Get("/business-card/list")
     * @ApiDoc(
     *  section = "Business Card",
     *  description="Returns the business cards ids for user provided",
        *  requirements={
     *      {
     *          "name"="id_user",
     *          "dataType"="string",
     *          "description"=" List the business card by user id"
     *      }
           }

     * )
     */
    public function listBusinessCardAction()
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $request = $this->getRequest();
            $profile = $user->getProfile();
            $idUser = $request->get('id_user',NULL);
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
             $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
                $em = $this->getDoctrine()->getEntityManager();
                $anotherUser = $em->getRepository("AppBundle:User")->find($idUser);
                 if (!isset($anotherUser))
                 {
                    return new JsonResponse(array( "message"=>"This is a invalid user."));  
                 }
                $businessCards = $anotherUser->getBusinessCard();
                $response =array();

                  foreach ($businessCards as $key => $bc) {
                    if ($bc->getFinished()==true){
                     $bcard['id']=$bc->getId();
                     $bcard['name']=$bc->getName(). " ". $bc->getLastname();
                     $bcard['picture']=$bc->getPicture()->getURL();
                     $bcard['logo']=$bc->getLogo()->getURL();
                     $bcard['category']=$bc->getCategory()->getName();
                     $response[]=$bcard;}
                  }
           
                return new JsonResponse(array("response"=>$response));
            }

            return new JsonResponse(array( "message"=>"You dont have enough permissions. ")
                                   );
        }
    


       /**
     * @Route("/business-card/view")
     * @Rest\Get("/business-card/view")
     * @ApiDoc(
     *  section = "Business Card",
     *  description="Return the business card provided",
        *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="string",
     *          "description"="Return the business card provided"
     *      }
           }

     * )
     */
      public function viewBusinessCardAction()
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $request = $this->getRequest();
            $id = $request->get('id',NULL);
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
             $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
                $em = $this->getDoctrine()->getEntityManager();

                $bc = $em->getRepository("AppBundle:BusinessCard")->find($id);
                if ($bc==null){
                     return new JsonResponse(array( "message"=>"Invalid Business Card. "));
                }
                if ($bc->getFinished()==false){
                     return new JsonResponse(array( "message"=>"Invalid Business Card. "));
                }
                $response =array();

                     $response['id']=$bc->getId();
                     $response['name']=$bc->getName();
                     $response['lastname']=$bc->getLastname();
                     $response['title']=$bc->getTitle();
                     $response['category']=$bc->getCategory()->getName();
                     $response['address']["state"]=$bc->getAddress()->getState()->getName();
                     $response['address']["zip"]=$bc->getAddress()->getZip();
                     $response['address']["city"]=$bc->getAddress()->getCity();
                     $response['phone']=$bc->getPhone();
                     $response['email']=$bc->getEmail();
                     $response['fax']=$bc->getFax();
                     $response['website']=$bc->getWebsite();
                     $response['notes']=$bc->getNotes();
                     $response['company']=$bc->getCompany();
                     $response['about']=$bc->getAbout();
                     $response['logo']=$bc->getLogo()->getURL();
                     $response['picture']=$bc->getPicture()->getURL();
                      $medias=$bc->getBusinessCardMedia();

                            $response["media"]["video"]=array();
                            $response["media"]["picture"]=array();

                          foreach ($medias as $key => $media) {
                              $arr = array();

                              $arr['id']=$media->getMedia()->getId();
                              $arr['url']=$media->getMedia()->getURL();
                                if ($media->getMedia()->getFormat()=='video'){
                                  $response["media"]["video"][]=$arr;
                                }
                                if ($media->getMedia()->getFormat()=='picture'){
                                  $response["media"]["picture"][]=$arr;

                                  }

                                }
           
                return new JsonResponse(array("response"=>$response));
            }

            return new JsonResponse(array( "message"=>"You dont have enough permissions. ")
                                   );
        }
    
    
       /**
     * @Route("/business-card/new")
     * @Rest\Get("/business-card/new")
     * @ApiDoc(
     *  section = "Business Card",
     *  description="Return the business card id",
     * )
     */
      public function newBusinessCardAction()
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $request = $this->getRequest();
            $id = $request->get('id',NULL);
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
             $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
                $em = $this->getDoctrine()->getManager();
                $bcs= $user->getBusinessCard();
                foreach ($bcs as $key => $bc) {
                    if ($bc->getFinished()==false)
                        return new JsonResponse(array("id"=>$bc->getId()));
                }
                $bc = new BusinessCard();
                $bc->setFinished(0);
                $bc->setUser($user);
                $em->persist($bc);
                $em->flush();
           
                return new JsonResponse(array("id"=>$bc->getId()));
            }

            return new JsonResponse(array( "message"=>"You dont have enough permissions. ")
                                   );
        }


             /**
         * Set and upload avatar for reps.
         *
         * @param ParamFetcher $paramFetcher
         * @param Request $request
          * @Route("/business-card/create")
          * @Rest\Post("/business-card/create")

         * @ApiDoc(
         *  section = "Business Card",
         *      resource = true,
         *      https = true,
         *      description = "Create the business card.",

         * )
         *
        *@RequestParam(name="id", nullable=false, description="id for business card created")
        *@RequestParam(name="name", nullable=false, description="name")
        *@RequestParam(name="lastname", nullable=false, description="last name")
        *@RequestParam(name="title", nullable=false, description="title")
        *@RequestParam(name="category", nullable=false, description="Category")
        *@RequestParam(name="address", nullable=false, description="address")
        *@RequestParam(name="city", nullable=false, description="city")
        *@RequestParam(name="state", nullable=false, description="state id") 
        *@RequestParam(name="phone", nullable=false, description="phone")
        *@RequestParam(name="email", nullable=false, description="email")
        *@RequestParam(name="zip", nullable=false, description="zip")
        *@RequestParam(name="fax", nullable=true, description="fax")
        *@RequestParam(name="website", nullable=true, description="Website")
        *@RequestParam(name="notes", nullable=true, description="Notes")
        *@RequestParam(name="about", nullable=true, description="About")
        *@RequestParam(name="logo", nullable=false, description="Logo")
        *@RequestParam(name="picture", nullable=false, description="Picture")
        *@RequestParam(name="company", nullable=false, description="Company")
         *
         * @return View
         */
         
      public function createBusinessCardAction()

        {
          
 
            $request = $this->getRequest();
            $id= $request->get('id');

            $name= $request->get('name');
            $lastname= $request->get('lastname');
            $title= $request->get('title');

            $category= $request->get('category');

            $address= $request->get('address');
            $city= $request->get('city');
            $state= $request->get('state');

            $phone= $request->get('phone');
            $email= $request->get('email');

            $zip= $request->get('zip');
            $fax= $request->get('fax');

            $website= $request->get('website');
            $notes= $request->get('notes');

            $about= $request->get('about');
            $logo= $request->get('logo');
            $company= $request->get('company');


            $em = $this->getDoctrine()->getManager();
            $bc = $em->getRepository("AppBundle:BusinessCard")->find($id);
            if ($bc==null){
                 return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'The id provided is not valid',
                        ), Response::HTTP_OK);
            }

            if (!isset($name) || !isset($lastname) || !isset($category) 
                || !isset($phone) || !isset($email)  || !isset($state) || !isset($city)){
                  return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'Some mandatory fields are empty',
                        ), Response::HTTP_OK);
             }
            

            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
                $bc->setName($name);
                $bc->setLastname($lastname); 
                $bc->setTitle($title);
                $bc->setCompany($company);
                
                $category =$em->getRepository("AppBundle:GroupCategory")->find($category);
               
                if ($category==null){
                     return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'The category is not valid',
                        ), Response::HTTP_OK);
                }
                $bc->setCategory($category);
                $logo;
                $picture;
                 
                if ($bc->getLogo()==null)
                    $logo = new Media();
                else
                    $logo = $bc->getLogo();
                    $logo->setURL($this->uploadPicture("logo",$this->getParameter('business_card_directory')));
                $logo->setFormat("picture");
                $bc->setLogo($logo);
                
                if ($bc->getLogo()==null)
                    $media = new Media();
                else
                    $media = $bc->getLogo();

                if ($bc->getPicture()==null)
                    $picture = new Media();
                else
                    $picture = $bc->getPicture();
                    $picture->setURL($this->uploadPicture("picture",$this->getParameter('business_card_directory')));
                    $picture->setFormat("picture");
                    $bc->setPicture($picture);
                $new_address = new Address();
                $new_address->setAddress($address);
                $new_address->setZip($zip);

                $state = $em->getRepository("AppBundle:State")->find($state);
                if ($state==null){
                     return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'The state is not valid',
                        ), Response::HTTP_OK);
                }

                $new_address->setState($state);
                $new_address->setCity($city);


                $bc->setAddress($new_address);
                $bc->setPhone($phone);
                $bc->setEmail($email);
                $bc->setFax($fax);
                $bc->setWebsite($website);
                $bc->setNotes($notes);
                $bc->setAbout($about);
                $bc->setFinished(true);

                $em->persist($bc);
                $em->flush();

               return new JsonResponse(array("message"=>'Business Card created',
                                               "id"=>$bc->getId(),
                                             )
                                        );


            }

            

            
            return new JsonResponse(array( "error"=>"You dont have permissions to change this user"
                                         )
                                   );
        }


             /**
         * Set and upload media for reps.
         *
         * @param ParamFetcher $paramFetcher
         * @param Request $request
          * @Route("/business-card/media/add")
          * @Rest\Post("/business-card/media/add")
         * @ApiDoc(
         *  section ="Business Card",
         *      resource = true,
         *      https = true,
         *      description = "Upload media.",
         *      statusCodes = {
         *          200 = "Returned when successful",
         *          400 = "Returned when errors"
         *      }
         * )
         *
        *@RequestParam(name="media", nullable=false, description="The media file")
        *@RequestParam(name="id", nullable=false, description="The business card id")
         *
         * @return View
         */
         
      public function addMediaToBusinessCardAction()

        {
            $request = $this->getRequest();
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
                if (count($_FILES)==0){
                     return new JsonResponse(array("error"=>'Error uploading the file'));
                }
                    $id= $request->get('id');
                     $em = $this->getDoctrine()->getManager();

                      $bc = $em->getRepository("AppBundle:BusinessCard")->find($id);
                            if ($bc==null){
                                 return new JsonResponse(array(
                                        'error' => '301',
                                        'message'=>'The id provided is not valid',
                                        ), Response::HTTP_OK);
                            }
                    
                    $media = new Media();
                    $media->setURL($this->uploadFile("media",$this->getParameter('media_directory')));
                    $format=$this->getFileType();
                     if ($format==false){
                        return new JsonResponse(array( "error"=>"This format is unsupported"));
                     }
                     $media->setFormat($format);

                     $type =$em->getRepository("AppBundle:EMedia")->find(EMedia::BCMedia);
                     $media->setMediaType($type);
                     $em->persist($media);

                     $mybcmedia = new BusinessCardMedia();
                     $mybcmedia->setMedia($media);
                     $em->persist($mybcmedia);
                     $bc->addBusinessCardMedia($mybcmedia);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($bc);
                    $em->flush();

                return new JsonResponse(array("msg"=>'Media added'));
            }
            return new JsonResponse(array("error"=>"You dont have permissions upload media"));
        }



             /**
         * Set and upload avatar for reps.
         *
         * @param ParamFetcher $paramFetcher
         * @param Request $request
          * @Route("/business-card/save")
          * @Rest\Post("/business-card/save")

         * @ApiDoc(
         *  section = "Business Card",
         *      resource = true,
         *      https = true,
         *      description = "Save business card.",

         * )
         *
        *@RequestParam(name="id", nullable=false, description="id for business card created")
        *@RequestParam(name="name", nullable=false, description="name")
        *@RequestParam(name="lastname", nullable=false, description="last name")
        *@RequestParam(name="title", nullable=false, description="title")
        *@RequestParam(name="category", nullable=false, description="Category")
        *@RequestParam(name="address", nullable=false, description="address")
        *@RequestParam(name="city", nullable=false, description="city")
        *@RequestParam(name="state", nullable=false, description="state id") 
        *@RequestParam(name="phone", nullable=false, description="phone")
        *@RequestParam(name="email", nullable=false, description="email")
        *@RequestParam(name="zip", nullable=false, description="zip")
        *@RequestParam(name="fax", nullable=true, description="fax")
        *@RequestParam(name="website", nullable=true, description="Website")
        *@RequestParam(name="notes", nullable=true, description="Notes")
        *@RequestParam(name="about", nullable=true, description="About")
        *@RequestParam(name="logo", nullable=false, description="Logo")
        *@RequestParam(name="picture", nullable=false, description="Picture")
        *@RequestParam(name="company", nullable=false, description="Company")
         *
         * @return View
         */
         
      public function saveBusinessCardAction()

        {
          
 
            $request = $this->getRequest();
            $id= $request->get('id');

            $name= $request->get('name');
            $lastname= $request->get('lastname');
            $title= $request->get('title');
            $category= $request->get('category');
            $address= $request->get('address');
            $city= $request->get('city');
            $state= $request->get('state');
            $phone= $request->get('phone');
            $email= $request->get('email');
            $zip= $request->get('zip');
            $fax= $request->get('fax');
            $website= $request->get('website');
            $notes= $request->get('notes');
            $about= $request->get('about');
            $logo= $request->get('logo');
            $company= $request->get('company');


            $em = $this->getDoctrine()->getManager();
            $bc = $em->getRepository("AppBundle:BusinessCard")->find($id);
            if ($bc==null){
                 return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'The id provided is not valid',
                        ), Response::HTTP_OK);
            }



            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
                if (isset($name))
                $bc->setName($name);
                if (isset($lastname))
                $bc->setLastname($lastname);
                if (isset($title)) 
                $bc->setTitle($title);
                if (isset($company))
                $bc->setCompany($company);
                
                if (isset($category)){
                $category =$em->getRepository("AppBundle:GroupCategory")->find($category);
               
                if ($category==null){
                     return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'The category is not valid',
                        ), Response::HTTP_OK);
                  }
                $bc->setCategory($category);
                }
                $logoM;
                $pictureM;
                 
            if (isset($logo)){
                if ($bc->getLogo()==null)
                    $logoM = new Media();
                else
                    $logoM = $bc->getLogo();
                    $logoM->setURL($this->uploadPicture("logo",$this->getParameter('business_card_directory')));
                $logoM->setFormat("picture");
                $em->persist($logoM);
                $bc->setLogo($logoM);
            }

            if (isset($picture)){
                if ($bc->getPicture()==null)
                    $pictureM = new Media();
                else
                    $pictureM = $bc->getPicture();
                    $pictureM->setURL($this->uploadPicture("picture",$this->getParameter('business_card_directory')));
                    $pictureM->setFormat("picture");
                    $em->persist($pictureM);
                    $bc->setPicture($pictureM);
            }
            if (isset($address))
                $bc->getAddress()->setAddress($address);
            if (isset($zip))
                $bc->getAddress()->setZip($zip);
            if (isset($state))
            {
                $state = $em->getRepository("AppBundle:State")->find($state);
                if ($state==null){
                     return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'The state is not valid',
                        ), Response::HTTP_OK);
                }
                $bc->getAddress()->setState($state);
            }
            if (isset($city))
                $bc->getAddress()->setCity($city);
            if (isset($phone))
                $bc->setPhone($phone);
            if (isset($email))
                $bc->setEmail($email);
            if (isset($fax))
                $bc->setFax($fax);
            if (isset($website))
                $bc->setWebsite($website);
            if (isset($notes))
                $bc->setNotes($notes);
            if (isset($about))
                $bc->setAbout($about);
                $bc->setFinished(true);
                $em->persist($bc);
                $em->flush();

               return new JsonResponse(array("message"=>'Business Card Saved',
                                               "id"=>$bc->getId()));
            }
            return new JsonResponse(array( "error"=>"You dont have permissions to change this Business Card"));
        }


 }
