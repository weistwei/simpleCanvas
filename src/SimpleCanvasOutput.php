<?php

namespace NickLabs\SimpleCanvas;

trait SimpleCanvasOutput {

    /**
     * @param string $filePath
     * @param int $quality
     * @param int $speed
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputAvif(string $filePath, int $quality = -1, int $speed = -1): string{
        $status = imageavif($this->image, $filePath, $quality, $speed);
        return $status ? $filePath : '';
    }

    /**
     * @param string $filePath
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputBmp(string $filePath): string{
        $status = imagebmp($this->image, $filePath);
        return $status ? $filePath : '';
    }

    /**
     * @param string $filePath
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputGif(string $filePath): string{
        $status = imagegif($this->image, $filePath);
        return $status ? $filePath : '';
    }

    /**
     * @param string $filePath
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-27
     */
    public function outputJpeg(string $filePath): string{
        $status = imagejpeg($this->image, $filePath);
        return $status ? $filePath : '';
    }

    /**
     * @param string $filePath
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-27
     */
    public function outputPng(string $filePath): string{
        $status = imagepng($this->image, $filePath);
        return $status ? $filePath : '';
    }

    /**
     * @param string $filePath
     * @param int|null $foregroundColor
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputWbmp(string $filePath, int $foregroundColor = null): string{
        $status = imagewbmp($this->image, $filePath, $foregroundColor);
        return $status ? $filePath : '';
    }

    /**
     * @param string $filePath
     * @param int|null $foregroundColor
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputXbm(string $filePath, int $foregroundColor = null): string{
        $status = imagexbm($this->image, $filePath, $foregroundColor);
        return $status ? $filePath : '';
    }

    /**
     * @param string $filePath
     * @param int $quality
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputWebp(string $filePath, int $quality = 80): string{
        $status = imagewebp($this->image, $filePath, $quality);
        return $status ? $filePath : '';
    }

    /**
     * @param string $filePath
     * @param int|null $chunkSize
     * @param int|null $mode
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputGd2(string $filePath, int $chunkSize = null, int $mode = null): string{
        $status = imagegd2($this->image, $filePath, $chunkSize, $mode);
        return $status ? $filePath : '';
    }

    /**
     * @param string $filePath
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputGd(string $filePath): string{
        $status = imagegd($this->image, $filePath);
        return $status ? $filePath : '';
    }


    /**
     * @param int $quality
     * @param int $speed
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputAvifBase64String(int $quality = -1, int $speed = -1): string{
        ob_start();
        imageavif($this->image, null, $quality, $speed);
        $imageContents = ob_get_contents();
        ob_end_clean();
        return base64_encode($imageContents);
    }

    /**
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputBmpBase64String(): string{
        ob_start();
        imagebmp($this->image);
        $imageContents = ob_get_contents();
        ob_end_clean();
        return base64_encode($imageContents);
    }

    /**
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputGifBase64String(): string{
        ob_start();
        imagegif($this->image);
        $imageContents = ob_get_contents();
        ob_end_clean();
        return base64_encode($imageContents);
    }

    /**
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-27
     */
    public function outputJpegBase64String(): string{
        ob_start();
        imagejpeg($this->image);
        $imageContents = ob_get_contents();
        ob_end_clean();
        return base64_encode($imageContents);
    }

    /**
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-09-27
     */
    public function outputPngBase64String(): string{
        ob_start();
        imagepng($this->image);
        $imageContents = ob_get_contents();
        ob_end_clean();
        return base64_encode($imageContents);
    }

    /**
     * @param int|null $foregroundColor
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputWbmpBase64String(int $foregroundColor = null): string{
        ob_start();
        imagewbmp($this->image, null, $foregroundColor);
        $imageContents = ob_get_contents();
        ob_end_clean();
        return base64_encode($imageContents);
    }

    /**
     * @param int|null $foregroundColor
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputXbmBase64String(int $foregroundColor = null): string{
        ob_start();
        imagexbm($this->image, null, $foregroundColor);
        $imageContents = ob_get_contents();
        ob_end_clean();
        return base64_encode($imageContents);
    }

    /**
     * @param int $quality
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputWebpBase64String(int $quality = 80): string{
        ob_start();
        imagewebp($this->image, null, $quality);
        $imageContents = ob_get_contents();
        ob_end_clean();
        return base64_encode($imageContents);
    }

    /**
     * @param int|null $chunkSize
     * @param int|null $mode
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputGd2Base64String(int $chunkSize = null, int $mode = null): string{
        ob_start();
        imagegd2($this->image, null, $chunkSize, $mode);
        $imageContents = ob_get_contents();
        ob_end_clean();
        return base64_encode($imageContents);
    }

    /**
     * @return string
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-05
     */
    public function outputGdBase64String(): string{
        ob_start();
        imagegd($this->image);
        $imageContents = ob_get_contents();
        ob_end_clean();
        return base64_encode($imageContents);
    }

}