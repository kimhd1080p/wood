<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\imagine\Image;  
 use Imagine\Image\Box; 
 
class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
     public $imageFiles;

    public function rules()
    {
        return [
           [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg ,jpeg', 'maxFiles' => 4],
           
        ];
    }
    
     public function upload($t)
    {
         
        if ($this->validate()) {
       $i=0;
            foreach ($this->imageFiles as $file) {
              
                $file->saveAs('imgraw/' .$t.$i. '.' . $file->extension );
               
               $imagine = Image::getImagine();
$image = $imagine->open('imgraw/' .$t.$i.'.' . $file->extension);
$image->resize(new Box(500, 300))->save('img/' .$t.$i. '.' . $file->extension, ['quality' => 70]);
   unlink('imgraw/' .$t.$i.'.' . $file->extension);      
            $i++;
            }
            return true;
        } else {
            return false;
        }
    }
}