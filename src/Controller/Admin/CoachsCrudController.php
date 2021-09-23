<?php

namespace App\Controller\Admin;

use App\Entity\Coachs;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CoachsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coachs::class;
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
