<?php
/**
 * PasswdForm class.
 * PasswdForm is the data structure for changing user password. It is used by the 'admin' action of 'AccountController'.
 */
class PasswdForm extends CFormModel
{
	public $old_password;
	public $new_password;
	public $new_password_confirmation;
	private $_identity;


	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('old_password, new_password, new_password_confirmation', 'required'),
			array('new_password', 'compare', 'compareAttribute'=>'new_password_confirmation'),
			// password needs to be authenticated
			array('old_password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'old_password'=>'Enter your old password:',
			'new_password'=>'Enter in your password and confirm it.',
			'new_password_confirmation'=>'Password Confirmation',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity(Yii::app()->user->name,$this->old_password);
			if(!$this->_identity->authenticate())
				$this->addError('old_password','Incorrect password.');
		}
	}

}
