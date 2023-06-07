<?php

namespace App\Controller;

use App\Message\NotifyRecipients;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_')]
class IndexController extends AbstractController {

    #[Route('', name: 'index', methods: ['GET', 'POST'])]
    public function index(Request $request, MessageBusInterface $bus)
    : Response {

        if ($request->isMethod(Request::METHOD_POST)) {
            $content = $request->request->get('message');
            $recipients = $request->request->all('recipients');
            $bus->dispatch(new NotifyRecipients($content, $recipients));

            $this->addFlash('success', 'Emails sent successfully');
        }

        return $this->render('index/index.html.twig');
    }
}