<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class Taxi` extends Form
{
    public function buildForm()
    {
        $this
            ->add('callcode_id', 'text taxiNo')
            ->add('taxiChasisNo', 'text')
            ->add('taxiEngineNo', 'text')
            ->add('taxiBrand', 'text')
            ->add('taxiModel', 'text')
            ->add('taxiColor', 'text')
            ->add('taxiOwnerName', 'text')
            ->add('taxiOwnerEmail', 'text')
            ->add('taxiOwnerAddress', 'text')
            ->add('registeredDate', 'date')
            ->add('anualFeeExpiry', 'date')
            ->add('roadWorthinessExpiry', 'date')
            ->add('insuranceExpiry', 'date')
            ->add('rate', 'text')
            ->add('center_name', 'text');
    }
}
