<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\ArticleTelegramPublication;
use App\Entity\Source;
use App\Entity\SourceParsingError;
use App\Entity\TelegramChannel;
use App\Entity\TelegramPublicationError;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin_dashboard')]
    public function index(): Response
    {
        return $this->redirect(
            $this->adminUrlGenerator
                ->setController(SourceCrudController::class)
                ->generateUrl()
        );
//        return $this->render('@EasyAdmin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Soccer Hub')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Parsing');
        yield MenuItem::linkToCrud('Sources', '', Source::class);
        yield MenuItem::linkToCrud('Errors', '', SourceParsingError::class);
        yield MenuItem::linkToCrud('Articles', '', Article::class);

        yield MenuItem::section('Publications');
        yield MenuItem::linkToCrud('Article telegram publications', '', ArticleTelegramPublication::class);

        yield MenuItem::section('Telegram');
        yield MenuItem::linkToCrud('Channels', '', TelegramChannel::class);
        yield MenuItem::linkToCrud('Errors', '', TelegramPublicationError::class);
    }
}
