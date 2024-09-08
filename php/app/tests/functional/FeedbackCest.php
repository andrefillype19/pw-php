<?php

class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);

    }

    public function testErrorValidateEmailFeedbackForm(\FunctionalTester $I)
    {
        $I->amOnRoute('feedback/create');
        $I->submitForm('form', [
            'Feedback[nome]' => 'Andre Nascimento',
            'Feedback[email]' => 'andre.nascimento@alskdmlasnkdalsn.com',
            'Feedback[idade]' => '26',
            'Feedback[feedback]' => 'Esse teste não pode inserir no banco de dados.',
        ]);
        $I->see("\"E-mail\" não é um endereço de e-mail válido.");
        $I->expectTo('not found a record in the database.');
        $result=$I->grabRecord('\app\models\Feedback',[
            'nome' => 'Andre Nascimento',
            'email' => 'andre.nascimento@alskdmlasnkdalsn.com',
            'idade' => '26',
            'feedback' => 'Esse teste não pode inserir no banco de dados.',
        ]);
        $I->assertEquals($result,null);
    }

    public function sendFeedbackSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('feedback/create');
        $I->submitForm('form', [
            'Feedback[nome]' => 'Andre Nascimento',
            'Feedback[email]' => 'andre.nascimento@hotmail.com',
            'Feedback[idade]' => '26',
            'Feedback[feedback]' => 'Esse teste pode inserir no banco de dados.',
        ]);
        $I->expectTo('found a record in the database.');
        $result=$I->grabRecord('\app\models\Feedback',[
            'nome' => 'Andre Nascimento',
            'email' => 'andre.nascimento@hotmail.com',
            'idade' => '26',
            'feedback' => 'Esse teste pode inserir no banco de dados.',
        ]);
        $I->assertNotEquals($result,null);
    }
}