<?php

namespace App\Controller\Admin;

use App\Entity\TelegramChannel;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TelegramChannelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TelegramChannel::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Telegram channels');
    }

    protected function getListFields(): iterable
    {
        return [
            TextField::new('name'),
        ];
    }

    protected function getCreateFields(): iterable
    {
        return [
            TextField::new('name')->setRequired(true),
            TextField::new('telegramId')->setRequired(true),
            TextField::new('apiToken')->setRequired(true),
        ];
    }

    protected function getEditFields(): iterable
    {
        return [
            TextField::new('name')->setRequired(true),
            TextField::new('telegramId')->setRequired(true),
            TextField::new('apiToken')->setRequired(true),
        ];
    }
}
