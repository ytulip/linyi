<?php
/**
 * Author: yan
 * Date: 2016/7/5 - 14:16
 */
namespace Home\Controller;
use Think\Controller;
use Think\Image;

class ImageController extends Controller{
    public function thumbnail(){
//        echo 123;
        $imgPath = str_replace('/thumbnail','',$_SERVER['REQUEST_URI']);
        //判断是否已经生成缩略图
        if(!file_exists(STORAGE_PATH . '/thumbnail' . $imgPath)){
            //生成缩略图
            if(!file_exists(PUBLIC_PATH . '/output' . $imgPath)){
                //返回404
                header("HTTP/1.1 404 Not Found");
                header("Status: 404 Not Found");
                exit;
            }
            $image = new Image();
            $image->open(PUBLIC_PATH . '/output' . $imgPath);
            $width = $image->width(); // 返回图片的宽度
            $height = $image->height(); // 返回图片的高度
            /*先缩放，后裁剪*/

            $image->thumb(200, 200,Image::IMAGE_THUMB_CENTER)->save(STORAGE_PATH . '/thumbnail' . $imgPath);
        }
        //输出图片
        header('Content-type: image/jpg');
        echo file_get_contents(STORAGE_PATH . '/thumbnail' . $imgPath);
        exit;
        exit;
    }

}