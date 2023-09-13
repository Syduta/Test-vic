<?php

namespace App\Controller\Admin;

use App\Entity\Drawing;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DrawingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Drawing::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
            ImageField::new('image')
                ->setUploadDir('/public/images/dessins/')
                ->setBasePath('/images/dessins/')
                ->onlyOnIndex(),
            TextField::new('medium'),
            DateField::new('year'),
            TextField::new('format'),
            NumberField::new('price'),
        ];
    }

}
