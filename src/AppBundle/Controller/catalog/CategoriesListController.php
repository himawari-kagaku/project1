<?php

namespace AppBundle\Controller\catalog;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoriesListController
 * @package AppBundle\Controller\catalog
 * List of all categories. In form of categories tree
 */
class CategoriesListController extends Controller
{
    /**
     * @Route("/categories", name="categories")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('catalog/categoriesList.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}