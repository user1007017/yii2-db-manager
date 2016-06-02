<?php
/**
 * Created by solly [02.06.16 9:46]
 */

namespace bs\dbManager\models;


use yii\base\Model;

/**
 * Class Dump
 *
 * @package bs\dbManager\models
 */
class Dump extends Model
{
	/**
	 * @var
	 */
	public $db;
	/**
	 * @var bool
	 */
	public $isArchive = true;
	/**
	 * @var bool
	 */
	public $schemaOnly = true;
	/**
	 * @var bool
	 */
	public $preset = false;
	/**
	 * @var array
	 */
	protected $dbList;
	/**
	 * @var array
	 */
	protected $customOptions;


	/**
	 * Dump constructor.
	 *
	 * @param array $dbList
	 * @param array $customOptions
	 * @param array $config
	 */
	public function __construct(array $dbList, array $customOptions = [], array $config = [])
	{
		$this->dbList = $dbList;
		$this->customOptions = $customOptions;
		parent::__construct($config);
	}

	/**
	 * @inheritdoc
	 **/
	public function rules()
	{
		return [
			['db', 'required'],
			['db', 'in', 'range' => $this->dbList],
			['isArchive', 'boolean'],
			['schemaOnly', 'boolean'],
			['preset', 'in', 'range' => $this->customOptions, 'skipOnEmpty' => true],
		];
	}

	/**
	 * @inheritdoc
	 **/
	public function attributeLabels()
	{
		return [
			'db'         => \Yii::t('dbManager', 'Database'),
			'isArchive'  => \Yii::t('dbManager', 'As archive'),
			'schemaOnly' => \Yii::t('dbManager', 'Dump only schema'),
			'preset'     => \Yii::t('dbManager', 'Custom dump preset'),
		];
	}

	/**
	 * @return array
	 **/
	public function hasPresets()
	{
		return !empty($this->customOptions);
	}

	public function getCustomOptions()
	{
		return $this->customOptions;
	}


}