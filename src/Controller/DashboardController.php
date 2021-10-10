<?php

namespace App\Controller;

use App\Entity\Wallet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/app/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        $pln = 0;
        $wallet = $this->entityManager->getRepository(Wallet::class)->findBy(['user' => $this->getUser()]);
//        foreach ($wallet as $item) {
//            $pln += $item->getPlnAvailable();
//        }
//
        return $this->render('dashboard/index.html.twig', [
            'wallet' => $wallet,
            'pln' => $pln
        ]);
    }

    /**
     * @Route("/api/dashboard", name="api_dashboard")
     */
    public function dashboard(): Response
    {
        $arrCurrency = [];
        $jsonCurrency =  json_decode(file_get_contents('https://api.nbp.pl/api/exchangerates/tables/C/'));
        foreach ($jsonCurrency[0]->rates as $currency){
            if($currency->code == 'USD' ||  $currency->code == 'EUR' || $currency->code == 'CHF' || $currency->code == 'JPY' || $currency->code == 'CZK'){
                $arrCurrency[] = $currency;
            }
        }
        return new JsonResponse(['data' => $arrCurrency]);
    }

}
