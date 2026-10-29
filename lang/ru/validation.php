<?php

return [
    'required' => 'Поле «:attribute» обязательно для заполнения.',
    'email' => 'Поле «:attribute» должно быть корректным email-адресом.',
    'unique' => 'Такое значение поля «:attribute» уже занято.',
    'confirmed' => 'Поле «:attribute» не совпадает с подтверждением.',
    'regex' => 'Поле «:attribute» имеет неверный формат.',
    'date' => 'Поле «:attribute» должно быть корректной датой.',
    'after' => 'Поле «:attribute» должно быть позже текущего момента.',
    'integer' => 'Поле «:attribute» должно быть целым числом.',
    'exists' => 'Выбранное значение для «:attribute» не найдено.',
    'in' => 'Выбранное значение для «:attribute» неверно.',

    'min' => [
        'string' => 'Поле «:attribute» должно содержать минимум :min символов.',
        'numeric' => 'Поле «:attribute» должно быть не меньше :min.',
    ],
    'max' => [
        'string' => 'Поле «:attribute» должно содержать не больше :max символов.',
        'numeric' => 'Поле «:attribute» должно быть не больше :max.',
    ],

    'attributes' => [
        'name' => 'Имя',
        'email' => 'Email',
        'phone' => 'Телефон',
        'password' => 'Пароль',
        'password_confirmation' => 'Подтверждение пароля',
        'client_name' => 'Имя',
        'client_phone' => 'Телефон',
        'service_id' => 'Услуга',
        'doctor_id' => 'Врач',
        'appointment_time' => 'Дата и время приёма',
    ],
];