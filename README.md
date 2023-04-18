
## Author
- Emmanuel Onwukwe[https://github.com/emmanuelonwukwe] [emmanuelonwukwe202@gmail.com] [+2349060044077]

## About project
-   THis is a simple (basic) laravel web application for e-commerce data Create, Retrieve Update and Destroy operations.
-   The frontend is made with php and laravel blade template engine while 
-   The backend is made with php laravel

### Testing on localhost
- Clone the repo and navigate to the project root on you bash/shell
- Create a database and name it `fenex`
- Run artisan command to start you server
```sh
php artisan serve
```

- Run php artisan command to migrate all tables
```sh
php artisan migrate
```

- Run this command to remove the storage folder and recreate the symbolic link of the storage folder to allow images to show when an admin uploads the image of a product. Else the image src will be invalid after creating a product

```sh
rm -r public/storage
```
Then

```sh
php artisan storage:link
```
- Go ahead to register your admin account 
- Create categories of products on you admin end
- create products on your admin end 
- Register users and test the functionalities

## Features
- There are users and admins panels respectively 
- guest who are not authenticated can see all the products on the homepage
- users can register on the registeration page by clicking on `register` button
- users can login by clicking on the `login` button
- authenticated(i.e logged in) users can add products to their shopping cart 
- users can add multiple products of same or different products to their cart
- users can see the number of every of the products added to cart
- users can see the total items on the cart at the top of their homepage
- users when click on the shopping cart at the top of the page, will be redirected to see all his added products to
  the cart.
- users can delete the product in the cart if he desires by clicking on the delete/remove button

- admin can register by clicking on `register` then at the bottom of the page, click on `Admin Registration`
- admin can login by clicking on the `login` button
- admin homepage displays all the users and admin on a tabular form with their individual details
- admin can create new category for products after logged in by cliccking on `create` -> `category`
- admin can create new product after logged in by cliccking on `create` -> `product`
- admin can view all products in order to either `update` or `delete` it by clicking on `products` nav button
- scroll the scrollable table to the right and see options for delete and update.
- admin can view all Categories in order to either `update` or `delete` it by clicking on `categories` nav button
- scroll the scrollable table to the right and see options for delete and `update` link of the product or category 
that you want to update. Then change the details on the Editting screen. If you need to change the product image
 just choose click on choose image to select the image from your device. else you can leave that empty to retain the old image of the product after edditing.
 - Ensure to create category first before you can create product as all products must belong to a category
 - To view users cart as admin, click on the cart navigation button at the top of your admin page and the 
 tabular representation of all the users added products to their cart are highly displayed to you.
 - click on the logout button to logout of your account.
- Note: when admin deletes a category, all the products in that category get deleted at the same time
- when admin deletes a product, only the product is deleted.

## Contributing
Please submit bug reports, suggestions

## Security
Please disclose any vulnerabilities found responsibly – report security issue to my email.

