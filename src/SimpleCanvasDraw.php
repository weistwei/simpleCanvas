<?php

namespace NickLabs\SimpleCanvas;

use Exception;

trait SimpleCanvasDraw {

    /**
     * @param int $centerX
     * @param int $centerY
     * @param int $width
     * @param int $height
     * @param int $startAngle
     * @param int $endAngle
     * @param string $color
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-28
     */
    public function drawArc(int $centerX, int $centerY, int $width, int $height, int $startAngle = 0, int $endAngle = 0, string $color = ''): SimpleCanvas{
        $canvasColor = $this->getCanvasColor($color);

        imagearc($this->image, $centerX, $centerY, $width, $height, $startAngle, $endAngle, $canvasColor);
        return $this;
    }

    /**
     * @param int $centerX
     * @param int $centerY
     * @param int $radius
     * @param string $color
     * @param bool $isFill
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-28
     */
    public function drawCircle(int $centerX, int $centerY, int $radius, string $color = '', bool $isFill = false): SimpleCanvas{
        $canvasColor = $this->getCanvasColor($color);

        $fillType = $isFill ? IMG_ARC_PIE : IMG_ARC_NOFILL;

        imagefilledarc($this->image, $centerX, $centerY, $radius, $radius, 0, 360, $canvasColor, $fillType);
        return $this;
    }

    /**
     * @param int $centerX
     * @param int $centerY
     * @param int $radius
     * @param string $color
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-28
     */
    public function drawCircleFill(int $centerX, int $centerY, int $radius, string $color = ''): SimpleCanvas{
        $this->drawCircle($centerX, $centerY, $radius, $color, true);
        return $this;
    }

    /**
     * @param int $leftTopX
     * @param int $leftTopY
     * @param int $rightBottomX
     * @param int $rightBottomY
     * @param string $color
     * @param bool $isFill
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-28
     */
    public function drawRectangle(int $leftTopX, int $leftTopY, int $rightBottomX, int $rightBottomY, string $color, bool $isFill = false): SimpleCanvas{
        $canvasColor = $this->getCanvasColor($color);
        $func = $isFill ? 'imagefilledrectangle' : 'imagerectangle';
        $func($this->image, $leftTopX, $leftTopY, $rightBottomX, $rightBottomY, $canvasColor);
        return $this;
    }

    /**
     * @param int $leftTopX
     * @param int $leftTopY
     * @param int $width
     * @param int $height
     * @param string $color
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-28
     */
    public function drawRectangleWithWidthAndHeight(int $leftTopX, int $leftTopY, int $width, int $height, string $color): SimpleCanvas{
        $endPointX = $leftTopX + $width;
        $endPointY = $leftTopY + $height;
        $this->drawRectangle($leftTopX, $leftTopY, $endPointX, $endPointY, $color);
        return $this;
    }


    /**
     * @param int $leftTopX
     * @param int $leftTopY
     * @param int $rightBottomX
     * @param int $rightBottomY
     * @param string $color
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-28
     */
    public function drawRectangleFill(int $leftTopX, int $leftTopY, int $rightBottomX, int $rightBottomY, string $color): SimpleCanvas{
        $this->drawRectangle($leftTopX, $leftTopY, $rightBottomX, $rightBottomY, $color, true);
        return $this;
    }


    /**
     * @param int $leftTopX
     * @param int $leftTopY
     * @param int $width
     * @param int $height
     * @param string $color
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-28
     */
    public function drawRectangleWithWidthAndHeightFill(int $leftTopX, int $leftTopY, int $width, int $height, string $color): SimpleCanvas{
        $endPointX = $leftTopX + $width;
        $endPointY = $leftTopY + $height;
        return $this->drawRectangle($leftTopX, $leftTopY, $endPointX, $endPointY, $color, true);
    }


    /**
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $height
     * @param string $color
     * @param bool $isFill
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function drawEllipse(int $x, int $y, int $width, int $height, string $color, bool $isFill = false): SimpleCanvas{
        $canvasColor = $this->getCanvasColor($color);
        $func = $isFill ? 'imagefilledellipse' : 'imageellipse';
        $func($this->image, $x, $y, $width, $height, $canvasColor);
        return $this;
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $height
     * @param string $color
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function drawEllipseFill(int $x, int $y, int $width, int $height, string $color): SimpleCanvas{
        return $this->drawEllipse($x, $y, $width, $height, $color, true);
    }

    /**
     * @param array $points
     * @param string $color
     * @param bool $isFill
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function drawPolygon(array $points, string $color, bool $isFill = false): SimpleCanvas{
        $canvasColor = $this->getCanvasColor($color);
        $func = $isFill ? 'imagefilledpolygon' : 'imagepolygon';
        $func($this->image, $points, (count($points) / 2), $canvasColor);
        return $this;
    }

    /**
     * @param array $points
     * @param string $color
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function drawPolygonFill(array $points, string $color): SimpleCanvas{
        return $this->drawPolygon($points, $color, true);
    }

    /**
     * @param int $x
     * @param int $y
     * @param string $color
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-06
     */
    public function drawPixel(int $x, int $y, string $color): SimpleCanvas{
        $canvasColor = $this->getCanvasColor($color);
        imagesetpixel($this->image, $x, $y, $canvasColor);
        return $this;
    }

    /**
     * @param int $startX
     * @param int $startY
     * @param int $endX
     * @param int $endY
     * @param string $color
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-29
     */
    public function drawLine(int $startX, int $startY, int $endX, int $endY, string $color): SimpleCanvas{
        $canvasColor = $this->getCanvasColor($color);
        $brush = imagecreatetruecolor(1, 1);
        imagefilledrectangle($brush, 0, 0, 1, 1, $canvasColor);
        imagesetbrush($this->image, $brush);
        imageline($this->image, $startX, $startY, $endX, $endY, IMG_COLOR_BRUSHED);
        return $this;
    }

    /**
     * @param string $url
     * @param int $x
     * @param int $y
     * @param int $alpha
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-04
     */
    public function drawImage(string $url, int $x, int $y, int $alpha = 100): SimpleCanvas{
        $image = static::createImageFromUrl($url);
        $width = SimpleCanvasUtils::getWidth($image);
        $height = SimpleCanvasUtils::getHeight($image);
        imagecopymerge($this->image, $image, $x, $y, 0, 0, $width, $height, $alpha);
        return $this;
    }

}