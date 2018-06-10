<?php
namespace app\common;

use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;
use yii\db\ActiveRecord;

class AppModel extends ActiveRecord
{
    public $uuid;

    public function __construct(array $config = [])
    {
        $this->uuid = $this->generateUuid();
        parent::__construct($config);
    }

    protected function generateUuid()
    {
        try {
            $uuid4 = Uuid::uuid4();
            return $uuid4->toString() . "\n"; // i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a
        } catch (UnsatisfiedDependencyException $e) {
            return 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->getAttribute('id') === null) {
            $this->setAttribute('id', $this->uuid);
        }
        return parent::save($runValidation, $attributeNames);
    }

    public function beforeSave($insert)
    {
        return parent::beforeSave($insert);
    }
}