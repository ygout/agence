<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $propertyRepository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $propertyRepository, ObjectManager $em)
    {
        $this->propertyRepository = $propertyRepository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        // Créer une entité qui va repr&senter notre recherche
//        Creer un formulaire
//        gerer le traiteemnt dans le controller
        $properties = $paginator->paginate(
            $this->propertyRepository->findAllVisibleQuery(),
            $request->query->getInt('page',1),
            12
        );

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties'    => $properties
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\9-]*"})
     * @param string $slug
     * @param string $id
     * @return Response
     */
    public function show(string $slug, string $id): Response
    {
        $property = $this->propertyRepository->find($id);

        if ($property->getSlug() !== $slug)
        {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'current_menu' => 'properties',
            'property'     => $property
        ]);
    }
}