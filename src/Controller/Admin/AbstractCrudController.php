<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController as EAAbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;

abstract class AbstractCrudController extends EAAbstractCrudController
{
    public function __construct(
        protected AdminUrlGenerator $adminUrlGenerator,
    )
    {
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInSingular(fn(?object $entity) => $entity ? (string)$entity : "");
    }

    public function configureFields(string $pageName): iterable
    {
        return match ($pageName) {
            Crud::PAGE_INDEX => $this->getListFields(),
            Crud::PAGE_NEW => $this->getCreateFields(),
            Crud::PAGE_EDIT => $this->getEditFields(),
            Crud::PAGE_DETAIL => $this->getDetailFields(),
        };
    }

    protected function getListFields(): iterable
    {
        return [];
    }

    protected function getCreateFields(): iterable
    {
        return [];
    }

    protected function getEditFields(): iterable
    {
        return [];
    }

    protected function getDetailFields(): iterable
    {
        return [];
    }

    protected function getRedirectResponseAfterSave(AdminContext $context, string $action): RedirectResponse
    {
        return $this->redirect($this->adminUrlGenerator
            ->setAction($this->getRedirectAfterSavePage())
            ->setEntityId($context->getEntity()->getPrimaryKeyValue())
            ->generateUrl()
        );
    }

    protected function getRedirectAfterSavePage(): string
    {
        return Crud::PAGE_EDIT;
    }
}
