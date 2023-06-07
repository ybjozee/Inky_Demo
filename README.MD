# INKY_DEMO

Technical Requirements

* PHP 8.0
* PDO-SQLite PHP extension enabled;
* [Git][1]
* [Composer][2]
* [Symfony CLI][3]
* and the [usual Symfony application requirements][4].


Installation
------------
```bash
$ git clone https://github.com/ybjozee/Inky_Demo.git
$ cd Inky_Demo
$ composer install
```

Usage
-----

Make a local version of the `.env` file

```bash
$ cp .env .env.local
```

Update the relevant Twilio keys in `.env.local`

``` ini
MAILER_DSN=sendgrid+api://<INSERT_YOUR_SENDGRID_KEY>@default
SENDER_EMAIL=YOUR_SENDGRID_SENDER_EMAIL
SENDER_NAME='YOUR_SENDGRID_SENDER_NAME'
```

If you're using SQLite as your doctrine transport, create the database.

```bash
$ touch var/data.db
```

Set up your transport

```bash
$  symfony console messenger:setup-transports 
```

Consume messages to the `async` transport

```bash
$ symfony console messenger:consume async -vv
```

In another terminal, run your application
```bash
$ symfony serve
```

[1]: https://git-scm.com/
[2]: https://getcomposer.org/
[3]: https://symfony.com/download
[4]: https://symfony.com/doc/current/reference/requirements.html
