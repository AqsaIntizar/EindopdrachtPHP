<?php
    require 'vendor/autoload.php';

    use League\ColorExtractor\ColorExtractor;
    use League\ColorExtractor\Palette;

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
                $image_resized = imagescale(imagecreatefromjpeg($tempFile), 500);
                imagejpeg($image_resized, $target.'mini-'.$newName);
            }
            if ($extension == 'png') {
                $image_resized = imagescale(imagecreatefrompng($tempFile), 500);
                // imagescale maakt png background zwart
                // $black = imagecolorallocate($image_resized, 0, 0, 0);
                // imagecolortransparent($image_resized, $black);
                imagepng($image_resized, $target.'mini-'.$newName);
            }
        }
        public static function extractColors($sourceImage){
            
            // $sourceImage = "images/posts/";
            // $sourceImage .= $r['post_img_dir'];
            $palette = Palette::fromFilename($sourceImage);

            $extractor = new ColorExtractor($palette);
            $colors = $extractor->extract(4);
            
            return $colors;
        }
    }
