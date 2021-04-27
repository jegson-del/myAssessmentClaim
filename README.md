

Below are responses to the question  if you need anymore information kindly message me .


Cross-Site Request Forgery (CSRF) is an attack that forces an end user to execute unwanted actions on a web application in which they’re currently authenticated. With a little help of social engineering (such as sending a link via email or chat), an attacker may trick the users of a web application into executing actions of the attacker’s choosing. If the victim is a normal user, a successful CSRF attack can force the user to perform state changing requests like transferring funds, changing their email address, and so forth. If the victim is an administrative account, CSRF can compromise the entire web application


Cross-site Scripting (XSS) is a client-side code injection attack The attacker aims to execute malicious scripts in a web browser of the victim by including malicious code in a legitimate web page or web application. The actual attack occurs when the victim visits the web page or web application that executes the malicious code. The web page or web application becomes a vehicle to deliver the malicious script to the user’s browser. Vulnerable vehicles that are commonly used for Cross-site Scripting attacks are forums, message boards, and web pages that allow comments.

The primary difference is that a CSRF attack requires an authenticated session, whereas an XSS attack doesn't. XSS is believed to be more dangerous because it doesn't require any user interaction. ... XSS requires a vulnerability to happen, whereas CSRF relies on tricking the user to click a link or access a page.


LARAVEL

Laravel automatically generates a CSRF "token" for each active Users session managed by the application. This token is used to verify that the authenticated user is the person actually making the requests to the application. Since this token is stored in the user's session and changes each time the session is regenerated, a malicious application is unable to access it and for Api  libraries such as Sanctum and Passport are simple packages you may use to issue API tokens to prevent CSRF.
Validation and user input sanitization  can be used to mitigate XSS in Laravel , Input sanitization is a security protocol for checking, filtering, and cleaning data inputs from app users and Middleware for Validation Checks on User Input can be added to an application. For this purpose .

VANILLA JS 
Third-party content (things like data from APIs and user-submitted content from form fields) can expose you to cross-site scripting (XSS) attacks if rendered into the UI without sanitization . The simplest way is to encode third-party data so that any HTML and CSS in the string renders as a plain string instead of markup and scrip so when injected into the UI it displays as sanitized and  remove the actual content in the script . Also using a third party sanitising library such as DOMPurify can be useful .

ORM means Object relational mapping  eloquent uses  HasMany to create relationship between two fields example is a user and order which means one user can have many order  and an order will belong to the user Model class . Ie Claimant and Claims 

{!! $title !!} used to echo us this is highly vulnerable to XSS best practice  {{ $title }}  always typically use the escaped, double curly brace syntax to prevent XSS attacks when displaying user supplied data.