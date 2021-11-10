<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Le :attribute doit être accepté. ',
    'active_url'           => 'Le :attribute is not a valid URL.',
    'after'                => 'Le :attribute must be a date after :date.',
    'after_or_equal'       => 'Le :attribute must be a date after or equal to :date.',
    'alpha'                => 'Le :attribute may only contain letters.',
    'alpha_dash'           => 'Le :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'Le :attribute may only contain letters and numbers.',
    'array'                => 'Le :attribute must be an array.',
    'before'               => 'Le :attribute must be a date before :date.',
    'before_or_equal'      => 'Le :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'Le :attribute must be between :min and :max.',
        'file'    => 'Le :attribute must be between :min and :max kilobytes.',
        'string'  => 'Le :attribute must be between :min and :max characters.',
        'array'   => 'Le :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'Le :attribute field must be true or false.',
    'confirmed'            => 'Le :attribute ne correspond pas. ',
    'date'                 => 'Le :attribute is not a valid date.',
    'date_format'          => 'Le :attribute does not match the format :format.',
    'different'            => 'Le :attribute and :other must be different.',
    'digits'               => 'Le :attribute must be :digits digits.',
    'digits_between'       => 'Le :attribute must be between :min and :max digits.',
    'dimensions'           => 'Le :attribute has invalid image dimensions.',
    'distinct'             => 'Le :attribute field has a duplicate value.',
    'email'                => 'Le :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'Le :attribute must be a file.',
    'filled'               => 'Le :attribute field must have a value.',
    'image'                => 'Le :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'Le :attribute field does not exist in :other.',
    'integer'              => 'Le :attribute must be an integer.',
    'ip'                   => 'Le :attribute must be a valid IP address.',
    'ipv4'                 => 'Le :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'Le :attribute must be a valid IPv6 address.',
    'json'                 => 'Le :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Le :attribute may not be greater than :max.',
        'file'    => 'Le :attribute may not be greater than :max kilobytes.',
        'string'  => 'Le :attribute may not be greater than :max characters.',
        'array'   => 'Le :attribute may not have more than :max items.',
    ],
    'mimes'                => 'Le :attribute must be a file of type: :values.',
    'mimetypes'            => 'Le :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'Le :attribute must be at least :min.',
        'file'    => 'Le :attribute must be at least :min kilobytes.',
        'string'  => 'Le :attribute must be at least :min characters.',
        'array'   => 'Le :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'Le :attribute must be a number.',
    'present'              => 'Le :attribute field must be present.',
    'regex'                => 'Le :attribute format is invalid.',
    'required'             => 'Le champ :attribute est requis.',
    'required_if'          => 'Le :attribute field is required when :other is :value.',
    'required_unless'      => 'Le :attribute field is required unless :other is in :values.',
    'required_with'        => 'Le :attribute field is required when :values is present.',
    'required_with_all'    => 'Le :attribute field is required when :values is present.',
    'required_without'     => 'Le :attribute field is required when :values is not present.',
    'required_without_all' => 'Le :attribute field is required when none of :values are present.',
    'same'                 => 'Le :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'Le :attribute must be :size.',
        'file'    => 'Le :attribute must be :size kilobytes.',
        'string'  => 'Le :attribute must be :size characters.',
        'array'   => 'Le :attribute must contain :size items.',
    ],
    'string'               => 'Le :attribute must be a string.',
    'timezone'             => 'Le :attribute must be a valid zone.',
    'unique'               => 'Le :attribute a déjà été pris. ',
    'uploaded'             => 'Le :attribute n\'a pas pu être téléchargé. ',
    'url'                  => 'Le :attribute le format n\'est pas valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];