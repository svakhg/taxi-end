<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\CallCode;

class Taxi extends Form
{
    public function buildForm()
    {
        $this
            ->add('callcode_id', 'entity', [
                'class' => 'App\CallCode',
                'label' => 'Call Code',
                'property' => 'full_callcode',
                'query_builder' => function (CallCode $cc) {
                    return $cc->where('taken', 0);
                }
            ])
            ->add('taxiNo', 'text', [
                'label' => 'Taxi Number'
            ])
            ->add('taxiChasisNo', 'text', [
                'label' => 'Chasis No'
            ])
            ->add('taxiEngineNo', 'text', [
                'label' => 'Engine No'
            ])
            ->add('taxiBrand', 'text', [
                'label' => 'Brand'
            ])
            ->add('taxiModel', 'text', [
                'label' => 'Model'
            ])
            ->add('taxiColor', 'text', [
                'label' => 'Color'
            ])
            ->add('taxiOwnerName', 'text', [
                'label' => 'Owner Name'
            ])
            ->add('taxiOwnerEmail', 'text', [
                'label' => 'Email'
            ])
            ->add('taxiOwnerAddress', 'text', [
                'label' => 'Owner Address'
            ])
            ->add('registeredDate', 'date', [
                'label' => 'Registered Date'
            ])
            ->add('anualFeeExpiry', 'date', [
                'label' => 'Annual Fee Expiry'
            ])
            ->add('roadWorthinessExpiry', 'date', [
                'label' => 'Road Worthiness Expiry'
            ])
            ->add('insuranceExpiry', 'date', [
                'label' => 'Insurance Expiry'
            ])
            ->add('rate', 'text')

            ->add('taxi_front_url', 'file')
            ->add('taxi_back_url', 'file')
            
            ->add('submit', 'submit', [
                'class' => 'btn btn-success btn-lg'
            ]);
    }
}
