invite code for Yii2
====================

[![Latest Stable Version](https://poser.pugx.org/yiier/yii2-invite-code/v/stable)](https://packagist.org/packages/yiier/yii2-invite-code) 
[![Total Downloads](https://poser.pugx.org/yiier/yii2-invite-code/downloads)](https://packagist.org/packages/yiier/yii2-invite-code) 
[![Latest Unstable Version](https://poser.pugx.org/yiier/yii2-invite-code/v/unstable)](https://packagist.org/packages/yiier/yii2-invite-code) 
[![License](https://poser.pugx.org/yiier/yii2-invite-code/license)](https://packagist.org/packages/yiier/yii2-invite-code)

invite code for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiier/yii2-invite-code "*"
```

or add

```
"yiier/yii2-invite-code": "*"
```

to the require section of your `composer.json` file.


Usage
-----

**mirage database**

```
$ php yii migrate --migrationPath=@yiier/inviteCode/migrations/
```


**change config**
 
change `console\config\main.php`

```php
'params' => $params,
...
'controllerMap' => [
    'gcode' => [
        'class' => 'yiier\inviteCode\GCodeController',
    ]
]
```

**console**

```
$ php yii gcode 200
```

or

```
$ php yii gcode
```

**change form view `signup.php`**

```php
// ...
<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'inviteCode')->textInput() ?>
// ...
```

**change `SignupForm.php`**

```php
// ...
public $inviteCode;


// ...
public function rules()
{
    return [
        // ...
        ['inviteCode', 'required'],
        ['inviteCode', 'yiier\inviteCode\CodeValidator'],
    ];
}

// ...
public function signup()
{
    // ...
    
    // return $user->save() ? $user : null;
    // after change
    if ($user->save()) {
        InviteCode::useCode($this->inviteCode, $user->id);
        return $user;
    }
    return null;
}
```
