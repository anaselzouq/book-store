<?php

return [

    'required' => 'حقل :attribute مطلوب.',
    'string' => 'حقل :attribute يجب أن يكون نصاً.',
    'max' => [
        'string' => 'حقل :attribute لا يجب أن يزيد عن :max حرفًا.',
    ],
    'min' => [
        'string' => 'حقل :attribute يجب أن يكون على الأقل :min حرفًا.',
    ],
    'email' => 'صيغة البريد الإلكتروني غير صحيحة.',
    'unique' => 'قيمة :attribute مستخدمة من قبل.',

    'confirmed' => 'تأكيد :attribute غير مطابق.',

    'custom' => [
        'name' => [
            'unique' => 'الاسم مستخدم من قبل، برجاء اختيار اسم آخر.',
        ],
        'email' => [
            'unique' => 'البريد الإلكتروني مستخدم بالفعل.',
        ],
    ],

    'attributes' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
    ],

];
