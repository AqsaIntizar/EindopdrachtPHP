<?php
    class Image
    {
        public static function checkExt($file)
        {
            // Checkt de extensie van je upload
            $arr = explode('.', $file);
            $extension = end($arr);

            return $extension;
        }

        public static function rename($userId, $extension)
        {
            //Hernoemt je upload
            $fileName = $userId.'_'.time().'.'.$extension;

            return $fileName;
        }

        public static function resize($tempFile, $extension, $newName, $target)
        {
            // maakt een aparte crop van je upload voor elk type
            if ($extension == 'jpg' | 'jpeg') {
                $image_resized = imagescale(imagecreatefromjpeg($tempFile), 300);
                imagejpeg($image_resized, $target.'mini-'.$newName);
            }
            if ($extension == 'png') {
                $image_resized = imagescale(imagecreatefrompng($tempFile), 300);
                // imagescale maakt png background zwart
                $black = imagecolorallocate($im, 0, 0, 0);
                imagecolortransparent($image_resized, $black);
                imagepng($image_resized, $target.'mini-'.$newName);
            }
        }
    }
