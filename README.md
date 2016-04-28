invite code for Yii2
====================
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