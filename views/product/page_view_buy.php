<?php

    if( SessionBasketForm::existBasketValues() )
    {
        $current = BasketSessionSingleton::getBasket();

        $entry = new BasketEntry( PostBasketBuy::getPostIdentity(), PostBasketBuy::getPostNumberOfProducts(), PostBasketBuy::getPostPrice() );
        $current->insert($entry);
        $current->save();
    }
    else
    {
        echo "no values </br>";
        $basket = new BasketSession();
        $basket_entry = new BasketEntry(PostBasketBuy::getPostIdentity(), PostBasketBuy::getPostNumberOfProducts(), PostBasketBuy::getPostPrice() );
        $basket->insert($basket_entry);
        $basket->save();
    }

?>