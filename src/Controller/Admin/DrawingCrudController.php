<?php

namespace App\Controller\Admin;

use App\Entity\Drawing;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DrawingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Drawing::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
