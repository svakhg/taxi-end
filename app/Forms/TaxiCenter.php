<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class TaxiCenter extends Form
{
    public function buildForm()
    {
        $this
            ->add('company_id', 'text')
            ->add('name', 'text')
            ->add('cCode', 'text', [
                'label' => 'Call Code'
            ])
            ->add('address', 'text')
            ->add('telephone', 'text')
            ->add('mobile', 'text')
            ->add('fax', 'text')
            ->add('submit', 'submit', [
                'class' => 'btn btn-success btn-lg'
            ]);
    }
}
