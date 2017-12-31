<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class Driver extends Form
{
    public function buildForm()
    {
        $this
            ->add('taxi_id', 'entity', [
                'class' => 'App\Taxi',
                'label' => 'Taxi',
            ])
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

            ->add('li_front_url', 'file')
            ->add('li_back_url', 'file')
            ->add('driver_photo_url', 'file')

            ->add('submit', 'submit', [
                'class' => 'btn btn-success btn-lg'
            ]);
    }
}
