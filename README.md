# Persona Auth

Persona Auth is a Simple Implementation in PHP for keeping track who is logged in using [Mozilla Persona](http://www.mozilla.org/en-US/persona/).

Persona Only handles the Login Portion, Thus I was tasked with Creating a Persistent Login handler in PHP, to keeping my users logged in. Challenge Accepted!

## Usage

This is more of a Implementation rather then a Library.

1. Rename `settings.sample.php` to `settings.php`
2. Change database Details
3. Dump the follwing SQL in your database

```sql
CREATE TABLE IF NOT EXISTS persona_users (
  id int(11) NOT NULL AUTO_INCREMENT,
  email text NOT NULL,
  username varchar(255) NOT NULL,
  session text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
```

After that you should be ready to roll. Assuming that the files have been uploaded to your server of course.

### Feedback

I operate all things on Github using [UNLICENSE](http://unlicense.org/) (the /care license)
Feel Free to provide feedback, Suggestions, Contribute, etc.

Anyone is free to copy, modify, publish, use, compile, sell, or distribute this software, either in source code form or as a compiled binary, for any purpose, commercial or non-commercial, and by any means.

### Credits

- Big props to **Guillaume** for his [PHP BrowserID Class](http://tools.atto.be/browserid/).
- Mozilla for the Persona Project. So many people worked on this together! All of them, big thanks!
