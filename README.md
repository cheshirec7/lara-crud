## Laravel CRUD examples

This demo was created using a fresh copy of Laravel (5.6.7) and contains CRUD examples of:
 - standard HTTP POST add/edit forms
 - Ajax add/edit forms

The goal is to minimize the changes to the default Laravel boilerplate and demonstrate correct OO patterns.
It should not be possible to corrupt the database through the UI as inputs are validated and any 
database-level errors adding/updating records are logged and reported to the user.

Packages added to base Laravel install:
 - Laravel Collective (form builder helpers)
 - Laravel Datatables (jQuery DataTables API)
 - Sweetalert2 (JS popup replacement)