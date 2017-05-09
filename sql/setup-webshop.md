# SQL API for my database webshop

Run all functions below by isuing "CALL function()" to the database.

## Products

**List overview of products and storage**
```sql
CALL viewProducts();
```

## Shopping cart

**View shopping cart**
```sql
CALL viewShoppingCart();
```

**Add item to shopping cart**
```sql
CALL addToShoppingCart(item_id, nr_of_items);
```

**Delete item/items from shopping cart**
```sql
CALL deleteFromShoppingCart(item_id, nr_of_items);
```

## Order

**View all orders**
```sql
CALL viewProducts();
```

**View single order**
```sql
CALL viewProducts();
```

**Place order**

Moves all items from shopping cart to orders and updates inventory.
```sql
CALL makeOrder();
```

**Delete an order**
```sql
CALL deleteOrder(order_id);
```

## Inventory log

**Display inventory log**

Shows a report about wich items are low (<5) in the inventory.
```sql
CALL getInventoryLog();
```