<?php

// features/bootstrap/FeatureContext.php
use Tests\TestCase;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
//use PHPUnit_Framework_Assert as Assertions;
use PHPUnit\Framework\Assert as Assertions;

class FeatureContext extends TestCase implements SnippetAcceptingContext  
{
    private $shelf;
    private $basket;

    public function __construct()
    {
        $this->shelf = new Shelf();
        $this->basket = new Basket($this->shelf);
    }

    /**
     * @Given there is a :service, which costs $:price
     */
    public function thereIsAWhichCostsPs($service, $price)
    {
        $this->shelf->setProductPrice($service, floatval($price));
    }

    /**
     * @When I add the :service to the basket
     */
    public function iAddTheToTheBasket($service)
    {
        $this->basket->addProduct($service);
    }

    /**
     * @Then I should have :count service(s) in the basket
     */
    public function iShouldHaveProductInTheBasket($count)
    {
        $this->assertCount(
            intval($count),
            $this->basket
        );
    }

    /**
     * @Then the overall basket price should be $:price
     */
    public function theOverallBasketPriceShouldBePs($price)
    {
        $this->assertSame(
            floatval($price),
            $this->basket->getTotalPrice()
        );
    }
}
?>
