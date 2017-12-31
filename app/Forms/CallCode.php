<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CallCode extends Form
{
    public function buildForm()
    {
        $this
            ->add('center_id', 'text')
            ->add('callCode', 'text')
            ->add('submit', 'submit');
    }
}
