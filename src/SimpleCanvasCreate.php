<?php

namespace NickLabs\SimpleCanvas;

use Exception;

trait SimpleCanvasCreate {

    /**
     * @param int $width
     * @param int $height
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-27
     */
    public static function createFromWidthAndHeight(int $width, int $height): SimpleCanvas{
        $canvas = new SimpleCanvas();
        $canvas->createCanvas($width, $height);
        return $canvas;
    }

    /**
     * @param string $url
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-04
     */
    public static function createFromUrl(string $url): SimpleCanvas{
        $image = SimpleCanvas::createImageFromUrl($url);
        $canvas = new SimpleCanvas();
        $canvas->createCanvasFromImage($image);
        return $canvas;
    }

    /**
     * @param string $url
     * @return resource
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-04
     */
    public static function createImageFromUrl(string $url){
        $filePathInfo = pathinfo($url);
        if(empty($filePathInfo['extension'])){
            throw new Exception('file not find extension');
        }

        switch(strtolower($filePathInfo['extension'])){
            case 'avif':
                $image = imagecreatefromavif($url);
                break;
            case 'bmp':
                $image = imagecreatefrombmp($url);
                break;
            case 'gif':
                $image = imagecreatefromgif($url);
                break;
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($url);
                break;
            case 'png':
                $image = imagecreatefrompng($url);
                break;
            case 'tga':
                $image = imagecreatefromtga($url);
                break;
            case 'wbmp':
                $image = imagecreatefromwbmp($url);
                break;
            case 'xbm':
                $image = imagecreatefromxbm($url);
                break;
            case 'xpm':
                $image = imagecreatefromxpm($url);
                break;
            default:
                throw new Exception("image parse failed, supported file extensions are [avif,bmp,gif,jpg,jpeg,png,tga,wbmp,xbm,xpm]");
        }
        return $image;
    }

}