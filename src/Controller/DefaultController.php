<?php

namespace App\Controller;

use App\Service\InstagramService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     * @return Response
     */
    public function homepage(Request $request): Response
    {
        return $this->render('website/index.html.twig');
    }

    /**
     * @Route("get-link", methods={"POST"}, name="get_link")
     *
     * @param InstagramService $instagramService
     * @param Request $request
     * 
     * @return JsonResponse
     * @throws
     */
    public function getLink(Request $request, InstagramService $instagramService) :JsonResponse
    {
        $url = $request->request->get('url');

        $result = $instagramService->getBigImageByUrl($url);

        return $this->json(['result' => $result]);
    }

}
