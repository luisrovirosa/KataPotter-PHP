# Objective
Resolve the [KataPotter](http://www.codingdojo.org/cgi-bin/index.pl?action=browse&id=KataPotter&revision=41) using TDD with Classicist style with Object Calisthenics and SOLID in mind.

# Solution
I have solved most of the cases including the two groups of four is better than one of five and another of three.

With this implementation is very simple to add/remove rules or strategies to group the books.


## Classes
**Basket**: Calculate the price of the Books using the Discounts.

**Book**: Holds the Book information.

**Discounts**:Generate the different ways to group the Books 
and calculate the best discount possible.

**Books**: Collection of books to get the collection related functions.

**BooksGroup**: A way to group the books to get the maximum number of discounts.

**GroupsGenerator**: Generate the different BooksGroup from at the Books to get the maximum number of discounts.

**discounts folder**: Business rules related to the discounts.

**groups**: Strategies to generate the different BooksGroup.

## Usage
1. Instalar [composer](https://getcomposer.org/) `curl -sS https://getcomposer.org/installer | php`
2. `php composer.phar install`
3. `./vendor/bin/phpunit`