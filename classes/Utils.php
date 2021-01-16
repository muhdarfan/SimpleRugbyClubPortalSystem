<?php
class Utils
{
    public static function GenerateRandomString($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public static function GetRandomImage($dir)
    {
        $images = glob($dir . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

        $randomImage = $images[array_rand($images)];
        return $randomImage;
    }
}
?>
