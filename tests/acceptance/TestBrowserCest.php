<?php

use formbuilder\tests\TestGuy;
use Facebook\WebDriver\WebDriverKeys;

class TestBrowserCest
{
    public function seeTestField(TestGuy $I)
    {
        $I->amOnPage('?r=test/index');
        $I->see('Test Field');
    }

    public function seeRequiredField(TestGuy $I)
    {
        $I->amOnPage('?r=test/required');
        $I->see('Test Field');

        $I->fillField('#requiredmodel-testfield', 'test');

        $I->dontSee('Test Field cannot be blank.');
    }

    public function seeErrorOnEmptyRequiredField(TestGuy $I)
    {
        $I->amOnPage('?r=test/required');
        $I->see('Test Field');
        
        $I->fillField('#requiredmodel-testfield', 'test');
        $I->clearField('#requiredmodel-testfield');
        $I->pressKey('#requiredmodel-testfield', WebDriverKeys::TAB);
        $I->wait(1);
        $I->see('Test Field cannot be blank.');
    }
    
    public function seePreExistingData(TestGuy $I)
    {
        $I->amOnPage('?r=test/with-data');
        $I->see('Test Field');
        $I->seeInField('#preexistingvaluemodel-testfield', 'test');
    }

    public function seeDropDown(TestGuy $I)
    {
        $I->amOnPage('?r=test/drop-down');
        $I->see('Test Field');
        $I->selectOption('#dropdownmodel-testfield', 'Test value 2');

        $I->seeInField('#dropdownmodel-testfield', '2');
    }
}