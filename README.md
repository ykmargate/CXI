#Denomination

It is a sample code that would retrieve a user’s input for a foreign currency amount and determines a mix of currency to satisfy this amount based on what is available in inventory.

What it’s doing:

-   Accepting user input
-   Validate user input on the both sides
-   Calculate denominations on inventory amount
-   Return the answer as JSON and show it in the browser

For a simple example, the user requests 5,245 CAD and the available denominations are 5, 10, 20, 100, 500.
Assume the browser sends the location\_id, currency\_code, and amount entered by the user to the system.
