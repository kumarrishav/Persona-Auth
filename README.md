# Persona Auth

Persona Auth is a Simple Authentication system in PHP with [Mozilla Persona](http://www.mozilla.org/en-US/persona/).

Since Persona Only handles the Login Portion, I was tasked with Creating a Session Type handling system in PHP, to keeping my users logged in. Challenge Accepted!

I operate all things on Github using [UNLICENSE](http://unlicense.org/) (the /care license)

## Usage

1. Rename ´settings.sample.php´ to ´settings.php´
2. Change database Details
3. Dump the follwing SQL in your database

```sql
CREATE TABLE IF NOT EXISTS persona_users (
  id int(11) NOT NULL AUTO_INCREMENT,
  email text NOT NULL,
  username varchar(255) NOT NULL,
  session text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;
```

After that you should be ready to roll. Assuming that the files have been uploaded to your server of course.

### Feedback

This is not a library, it's a simple solution. You can easily port or integrate this into your own website if you want, since I have yet to see any Non-Wordpress Supported website with Persona.

Feel Free to send feedback, suggestions and even contribute if you want.
If you do want to make something bigger or even add OpenId, Facebook or some alternative solutions like that, then Feel free to Fork.

### Credits

- Big props to *Guillaume* for his [PHP BrowserID Class](http://tools.atto.be/browserid/), it helped me handle the Persona code a lot easier.
- Mozilla for the Persona Project. So many people worked on this together! All of them, big thanks!
