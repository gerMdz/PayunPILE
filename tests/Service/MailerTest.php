<?php

namespace App\Tests\Service;

use App\Entity\Reservante;
use App\Repository\InvitadoRepository;
use App\Repository\WaitingListRepository;
use App\Service\Handler\Metabase\HandlerMetabase;
use App\Service\Mailer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupInterface;
use Twig\Environment;

class MailerTest extends TestCase
{
    /**
     * @throws TransportExceptionInterface
     */
    public function testSendWelcomeMessage()
    {
        $symfonyMailer = $this->createMock(MailerInterface::class);
        $symfonyMailer->expects($this->once())
            ->method('send');
//        $pdf = $this->createMock(Pdf::class);
        $twig = $this->createMock(Environment::class);
        $entrypointLookup = $this->createMock(EntrypointLookupInterface::class);
        $waitingListRepository = $this->createMock(WaitingListRepository::class);
        $repository = $this->createMock(InvitadoRepository::class);
        $handlerMetabase = $this->createMock(HandlerMetabase::class);

        $reservante = new Reservante();

        $reservante->setEmail('uno@dos.com');
        $reservante->setNombre('uno');

        $mailer = new Mailer($symfonyMailer, $twig, $waitingListRepository, $repository,$handlerMetabase);
        $mailer->sendReservaMessageTest($reservante);
//        $this->assertTrue(true);
    }

    public function testIntegrationSendAuthorWeeklyReportMessage()
    {
        $symfonyMailer = $this->createMock(MailerInterface::class);
        $symfonyMailer->expects($this->once())
            ->method('send');
//        $pdf = $this->createMock(Pdf::class);
        $twig = $this->createMock(Environment::class);
        $entrypointLookup = $this->createMock(EntrypointLookupInterface::class);
        $waitingListRepository = $this->createMock(WaitingListRepository::class);
        $repository = $this->createMock(InvitadoRepository::class);
        $handlerMetabase = $this->createMock(HandlerMetabase::class);

        $reservante = new Reservante();

        $reservante->setEmail('uno@dos.com');
        $reservante->setNombre('uno');

        $mailer = new Mailer($symfonyMailer, $twig, $waitingListRepository, $repository,$handlerMetabase);
        $mailer->sendReservaMessageTest($reservante);
    }
}
