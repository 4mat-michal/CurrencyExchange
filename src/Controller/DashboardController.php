<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/app/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }

    /**
     * @Route("/api/dashboard", name="api_dashboard")
     */
    public function dashboard(): Response
    {
        $arrCurrency = [];
        $jsonCurrency =  json_decode(file_get_contents('https://api.nbp.pl/api/exchangerates/tables/A/'));
        foreach ($jsonCurrency[0]->rates as $currency){
            if($currency->code == 'USD' ||  $currency->code == 'EUR' || $currency->code == 'THB'){
                $arrCurrency[] = $currency;
            }
        }
        return new JsonResponse(['data' => $arrCurrency]);
    }

}
