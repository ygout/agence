<?php
 namespace App\Controller\Admin;

 use App\Entity\Property;
 use App\Form\PropertyType;
 use App\Repository\PropertyRepository;
 use Doctrine\Common\Persistence\ObjectManager;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;

 class AdminPropertyController extends AbstractController
 {
     /**
      * @var PropertyRepository
      */
     private $propertyRepository;
     /**
      * @var ObjectManager
      */
     private $em;

     /**
      * AdminPropertyController constructor.
      * @param PropertyRepository $propertyRepository
      */
     public function __construct(PropertyRepository $propertyRepository, ObjectManager $em)
     {
        $this->propertyRepository = $propertyRepository;
         $this->em = $em;
     }

     /**
      * @Route("/admin", name="admin.property.index")
      * @return Response
      */
     public function index(): Response
     {
        $properties = $this->propertyRepository->findAll();
        return $this->render('admin/property/index.html.twig', compact('properties'));
     }

     /**
      * @Route("/admin/{id}", name="admin.property.edit")
      * @param Property $property
      * @return Response
      */
     public function edit(Property $property, Request $request): Response
     {
         $form = $this->createForm(PropertyType::class, $property);
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid())
         {
            $this->em->flush();
            return $this->redirectToRoute('admin.property.index');
         }
         return $this->render('admin/property/edit.html.twig', [
             'property' => $property,
             'form'     => $form->createView()
         ]);
     }
 }