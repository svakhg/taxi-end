<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class Company extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text')
            ->add('GSTTin', 'text')
            ->add('RegNo', 'text')
            ->add('address', 'text')
            ->add('island', 'text')
            ->add('city', 'text')
            ->add('telephone', 'text')
            ->add('fax', 'text')
            ->add('mobile', 'text')
            ->add('email', 'text')
            ->add('website', 'text')
            ->add('ownername', 'text')
            ->add('owneremail', 'text')
            ->add('ownermobile', 'text');
    }
}
