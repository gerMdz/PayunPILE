<?php


namespace App\Service\Report;


use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Handler\Metabase\HandlerMetabase;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class MailerReport
{

    private MailerInterface $mailer;
    private HandlerMetabase $handlerMetabase;
    private UserRepository $userRepository;

    public function __construct(MailerInterface $mailer, HandlerMetabase $handlerMetabase, UserRepository $userRepository)
    {
        $this->mailer = $mailer;
        $this->handlerMetabase = $handlerMetabase;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendReport(): TemplatedEmail
    {


        $email = (new TemplatedEmail())
            ->from(
                new Address(
                    $this->handlerMetabase->metadatos()->getEmailBase(),
                    $this->handlerMetabase->metadatos()->getSiteName()
                )
            )
            ->to(
                new Address(
                    $this->getMail($this->userRepository->getRolesAdmin()),
                    'ADMIN '.$this->handlerMetabase->metadatos()->getSiteName()
                )
            )
            ->subject('Reporte Asistencia')
            ->htmlTemplate('email/reportAsistencia.html.twig')
            ->context(
                [
                    // You can pass whatever data you want
                    //'user' => $user,
                ]
            );
        $this->mailer->send($email);
        return $email;
    }

    private function getMail($mailsUser): string
    {

        $mails = [];
        foreach ($mailsUser as $user) {
            /** @var User $user */
            array_push($mails, $user->getEmail());
        }

        return implode(",", $mails);
    }

}