<?php

namespace NickLabs\SimpleCanvas;

trait SimpleCanvasInfo {

    /**
     * @return false|int
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-04
     */
    public function getWidth(){
        return imagesx($this->image);
    }

    /**
     * @return false|int
     * @author Nick <weist.wei@gmail.com>
     * @date 2022-10-04
     */
    public function getHeight(){
        return imagesy($this->image);
    }
}