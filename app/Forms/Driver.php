<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class Driver extends Form
{
    public function buildForm()
    {
        $this
            ->add('taxi_id', 'text')
            ->add('driverName', 'text')
            ->add('driverIdNo', 'text')
            ->add('driverTempAdd', 'text')
            ->add('driverPermAdd', 'text')
            ->add('driverName', 'text')
            ->add('driverEmail', 'text')
            ->add('driverLicenceNo', 'text')
            ->add('driverLicenceExp', 'text')
            ->add('driverPermitNo', 'text')
            ->add('driverPermitExp', 'date')
            ->add('submit', 'submit');
    }
}
