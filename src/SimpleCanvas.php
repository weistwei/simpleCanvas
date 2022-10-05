<?php

namespace NickLabs\SimpleCanvas;

use Exception;

class SimpleCanvas {

    use SimpleCanvasCreate, SimpleCanvasInfo, SimpleCanvasDraw, SimpleCanvasFilter, SimpleCanvasOutput;

    /** @var $image resource|false */
    private $image;

    /** @var $font string */
    private $font;

    /**
     * @param int $width
     * @param int $height
     * @return $this
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-27
     */
    public function createCanvas(int $width, int $height): SimpleCanvas{
        $this->image = imagecreatetruecolor($width, $height);
        return $this;
    }

    /**
     * @param resource $image
     * @return $this
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-04
     */
    public function createCanvasFromImage($image): SimpleCanvas{
        $this->image = $image;
        return $this;
    }

    /**
     * @param string $fontPath
     * @return $this
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-27
     */
    public function setFont(string $fontPath): SimpleCanvas{
        if(is_readable($fontPath)){
            $this->font = $fontPath;
        }else{
            throw new Exception("Could not find/open font, Please make sure the font is present and readable.");
        }
        return $this;
    }

    /**
     * @param bool $enable
     * @return $this
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-04
     */
    public function setAntiAlias(bool $enable = true): SimpleCanvas{
        imageantialias($this->image, $$enable);
        return $this;
    }

    /**
     * @param string $color
     * @return $this
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-04
     */
    public function setBackground(string $color): SimpleCanvas{
        imagefill($this->image, 0, 0, $this->getCanvasColor($color));
        return $this;
    }

    /**
     * @param int $x
     * @param int $y
     * @return array
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-28
     */
    public function getPositionColor(int $x, int $y): array{
        $rgb = imagecolorat($this->image, $x, $y);

        return [
            'red' => ($rgb >> 16) & 0xff,
            'green' => ($rgb >> 8) & 0xff,
            'blue' => $rgb & 0xff,
            'hex' => '#' . dechex($rgb)
        ];
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param int $alpha
     * @return array
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-29
     */
    public function getClosestColor(int $red, int $green, int $blue, int $alpha = 0): array{
        $rgb = imagecolorclosestalpha($this->image, $red, $green, $blue, $alpha);

        $result = imagecolorsforindex($this->image, $rgb);

        return [
            'red' => $result['red'],
            'green' => $result['green'],
            'blue' => $result['blue'],
            'alpha' => $result['alpha'],
            'hex' => SimpleCanvasUtils::rgb2Hex($result['red'], $result['green'], $result['blue'], $result['alpha']),
        ];
    }

    /**
     * @param array $matrix
     * @param int $divisor
     * @param int $offset
     * @return $this
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-29
     */
    public function convolution(array $matrix, int $divisor, int $offset): SimpleCanvas{
        imageconvolution($this->image, $matrix, $divisor, $offset);
        return $this;
    }

    /**
     * @param int $width
     * @return $this
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function reSizeFromWidth(int $width): SimpleCanvas{
        $scale = $width / $this->getWidth();
        $imageWidth = $this->getWidth();
        $imageHeight = $this->getHeight();
        $newImageWidth = $imageWidth * $scale;
        $newImageHeight = $imageHeight * $scale;
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        imagecopyresized($newImage, $this->image, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $imageWidth, $imageHeight);
        $this->image = $newImage;
        return $this;
    }

    /**
     * @param int $width
     * @param int $height
     * @return $this
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function reSizeFromWidthAndHeight(int $width, int $height): SimpleCanvas{
        $newImage = imagecreatetruecolor($width, $height);
        $imageWidth = $this->getWidth();
        $imageHeight = $this->getHeight();
        imagecopyresized($newImage, $this->image, 0, 0, 0, 0, $width, $height, $imageWidth, $imageHeight);
        $this->image = $newImage;
        return $this;
    }

    /**
     * @param int $percent
     * @return $this
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function reSizeFromPercent(int $percent): SimpleCanvas{
        $percent = ($percent > 100) ? 1 : ($percent / 100);
        $imageWidth = $this->getWidth();
        $imageHeight = $this->getHeight();
        $newImageWidth = $imageWidth * $percent;
        $newImageHeight = $imageHeight * $percent;
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);

        imagecopyresized($newImage, $this->image, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $imageWidth, $imageHeight);
        $this->image = $newImage;
        return $this;
    }

    /**
     * @return $this
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function flipHorizontal(): SimpleCanvas{
        imageflip($this->image, IMG_FLIP_HORIZONTAL);
        return $this;
    }

    /**
     * @return $this
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function flipVertical(): SimpleCanvas{
        imageflip($this->image, IMG_FLIP_VERTICAL);
        return $this;
    }

    /**
     * @return $this
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function flipHorizontalAndVertical(): SimpleCanvas{
        imageflip($this->image, IMG_FLIP_BOTH);
        return $this;
    }

    /**
     * @param int $angle
     * @param string $backgroundColor
     * @param bool $ignoreTransparent
     * @return $this
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function rotate(int $angle, string $backgroundColor = '000000', bool $ignoreTransparent = false): SimpleCanvas{
        $canvasColor = $this->getCanvasColor($backgroundColor);
        $this->image = imagerotate($this->image, $angle, $canvasColor, $ignoreTransparent);
        return $this;
    }

    /**
     * @param int $startX
     * @param int $startY
     * @param int $endX
     * @param int $endY
     * @return $this
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function cropFromPosition(int $startX, int $startY, int $endX, int $endY): SimpleCanvas{
        $this->image = imagecrop($this->image, [
            'x' => $startX,
            'y' => $startY,
            'width' => $endX - $startX,
            'height' => $endY - $startY,
        ]);
        return $this;
    }

    /**
     * @param int $startX
     * @param int $startY
     * @param int $width
     * @param int $height
     * @return $this
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function cropFromWidthHeight(int $startX, int $startY, int $width, int $height): SimpleCanvas{
        $this->image = imagecrop($this->image, [
            'x' => $startX,
            'y' => $startY,
            'width' => $width,
            'height' => $height,
        ]);
        return $this;
    }

    /**
     * @param string $text
     * @param int $size
     * @param int $x
     * @param int $y
     * @param string $color
     * @param int $angle
     * @param bool $hasBorder
     * @param string $borderColor
     * @return $this
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-28
     */
    public function writeText(string $text, int $size, int $x, int $y, string $color, int $angle = 0, bool $hasBorder = false, string $borderColor = ''): SimpleCanvas{
        $canvasColor = $this->getCanvasColor($color);
        if($this->font){
            if($hasBorder){
                $canvasBorderColor = $this->getCanvasColor($borderColor);
                $rectangle = imagettfbbox($size, $angle, $this->font, $text);
                foreach($rectangle as $index => $position){
                    $rectangle[$index] = ($index % 2 == 0) ? $position + $x : $position + $y + $size;
                }
                $this->drawLine($rectangle[0], $rectangle[1], $rectangle[2], $rectangle[3], $canvasBorderColor);
                $this->drawLine($rectangle[2], $rectangle[3], $rectangle[4], $rectangle[5], $canvasBorderColor);
                $this->drawLine($rectangle[4], $rectangle[5], $rectangle[6], $rectangle[7], $canvasBorderColor);
                $this->drawLine($rectangle[6], $rectangle[7], $rectangle[0], $rectangle[1], $canvasBorderColor);
            }
            imagettftext($this->image, $size, $angle, $x, $y + $size, $canvasColor, $this->font, $text);
        }else{
            imagestring($this->image, $size, $x, $y, $text, $canvasColor);
        }
        return $this;
    }

    /**
     * @param string $color
     * @return false|int
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-28
     */
    private function getCanvasColor(string $color){
        $rgbArr = SimpleCanvasUtils::hex2Rgb($color);

        if(empty($rgbArr['alpha']) == false){
            return imagecolorallocatealpha($this->image, $rgbArr['red'], $rgbArr['green'], $rgbArr['blue'], $rgbArr['alpha']);
        }else{
            return imagecolorallocate($this->image, $rgbArr['red'], $rgbArr['green'], $rgbArr['blue']);
        }
    }


}