<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/15 0015
 * Time: 11:59
 */

namespace common\models;

use Yii;
class UploadForm extends BaseModel
{
    public $file;
    public $type;
    const UPLOAD_TYPE_AVATAR = 'avatar';

    public function rules()
    {
        return [
            ['type', 'required'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']
        ];
    }

    public function upload($path) {
        if (!$this->validate()) {
            return false;
        }

        if (strpos($path, '/') !== 0) {
            $path = '/'.$path;
        }
        switch ($this->type) {
            case self::UPLOAD_TYPE_AVATAR:
                $staticImageRoot = Yii::getAlias("@staticImage");
                $absolutePath = $staticImageRoot.$path;
                if (!file_exists($absolutePath)) {
                    mkdir($absolutePath, 0777, true);
                }
                $relativeUrl = $path.'/'.microtime(true).'.'.$this->file->extension;
                if ($this->file->saveAs($staticImageRoot.$relativeUrl)) {
                    $this->file = $relativeUrl;
                }
                break;
        }

        return true;
    }

}