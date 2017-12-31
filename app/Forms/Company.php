<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class Company extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text')
            ->add('GSTTin', 'text', [
                'label' => 'GST Tin'
            ])
            ->add('RegNo', 'text', [
                'label' => 'Registration Number'
            ])
            ->add('address', 'text')
            ->add('island', 'text')
            ->add('city', 'text')
            ->add('telephone', 'text')
            ->add('fax', 'text')
            ->add('mobile', 'text')
            ->add('email', 'text')
            ->add('website', 'text')
            ->add('ownername', 'text', [
                'label' => 'Owner Name'
            ])
            ->add('owneremail', 'text', [
                'label' => 'Owner Email'
            ])
            ->add('ownermobile', 'text', [
                'label' => 'Owner Mobile'
            ])
            ->add('submit', 'submit', [
                'class' => 'btn btn-success btn-lg'
            ]);
    }
}
