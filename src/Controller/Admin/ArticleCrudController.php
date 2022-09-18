<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Articles');
    }

    protected function getListFields(): iterable
    {
        return [
            TextField::new('title'),
            Field::new('parsedAt'),
        ];
    }

    protected function getEditFields(): iterable
    {
        return [
            AssociationField::new('source')->setDisabled(),
            TextField::new('url')->setDisabled(),
            TextField::new('title'),
            TextareaField::new('description'),
            TextField::new('imageUrl'),
            Field::new('parsedAt')->setDisabled(),
        ];
    }
}
