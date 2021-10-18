<?php

namespace kahanov\shortlinks\core\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $url Ссылка
 * @property string $short_code
 * @property integer $created_at
 * @property integer $updated_at
 *
 */
class ShortLinks extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'short_links';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class
        ];
    }
}
