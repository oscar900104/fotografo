<?php

use frontend\tests\_pages\ContactPage;

$I = new TestGuy($scenario);
$I->wantTo('ensure that contact works');

$contactPage = ContactPage::openBy($I);

$I->see('Contact', 'h1');

$I->amGoingTo('submit contact form with no data');
$contactPage->submit([]);
$I->expectTo('see validations errors');
$I->see('Contact', 'h1');
$I->see('Name no puede estar vacio', '.help-block');
$I->see('Email no puede estar vacio', '.help-block');
$I->see('Subject no puede estar vacio', '.help-block');
$I->see('Body no puede estar vacio', '.help-block');
$I->see('The verification code is incorrect', '.help-block');

$I->amGoingTo('submit contact form with not correct email');
$contactPage->submit([
    'name'			=>	'tester',
    'email'			=>	'tester.email',
    'subject'		=>	'test subject',
    'body'			=>	'test content',
    'verifyCode'	=>	'testme',
]);
$I->expectTo('see that email adress is wrong');
$I->dontSee('Name no puede estar vacio', '.help-block');
$I->see('Email is not a valid email address.', '.help-block');
$I->dontSee('Subject no puede estar vacio', '.help-block');
$I->dontSee('Body no puede estar vacio', '.help-block');
$I->dontSee('The verification code is incorrect', '.help-block');

$I->amGoingTo('submit contact form with correct data');
$contactPage->submit([
    'name'			=>	'tester',
    'email'			=>	'tester@example.com',
    'subject'		=>	'test subject',
    'body'			=>	'test content',
    'verifyCode'	=>	'testme',
]);
$I->see('Thank you for contacting us. We will respond to you as soon as possible.');
