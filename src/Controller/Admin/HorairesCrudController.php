<?php

namespace App\Controller\Admin;

use App\Entity\Horaires;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HorairesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaires::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('jour', 'Jours d\'ouvertures'),
            TextField::new('ouvertureMatin', 'Heures d\'ouverture du matin'),
            TextField::new('fermetureMatin', 'Heures de fermeture du matin'),
            TextField::new('ouvertureAprem', 'Heures d\'ouverture de l\'aprem'),
            TextField::new('fermetureAprem', 'Heures de fermeture de l\'aprem'),
        ];
    }
    
}
