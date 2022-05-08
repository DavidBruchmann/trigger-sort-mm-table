# Trigger Sorting MM Demo

This extension includes most relevant TCA configuration to demonstrate and test a MySQL-Trigger.

This is the described problem:

> In my extension I have two models team members (parent) and expertise (child).
> The bidirectional relationsship between the two models is stored in an intermediate table.
> This works fine bit there is one problem.
>
> When I edit the team member record in the TYPO3 Backend and assign an expertise record to it
> and then open the corresponding expertise record, the newly assigend team member record 
> is shown at the top of the list instead of at the end. The problem also occurs 
> the other way around.
>
> This is because the sorting respectively sorting_foreign field in the intermediate table
> is set to its default value (0) when the record is saved.

To install the trigger look in the file `ext_tables_static+adt.sql`.
It might be possible that it can be installed with TYPO3, else copy the SQL
and execute it in PhpMyAdmin or another DBMS.

The extensionKey is `btp` and the namespace `\WDB\Btp` due to the namings in the question
on Stack Overflow.