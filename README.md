# Brick

Quickly generate HTML. Lighter than using one of PHP's internal DOM engines, but assumes you know HTML.

```php
Brick::div(
    Brick::h1('Favorite Sandwiches'),
    Brick::ul(Brick::li('Reuben'),
)
```
