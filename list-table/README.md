# Backup Original WP_List_Table Class

https://developer.wordpress.org/reference/classes/wp_list_table/

## Developer Usage & Private Status #Developer Usage & Private Status
On March 27, 2012, Andrew Nacin warned developers that this class was created for private core use only as it may be subject to change in any future WordPress release.

Nevertheless, the WP_List_Table class has become widely used by plugins and WordPress developers as it provides a reliable, consistent, and semantic way to create custom list tables in WordPress. To date, no major changes have occurred in this class or are scheduled to occur, so testing your plugin with beta/RC phases of WordPress development should be more than enough to avoid any major issues.

If you are at all uncomfortable with this risk, a common (and safe) workaround is to make a copy the WP_List_Table class ( /wp-admin/includes/class-wp-list-table.php ) to use and distribute in your plugins, instead of using the original core class. This way, if the core class should ever change, your plugins will continue to work as-is.

Developers should use this class at their own risk.