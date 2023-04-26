<?php


namespace App\Helpers;


class MessageHelper
{
    public static function Translate($short_message)
    {
        $lookup_table = [
            'system_error' => 'خطایی در سیستم بوجود آمده است. لطفا مجددا تلاش کنید',
            'unable_to_remove_data' => 'در حال حاضر سیستم قادر به حذف اطلاعات نمی باشد. لطفا مجددا تلاش کنید',
            'unable_to_save_data' => 'در حال حاضر سیستم قادر به ذخیره اطلاعات نمی باشد. لطفا مجددا تلاش کنید',
            'unable_to_update_data' => 'در حال حاضر سیستم قادر به بروزرسانی اطلاعات نمی باشد. لطفا مجددا تلاش کنید',
            'unauthenticated' => 'برای دسترسی به این قسمت ابتدا بایستی وارد سیستم شوید'
        ];

        return $lookup_table[$short_message] ?? 'نامشخص';
    }
}
