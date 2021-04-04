<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     * @return Response
     */

    public function index(EntityManagerInterface $em): Response
    {
        $conn = $em->getConnection();
        dump($conn);
        $sql = '
            SELECT NOW()
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        dump($stmt->fetchAllAssociative());
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
