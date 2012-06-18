php-twitter-bot
===============

A module based bot written in php that takes commands from a twitter account

Usage
===============
1. Create a twitter account
2. Set up the twitter account and an email in index.php
3. Add something like this to your cron<pre>* *     * * * root lynx -dump http://www.example.com/path/to/bot >/dev/null 2>&1</pre>
4. Tweet the command you want to run separated by a space for additional arguments

Extending
===============
It's really simple to extend it, just add a new class into modules and then call that from twitter.

Todo
===============
* Force specific functions to be present in the modules by class inheritance
* Better syntax for commands
* Extend command functionality to allow commands over multiple tweets