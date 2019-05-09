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

        public function resize($file)
        {
            // maakt een aparte crop van je upload voor elk type
            $image_resized = imagescale(imagecreatefromjpeg($this->fileTempName), 300);
            imagejpeg($image_resized, $this->targetDir.'mini-'.$newName);
        }
    }
