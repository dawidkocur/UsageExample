<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\RequestBasicAuth;
use App\Service\RequestTokenAuth;

/**
 * @package App\Controller
 */
class ExampleUsageController extends AbstractController
{
    /**
     * @Route("/getOneBySearchTerm")
     */
    public function getOneBySearchTerm(RequestBasicAuth $requestBaseAuth, Request $request)
    {
        $term = urlencode($request->query->get('term'));
        $url = 'https://api.openbrewerydb.org/breweries/search?query='.$term;
        $user = 'Stefan Siara';
        $password = 'siara';
        $content = $requestBaseAuth->sendRequest($url, $data = '', "GET", $user, $password);

        return new JsonResponse($content);
    }

    /**
     * @Route("/getAll")
     */
    public function getAll(RequestTokenAuth $requestTokenAuth)
    {
        $url = 'https://api.openbrewerydb.org/breweries';
        $token = 'Authorization: Bearer 7a3f1559814087ae9ec6533f583d923dd6db3eee11e201d263478811e2ca865addefee9e43a4f9432389eeed588e386d859a8537a98f34d3db0c1efd';
       
        $content = $requestTokenAuth->sendRequest($url, $data = '', 'GET', $token);
        
        return new JsonResponse($content);
    }

    /**
     * @Route("/post")
     */
    public function newBrewery(RequestTokenAuth $requestTokenAuth)
    {
        $data = json_encode([
            'name' => 'Brewery Company',
            'city' => 'England'
        ]);

        $url = 'https://api.openbrewerydb.org/breweries/';
        $token = 'Authorization: Bearer 7a3f1559814087ae9ec6533f583d923dd6db3eee11e201d263478811e2ca865addefee9e43a4f9432389eeed588e386d859a8537a98f34d3db0c1efd';
        
        $content = $requestTokenAuth->sendRequest($url, $data, 'POST', $token);

        return new JsonResponse($content);
    }
}
