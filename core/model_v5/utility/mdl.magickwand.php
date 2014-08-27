<?php
/**
 * mdl_magickwand
 *
 * @package
 * @version $Id: mdl.magickwand.php 1867 2008-04-23 04:00:24Z hujianxin $
 * @copyright 2003-2007 ShopEx
 * @author hujianxin <hjx@shopex.cn>
 * @license Commercial
 */

class mdl_magickwand{

    var $src_image_name = "";                          //����ͼƬ���ļ���(�������·����)
    var $jpeg_quality = 90;             //jpegͼƬ����
    var $save_file = '';                //����ļ�������δ������ֱ��������������
    var $wm_image_name = "";            //ˮӡͼƬ���ļ���(�������·����)
    var $magickwand_loaded = false;             //magickwand�Ƿ����
    var $wm_image_pos = 1;             //ˮӡͼƬ���õ�λ��
    // 0 = middle
    // 1 = top left
    // 2 = top right
    // 3 = bottom right
    // 4 = bottom left
    // 5 = top middle
    // 6 = middle right
    // 7 = bottom middle
    // 8 = middle left
    var $wm_image_transition = 80;            //ˮӡͼƬ��ԭͼƬ���ں϶� (1=100)
    var $emboss = false;
    var $wm_text = "";                        //ˮӡ����(֧����Ӣ���Լ�����\r\n�Ŀ�������)
    var $wm_text_size = 20;                   //ˮӡ���ִ�С
    var $wm_text_angle = 4;                   //ˮӡ���ֽǶ�,���ֵ������Ҫ����
    var $wm_text_font = "";                   //ˮӡ���ֵ�����
    var $wm_text_color = "#FF0000";           //ˮӡ�������ɫֵ
    var $wm_angle;

    /*******************
    *  ���캯��
    **********************/
    function mdl_magickwand()
    {
        if(function_exists("NewMagickWand")) $this->magickwand_loaded = true;

    }

    function fileCheck(){
        $font_dir = PUBLIC_DIR.'/fonts/';
        if(!is_file($this->wm_image_name)) $this->wm_image_name='';
        if(!is_file($font_dir.$this->wm_text_font)) $this->wm_text='';
        else $this->wm_text_font = $font_dir.$this->wm_text_font;
    }
    /************************************************
    /*
    makeThumb     ��������ͼ
    �ڲ�����

    $width ����ͼ��� $height ����ͼ�߶�

    ********************************************************/

    function makeThumb($objWidth=128, $objHeight=128)
    {
        $image_info = $this->getInfo($this->src_image_name);
        if (!$image_info) return false;

        $src_image_type = $image_info["type"];

        $res = $this->createThumb($objWidth,$objHeight);

        //*/
        $this->savefile($src_image_type,$res);

        ClearMagickWand($res);
        return true;
    }

    function makeThumbWatermark($objWidth=128,$objHeight=128)
    {
        $this->fileCheck();
        $image_info = $this->getInfo($this->src_image_name);
        if (!$image_info) return false;

        $src_image_type = $image_info["type"];

        $objWidth = ($objWidth==0)?$image_info["width"]:$objWidth;
        $objHeight = ($objHeight==0)?$image_info["height"]:$objHeight;
        $objWidth = ($objWidth > $image_info["width"]) ? $image_info["width"] : $objWidth;
        $objHeight = ($objHeight > $image_info["height"]) ? $image_info["height"] : $objHeight;

        $thumb = $this->createThumb($objWidth,$objHeight);
        $thumbwm = $this->createWaterMark($thumb);

        $this->savefile($src_image_type,$thumbwm);

        ClearMagickWand($thumbwm);
        return true;
    }


    /************************************************
    /*
    createWaterMark     ����һ��ˮӡͼ��MagickWand resource
    �ڲ�����

    ********************************************************/
    function createWaterMark($src_image=""){
        if(!IsMagickWand($src_image))
        {
            $src_image = NewMagickWand();
            MagickReadImage($src_image, $this->src_image_name);
        }

        if (!$src_image) return false;
        $src_image_w=MagickGetImageWidth($src_image);
        $src_image_h=MagickGetImageHeight($src_image);


        if ($this->wm_image_name){
               $wm_image_info = $this->getInfo($this->wm_image_name);
               if (!$wm_image_info) return false;
               $wm_image = NewMagickWand();
               MagickReadImage($wm_image, $this->wm_image_name);
               $wm_image_w=MagickGetImageWidth($wm_image);
               $wm_image_h=MagickGetImageHeight($wm_image);
               $temp_wm_image = $this->getPos($src_image_w,$src_image_h,$this->wm_image_pos,$wm_image);

               $wm_image_x = $temp_wm_image["dest_x"];
               $wm_image_y = $temp_wm_image["dest_y"];

                $opacity0 = MagickGetQuantumRange();

                $opacity100 = 0;

                $opacitypercent = $this->wm_image_transition;

                $opacity = $opacity0 - ($opacity0 * $opacitypercent/100 ) ;

                if ($opacity > $opacity0){
                $opacity = $opacity0;
                }elseif ($opacity <0){
                $opacity = 0;
                }

                MagickSetImageIndex($wm_image, 0);
                MagickSetImageType($wm_image, MW_TrueColorMatteType);
                MagickEvaluateImage($wm_image, MW_SubtractEvaluateOperator, $opacity, MW_OpacityChannel);
                MagickCompositeImage($src_image, $wm_image, MW_OverCompositeOp, $wm_image_x, $wm_image_y);
        }

        if ($this->wm_text){
               $this->wm_text = $this->wm_text;
               $temp_wm_text = $this->getPos($src_image_w,$src_image_h,$this->wm_image_pos);
               $wm_text_x = $temp_wm_text["dest_x"];
               $wm_text_y = $temp_wm_text["dest_y"];
               $drawing_wand=NewDrawingWand();
               if($this->wm_text_font != "")
               {
                   DrawSetFont($drawing_wand,$this->wm_text_font);
               }
               DrawSetFontSize($drawing_wand,$this->wm_text_size);
               switch($this->wm_image_pos)
               {
                    case 0:
                       DrawSetGravity($drawing_wand,MW_CenterGravity);
                       break;

                    case 1:
                      DrawSetGravity($drawing_wand,MW_NorthWestGravity);
                       break;

                    case 2:
                      DrawSetGravity($drawing_wand,MW_NorthEastGravity);
                      break;

                    case 3:
                      DrawSetGravity($drawing_wand,MW_SouthEastGravity);
                      break;

                    case 4:
                      DrawSetGravity($drawing_wand,MW_SouthWestGravity);
                      break;

                    case 5:
                     DrawSetGravity($drawing_wand,MW_NorthGravity);
                     break;

                    case 6:
                     DrawSetGravity($drawing_wand,MW_EastGravity);
                     break;

                    case 7:
                     DrawSetGravity($drawing_wand,MW_SouthGravity);
                     break;

                    case 8:
                     DrawSetGravity($drawing_wand,MW_WestGravity);
                     break;

                    default:
                      DrawSetGravity($drawing_wand,MW_CenterGravity);
                      break;
               }

               $pixel_wand=NewPixelWand();
              if(preg_match("/([a-f0-9][a-f0-9])([a-f0-9][a-f0-9])([a-f0-9][a-f0-9])/i", $this->wm_text_color, $color))
              {
                 $red = hexdec($color[1]);
                 $green = hexdec($color[2]);
                 $blue = hexdec($color[3]);
                 PixelSetColor($pixel_wand,"rgb($red,$green,$blue)");

              }else{
                 PixelSetColor($pixel_wand,"rgb(255,255,255)");
              }

              DrawSetFillColor($drawing_wand,$pixel_wand);
              MagickAnnotateImage($src_image,$drawing_wand,0,0,$this->wm_angle,$this->wm_text);
        }
        return $src_image;
    }

    /************************************************
    /*
    createThumb     ����һ������ͼ��MagickWand resource
    �ڲ�����

    $objWidth    ����ͼ�Ŀ�
    $objHeight    ����ͼ�ĸ�
    ********************************************************/
    function createThumb($objWidth,$objHeight,$nmw="")
    {
        $srcImage = $this->src_image_name;
        if(!IsMagickWand($nmw))
        {
            $nmw = NewMagickWand();
            MagickReadImage($nmw, $srcImage);
        }

        $srcImageWidth = MagickGetImageWidth($nmw);
        $srcImageHeight = MagickGetImageHeight($nmw);

        if($objWidth == 0 || $objHeight == 0){
            $objWidth = $srcImageWidth;
            $objHeight = $srcImageHeight;
        }

        if($objWidth < $objHeight)
        {
            $mu = $srcImageWidth / $objWidth;
            $objHeight = ceil($srcImageHeight / $mu);
        }
        else
        {
            $mu = $srcImageHeight / $objHeight;
            $objWidth = ceil($srcImageWidth / $mu);
        }
        MagickScaleImage($nmw, $objWidth, $objHeight);


        $ndw = NewDrawingWand();
        DrawComposite($ndw, MW_AddCompositeOp, 0, 0, $objWidth, $objHeight, $nmw);
        $res = NewMagickWand();
        MagickNewImage($res, $objWidth, $objHeight) ;
        MagickDrawImage($res, $ndw);
        MagickSetImageFormat($res, MagickGetImageFormat($nmw));

        return $res;
    }


    /************************************************
    /*
    savefile     �����ͼƬʵ���ֱ��ҳ�����
    �ڲ�����

    $src_image_type        ͼƬ������
    $src_image            ͼƬ��MagickWand resource
    ********************************************************/
    function savefile($src_image_type,$src_image)
    {
        if ($this->save_file)
        {
            MagickWriteImage($src_image, $this->save_file);
        }
        else
        {
          switch ($src_image_type){
           case 1:
                header("Content-type: image/gif");
                MagickEchoImageBlob($src_image);
              break;
           case 2:
                header("Content-type: image/jpeg");
                MagickEchoImageBlob($src_image);break;
           case 3:
                header("Content-type: image/png");
                MagickEchoImageBlob($src_image);break;
           case 6:
                header("Content-type: image/bmp");
                MagickEchoImageBlob($src_image);break;
           default:
                header("Content-type: image/jpeg");
                MagickEchoImageBlob($src_image);break;
          }
        }
    }


    /****************************************************************************************
    getPos               ����Դͼ��ĳ�����λ�ô��룬ˮӡͼƬid�����ɰ�ˮӡ���õ�Դͼ���е�λ��
    �ڲ�����

    $sourcefile_width:        Դͼ��Ŀ�
    $sourcefile_height: ԭͼ��ĸ�
    $pos:               λ�ô���
    // 0 = middle
    // 1 = top left
    // 2 = top right
    // 3 = bottom right
    // 4 = bottom left
    // 5 = top middle
    // 6 = middle right
    // 7 = bottom middle
    // 8 = middle left
    $wm_image:           ˮӡͼƬID
    *************************************************************************************/
    function getPos($sourcefile_width,$sourcefile_height,$pos,$wm_image=""){
             if  ($wm_image){
                  $insertfile_width = MagickGetImageWidth($wm_image);
                  $insertfile_height = MagickGetImageHeight($wm_image);
             }

             switch ($pos){
                    case 0:
                       $dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 );
                       $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
                       break;

                    case 1:
                       $dest_x = 0;
                       if ($this->wm_text){
                           $dest_y = $insertfile_height;
                       }else{
                           $dest_y = 0;
                       }
                       break;

                    case 2:
                      $dest_x = $sourcefile_width - $insertfile_width;
                      if ($this->wm_text){
                         $dest_y = $insertfile_height;
                      }else{
                          $dest_y = 0;
                      }
                      break;

                    case 3:
                      $dest_x = $sourcefile_width - $insertfile_width;
                      $dest_y = $sourcefile_height - $insertfile_height;
                      break;

                    case 4:
                      $dest_x = 0;
                      $dest_y = $sourcefile_height - $insertfile_height;
                      break;

                    case 5:
                     $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 );
                     if ($this->wm_text){
                        $dest_y = $insertfile_height;
                     }else{
                        $dest_y = 0;
                     }
                     break;

                    case 6:
                     $dest_x = $sourcefile_width - $insertfile_width;
                     $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
                     break;

                    case 7:
                     $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 );
                     $dest_y = $sourcefile_height - $insertfile_height;
                     break;

                    case 8:
                     $dest_x = 0;
                     $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
                     break;

                    default:
                      $dest_x = $sourcefile_width - $insertfile_width;
                      $dest_y = $sourcefile_height - $insertfile_height;
                      break;
             }
            return array("dest_x"=>$dest_x,"dest_y"=>$dest_y);
    }


    /*****************************
    * ����: getInfo($file)
    * ����ͼƬ��Ϣ����
    * ����: $file �ļ�·��
    ********************************/
    function getInfo($file)
    {
        if(!file_exists($file)) return false;
        $data = getimagesize($file);
        $imageInfo["width"] = $data[0];
        $imageInfo["height"]= $data[1];
        $imageInfo["type"] = $data[2];
        $imageInfo["name"] = basename($file);
        return $imageInfo;
    }


}
?>