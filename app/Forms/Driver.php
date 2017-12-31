<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class Driver extends Form
{
    public function buildForm()
    {
        $this
            ->add('taxi_id', 'text')
            ->add('driverName', 'text', [
                'label' => 'Driver Name'
            ])
            ->add('driverIdNo', 'text', [
                'label' => 'Driver ID Number'
            ])
            ->add('driverTempAdd', 'text', [
                'label' => 'Driver Temporary Address'
            ])
            ->add('driverPermAdd', 'text', [
                'label' => 'Driver Permanant Address'
            ])
            ->add('driverMobile', 'text', [
                'label' => 'Driver Mobile'
            ])
            ->add('driverEmail', 'text', [
                'label' => 'Driver Email'
            ])
            ->add('driverLicenceNo', 'text', [
                'label' => 'Driver Licence No'
            ])
            ->add('driverLicenceExp', 'date', [
                'label' => 'Licence Expirary Date '
            ])
            ->add('driverPermitNo', 'text', [
                'label' => 'Driver Permit No '
            ])
            ->add('driverPermitExp', 'date', [
                'label' => 'Permit Expirary Date '
            ])
            ->add('submit', 'submit', [
                'class' => 'btn btn-success btn-lg'
            ]);
    }
}
