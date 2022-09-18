<?php

namespace App\Controller\Admin;

use App\Entity\Source;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SourceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Source::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Sources');
    }

    protected function getListFields(): iterable
    {
        return [
            TextField::new('name')->setRequired(true),
            TextField::new('url')->setRequired(true),
            BooleanField::new('enabled'),
        ];
    }

    protected function getCreateFields(): iterable
    {
        return [
            TextField::new('name')->setRequired(true),
            TextField::new('url')->setRequired(true),
            BooleanField::new('enabled'),
        ];
    }

    protected function getEditFields(): iterable
    {
        return [
            TextField::new('name')->setDisabled(),
            TextField::new('url')->setDisabled(),
            BooleanField::new('enabled'),
            TextField::new('articleListSelector')->setRequired(true),
            TextField::new('articleSelector')->setRequired(true),
            TextField::new('titleSelector')->setRequired(true),
            TextField::new('descriptionSelector')->setRequired(true),
            TextField::new('linkSelector')->setRequired(true),
            TextField::new('imageSelector')->setRequired(true),
            TextField::new('cookieName'),
            TextField::new('cookieValue'),
        ];
    }
}
