<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CallCode extends Form
{
    public function buildForm()
    {
        $this
            ->add('center_id', 'entity', [
                'class' => 'App\TaxiCenter',
                'label' => 'Taxi Center'
            ])
            ->add('callCode', 'text')
            ->add('submit', 'submit', [
                'class' => 'btn btn-success btn-lg'
            ]);
    }
}
