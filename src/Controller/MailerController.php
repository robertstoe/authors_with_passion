<?php


namespace App\Controller;

use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class MailerController extends AbstractController
{
    /**
     * @Route("/email/edit/{receiver}", name="app_edit_email")
     */
    public function sendEmail(MailerInterface $mailer, Request $request, $receiver)
    {
        $response = new Response('success');

        $articleid = $request->get('articleid');



        $email = (new Email())
            ->from('admin@authors.com')
            ->to($receiver)
            ->subject('Your edit mail')
            ->text("Your edit link:\n\nlocalhost:8000/article/edit/" . $articleid);


        //dd($email);

        $mailer->send($email);

        return $response;
    }
}