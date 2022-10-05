<?php

namespace NickLabs\SimpleCanvas;

use Exception;

trait SimpleCanvasFilter {

    /**
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterReversesAllColors(): SimpleCanvas{
        imagefilter($this->image, IMG_FILTER_NEGATE);
        return $this;
    }

    /**
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterGrayscale(): SimpleCanvas{
        imagefilter($this->image, IMG_FILTER_GRAYSCALE);
        return $this;
    }

    /**
     * @param int $arg
     * max brightness = 255
     * min brightness = -255
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterBrightness(int $arg): SimpleCanvas{
        $arg = ($arg > 255) ? 255 : $arg;
        $arg = ($arg < -255) ? -255 : $arg;
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, $arg);
        return $this;
    }

    /**
     * @param int $arg
     * max contrast = -100
     * min contrast = 100
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterContrast(int $arg): SimpleCanvas{
        $arg = ($arg > 100) ? 100 : $arg;
        $arg = ($arg < -100) ? -100 : $arg;
        imagefilter($this->image, IMG_FILTER_CONTRAST, $arg);
        return $this;
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param int $alpha
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterColorize(int $red, int $green, int $blue, int $alpha): SimpleCanvas{
        [
            $red,
            $green,
            $blue,
            $alpha,
        ] = array_map(function($arg){
            $arg = ($arg > 255) ? 255 : $arg;
            return ($arg < -255) ? -255 : $arg;
        }, func_get_args());
        imagefilter($this->image, IMG_FILTER_COLORIZE, $red, $green, $blue, $alpha);
        return $this;
    }

    /**
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterEdgeDetect(): SimpleCanvas{
        imagefilter($this->image, IMG_FILTER_EDGEDETECT);
        return $this;
    }

    /**
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterEmboss(): SimpleCanvas{
        imagefilter($this->image, IMG_FILTER_EMBOSS);
        return $this;
    }

    /**
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterGaussianBlur(): SimpleCanvas{
        imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR);
        return $this;
    }

    /**
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterSelectiveBlur(): SimpleCanvas{
        imagefilter($this->image, IMG_FILTER_SELECTIVE_BLUR);
        return $this;
    }

    /**
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterMeanRemoval(): SimpleCanvas{
        imagefilter($this->image, IMG_FILTER_MEAN_REMOVAL);
        return $this;
    }

    /**
     * @param int $arg
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterSmooth(int $arg): SimpleCanvas{
        imagefilter($this->image, IMG_FILTER_SMOOTH, $arg);
        return $this;
    }

    /**
     * @param int $pixels
     * @param bool $isAdvancedPixelationEffect
     * @return SimpleCanvas
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterPixelate(int $pixels, bool $isAdvancedPixelationEffect = false): SimpleCanvas{
        imagefilter($this->image, IMG_FILTER_PIXELATE, $pixels, $isAdvancedPixelationEffect);
        return $this;
    }

    /**
     * @param int $arg1
     * @param int $arg2
     * @param array $colors
     * @return SimpleCanvas
     * @throws Exception
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function filterScatter(int $arg1, int $arg2, array $colors): SimpleCanvas{
        $canvasColors = array_map(function($color){
            return $this->getCanvasColor($color);
        }, $colors);
        imagefilter($this->image, IMG_FILTER_SCATTER, $arg1, $arg2, $canvasColors);
        return $this;
    }

}