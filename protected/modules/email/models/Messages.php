<?php

/**
 * This is the model class for table "ci_messages".
 *
 * The followings are the available columns in table 'ci_messages':
 * @property integer $messageid
 * @property string $to
 * @property string $from
 * @property string $subject
 * @property string $messagebody
 * @property string $messagetype
 * @property string $datesent
 *
 * The followings are the available model relations:
 * @property Documents[] $ciDocuments
 */
class Messages extends CActiveRecord
{
	// This is the smtp host address.
	const HOST = "10.107.12.72";
	
	public $mail;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Messages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function init()
	{
		// Create a mailer object, tell it to use SMTP and set the host.
		$this->mail = new JPhpMailer();
		$this->mail->IsSMTP();
		$this->mail->Host = self::HOST;
		$this->mail->ContentType = "text/html";
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ci_messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('to, from, subject, messagetype', 'required'),
			array('to, from', 'length', 'max'=>500),
			array('messagebody', 'length', 'max'=>3000),
			array('subject', 'length', 'max'=>125),
			array('messagetype', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('messageid, to, from, subject, messagebody, messagetype, datesent', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Attaches the timestamp behavior to auto set the datesent value when a new email is sent.
	 */
	public function behaviors() 
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'datesent',
				'updateAttribute' => null,
			),
		);
	}
	/**
	 * Define the relations between this model and other models.
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Return an array of defined relationships.
		return array(
			'ciTroubleTickets' => array(self::MANY_MANY, 'TroubleTickets', 'ci_ticket_messages(messageid, ticketid)'),
		);
	}

	/**
	 * Determine the attribute labels that will be shown to the users.
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		// Return an array of attribute labels.
		return array(
			'messageid' => 'Message ID',
			'to' => 'To',
			'from' => 'From',
			'subject' => 'Subject',
			'messagebody' => 'Body',
			'messagetype' => 'Message Type',
			'datesent' => 'Date Sent',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('messageid',$this->messageid);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('messagebody',$this->messagebody,true);
		$criteria->compare('messagetype',$this->messagetype,true);
		$criteria->compare('datesent',$this->datesent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Set all the details of the email.
	 * @param string $toAddress the email address that the message will be sent to.
	 * @param string $fromAddress the email address that the message comes from.
	 * @param string $subject the email's subject.
	 * @param string $body the email's body.
	 * @param string $type the type of message.
	 * @param string $ccAddress an additional email address that the message will be sent to.
	 */
	public function setEmail($toAddress, $fromAddress, $subject, $body, $type, $ccAddress1 = null, $ccAddress2 = null)
	{
		// Set the message's destination address.
		$this->mail->AddAddress($toAddress);
		$this->to = $toAddress;
		
		// Set the message's sender address.
		$this->mail->SetFrom($fromAddress);
		$this->from = $fromAddress;
		
		// Set the cc address if one was provided.
		if(!is_null($ccAddress1))
			$this->mail->AddCC($ccAddress1);
		if(!is_null($ccAddress2))
			$this->mail->AddCC($ccAddress2);
				
		// Set the message's subject.
		$this->mail->Subject = $subject;
		$this->subject = $subject;
		
		$this->messagetype = $type;
		
		// Set the message's body.
		$this->mail->Body = $body;
		
		// The link to the recovery email page needs to be ommited from the log for security.
		if($type == "Recovery")
			$this->messagebody = "Follow this link to recover your password: Link omited for security";
		else
			$this->messagebody = $this->mail->Body;
	}
	
	/**
	 * Set all the details of the email.
	 * @param string $toAddress the email address that the message will be sent to.
	 * @param string $fromAddress the email address that the message comes from.
	 * @param string $subject the email's subject.
	 * @param string $body the email's body.
	 * @param string $type the type of message.
	 * @param string $ccAddress an additional email address that the message will be sent to.
	 */
	public function setEmailAlt($toAddress, $fromAddress, $subject, $body, $type, $dispName, $ccAddress1 = null, $ccAddress2 = null)
	{
		// Set the message's destination address.
		$this->mail->AddAddress($toAddress);
		$this->to = $toAddress;
		
		// Set the message's sender address.
		$this->mail->SetFrom($fromAddress);
		$this->mail->FromName = $dispName;
		$this->from = $fromAddress;
		
		// Set the cc address if one was provided.
		if(!is_null($ccAddress1))
			$this->mail->AddCC($ccAddress1);
		if(!is_null($ccAddress2))
			$this->mail->AddCC($ccAddress2);
				
		// Set the message's subject.
		$this->mail->Subject = $subject;
		$this->subject = $subject;
		
		$this->messagetype = $type;
		
		// Set the message's body.
		$this->mail->Body = $body;
		
		// The link to the recovery email page needs to be ommited from the log for security.
		if($type == "Recovery")
			$this->messagebody = "Follow this link to recover your password: Link omited for security";
		else
			$this->messagebody = $this->mail->Body;
	}
}
