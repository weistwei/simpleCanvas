<?php

namespace NickLabs\SimpleCanvas;

use Exception;

class SimpleCanvasUtils {

    /**
     * @param string $fileContent
     * @return array|false
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function getImageSizeFromString(string $fileContent){
        return getimagesizefromstring($fileContent);
    }

    /**
     * @param string $filePath
     * @return array|false
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function getImageSize(string $filePath){
        return getimagesize($filePath);
    }

    /**
     * @param resource $image
     * @return false|int
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-04
     */
    public static function getWidth($image){
        return imagesx($image);
    }

    /**
     * @param resource $image
     * @return false|int
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-04
     */
    public static function getHeight($image){
        return imagesy($image);
    }

    /**
     * @return string
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public static function randomHexColor(): string{
        $rgb = static::randomRgbColor();
        return static::rgb2Hex($rgb['red'], $rgb['green'], $rgb['blue']);
    }

    /**
     * @return array
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public static function randomRgbColor(): array{
        return [
            'red' => random_int(0, 255),
            'green' => random_int(0, 255),
            'blue' => random_int(0, 255)
        ];
    }

    /**
     * @param string $hexStr
     * @param bool $returnAsString
     * @param string $separator
     * @return array|string
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-28
     */
    public static function hex2Rgb(string $hexStr, bool $returnAsString = false, string $separator = ','){
        $rgbArray = [
            'hex' => preg_replace("/[^0-9A-Fa-f]/", '', $hexStr),
            'alpha' => 1,
        ];
        if(strlen($rgbArray['hex']) == 8){
            $alpha = base_convert(substr($rgbArray['hex'], 6, 2), 16, 10);
            $rgbArray['alpha'] = intval($alpha / 0xff * 100);
            $rgbArray['hex'] = substr($rgbArray['hex'], 0, 6);

        }
        if(strlen($rgbArray['hex']) == 6){
            $colorVal = hexdec($rgbArray['hex']);
            $rgbArray['red'] = ($colorVal >> 16) & 0xff;
            $rgbArray['green'] = ($colorVal >> 8) & 0xff;
            $rgbArray['blue'] = $colorVal & 0xff;
        }elseif(strlen($rgbArray['hex']) == 3){
            $rgbArray['red'] = hexdec(str_repeat($rgbArray['hex'][0], 2));
            $rgbArray['green'] = hexdec(str_repeat($rgbArray['hex'][1], 2));
            $rgbArray['blue'] = hexdec(str_repeat($rgbArray['hex'][2], 2));
        }else{
            throw new Exception("[$hexStr] Wrong color code.");
        }
        return $returnAsString ? implode($separator, [
            $rgbArray['red'],
            $rgbArray['green'],
            $rgbArray['blue'],
            $rgbArray['alpha'],
        ]) : $rgbArray;
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param float $alpha
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-29
     */
    public static function rgb2Hex(int $red, int $green, int $blue, float $alpha = 0): string{
        $hexAlpha = '';
        if($alpha > 0){
            $hexAlpha = ($alpha > 100) ? 100 : $alpha;
            $hexAlpha = dechex(0xff * ($hexAlpha / 100));
        }
        return implode('', array_map(function($code){
                return str_pad(dechex($code), 2, '0', STR_PAD_LEFT);
            }, [
                $red,
                $green,
                $blue,
            ])) . $hexAlpha;
    }
}