ABC Hosting coding challenge
Incase you want to run this on a linux server, follow the following instructions

1. Run `docker-compose up`
2. Import sql file (abc.sql) into the Database
3. Run `composer install`

ABC TASK DETAIL


So let's say there are 4 products in an online shop, an apple is 0.3$, a beer is 2$, water is 1$ each bottle and cheese is 3.74$ each kg. They have been stored in Mysql DB

Create a simple interface where:
- I can add/remove products to my virtual shopping cart in any quantities
- I can see my current cart status
- I have to choose a shipping option between 'pick up' (USD 0) and 'UPS' (USD 5). No option is chosen by default, so if I don't choose one and click on “Pay”, the interface asks me to select one. 
- After clicking on 'pay' (Originally my balance is USD 100 and after the purchase the remaining balance is stored) I want to see the previous balance, total purchase cost and my remaining balance after paying. 
- The shop should be in English only including code comments
- Please write this shop using PHP7.2 OOP
- Near each product there is a rating scale from 1 to 5, I can rate it and I can see current average rating of each product. Rating should only be allowed once per session or once per user and rates are stored using Mysql DB.
- Some CSS/html/JS so it looks a little better

General requirements
- DRY;
- Neat and consistent style;
- Understandable names;
- Clear logic flow (avoiding spaghetti code), short methods;
- Minimal reliance on global state: e.g. usage of superglobals. A separate place processing them should be dedicated.

OOP requirements
- Logic should be fully inside classes including ajax controller (except, maybe, Views);
- Separation of concerns: one class is responsible for a single thing;
- Minimum (or zero) amount of static methods;
- Encapsulation;
- Existence of entities / models like ShoppingCart;

Please DO NOT use anybody else’s work for this. EVERYTHING on this project should be written by you and it should be authentic work.
You can use external projects as reference for Jquery, Ajax and Bootstrap if needed. Using any PHP or JS framework is strictly forbidden, but you can use third-party libraries if you need them.
Please use Allman coding style, https://en.wikipedia.org/wiki/Indent_style#Allman_style
put it on our hosting https://www.hit.ng (registration is free) and give me the link.



All codes written by Ibukunoluwa Ajimoti