<?php

return [
    'required'  => 'The :attribute field is required.',
    'string'    => 'The :attribute must be a string.',
    'email'     => 'The :attribute must be a valid email address.',
    'min'       => 'The :attribute must be at least :min characters.',
    'max'       => 'The :attribute may not be greater than :max characters.',
    'unique'    => 'The :attribute has already been taken.',
    'confirmed' => 'The :attribute confirmation does not match.',

    // Custom attributes
    'attributes' => [
        'name' => 'name',
        'email' => 'email address',
        'password' => 'password',
    ],
];
