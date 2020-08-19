<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/list", name="app_list")
     */
    public function index(): Response
    {
        $drivers = [
            'LEWIS HAMILTON' => 'Mercedes',
            'MAX VERSTAPPEN' => 'Red Bull Racing',
            'VALTTERI BOTTAS' => 'Mercedes',
            'CHARLES LECLERC' => 'Ferrari',
            'LANDO NORRIS' => 'McLaren',
            'ALEXANDER ALBON' => 'Red Bull Racing',
            'LANCE STROLL' => 'Racing Point',
            'SERGIO PEREZ' => 'Racing Point',
            'DANIEL RICCIARDO' => 'Renault',
            'ESTEBAN OCON' => 'Renault',
            'CARLOS SAINZ' => 'McLaren',
            'PIERRE GASLY' => 'AlphaTauri',
            'SEBASTIAN VETTEL' => 'Ferrari',
            'NICO HULKENBERG' => 'Racing Point',
            'ANTONIO GIOVINAZZI' => 'Alfa Romeo Racing',
            'DANIIL KVYAT' => 'AlphaTauri',
            'KEVIN MAGNUSSEN' => 'Haas F1 Team',
            'KIMI RÄIKKÖNEN' => 'Alfa Romeo Racing',
            'NICHOLAS LATIFI' => 'Williams',
            'GEORGE RUSSELL' => 'Williams',
            'ROMAIN GROSJEAN' => 'Haas F1 Team',
        ];

        return $this->render('list/index.html.twig', [
            'drivers' => $drivers,
        ]);
    }
}
