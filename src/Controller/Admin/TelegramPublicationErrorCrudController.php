<?php

namespace App\Controller\Admin;

use App\Entity\TelegramPublicationError;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TelegramPublicationErrorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TelegramPublicationError::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Telegram publications errors');
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    protected function getListFields(): iterable
    {
        return [
            AssociationField::new('channel'),
            TextField::new('reason'),
            BooleanField::new('resolved'),
            Field::new('occurredAt'),
        ];
    }

    protected function getDetailFields(): iterable
    {
        return [
            AssociationField::new('channel'),
            TextField::new('reason'),
            BooleanField::new('resolved'),
            Field::new('occurredAt'),
        ];
    }
}
