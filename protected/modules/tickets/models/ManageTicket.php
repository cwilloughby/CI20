<?php
/**
 * This model combines the TroubleTickets Model and the Comments model.
 * This is done so the ManageTicketWid Widget can have one text form field 
 * that can submit data for TroubleTickets or for Comments.
 */
class ManageTicket extends CModel
{	
	public $content;
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content', 'required'),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('content', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * @return array of attribute names
	 */
	public function attributeNames()
	{
		return array(
			'content' => 'content',
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'content' => 'Comment or Resolution',
		);
	}
}
