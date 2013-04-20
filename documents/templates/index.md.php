WScore Framework
================

###yet another framework for PHP...

It's a PHP framework that is simple and small code base. 

But it has a unique technology called [Cena Data Transfer Agent (Cena-DTA)](cena).

Cena-DTA allows to synchronize databases between client and server, or more recently 
known as cloud and application. With Cena DTA, you also can create complex html forms 
that have many entities and relations, and saves them into database with a little code.


###serving files

WScore can serve simple text files, such as html, markdown, or text. 
The contntes are automatically converted to html based on the file extension, 
as follows. 

.md, .markdown, and .md.php 
: markdown file.
: contents are convereted to html using PHP-markdown-extra. 

.txt, .text, and .txt.php
: text file.
: contents are rendered as pre-formated text using pre tag. 

.html, .htm, .php, and .html.php
: html file. 
: considered as html file containing php code.

All of the files are treated like a PHP scripts, so PHP code can be embedded within.


###Chain and Dispatch

The basic idea about dispatching controller, or resource object is 
borrowed (i.e. copied) from BEAR.Sunday. I found it so intuitive, 
simple, and easy to implement, I could not use any other dispatcher 
like Symfony. 

Unfortunately, BEAR.Sunday was still under active development when 
I started WScore projects, I ended up writing some code to demo and 
test the framework. This version of dispatcher is rather simple 
(i.e. surfacial) copy of BEAR.Sunday. But has a tiny improvement on 
having hirarchical dispatcher using Chain of Reponsibility (CoR) pattern. 

Modules
: All of chain and dispatch are called modules. 
: Modules can be hirarchically constructed. 

WebApp Module
: WebApp is a module with extra methods for front-end of web application. 
: Based on AppChain Module. 

AppChain Module
: Dispatches a list of modules using CoR pattern. 

AppLoader Module
: Dispatches Page object based on pathinfo.
: This module contains Page object (i.e. controller) and View file (templates).


###license

[GPL version 2](LICENSE).


###patents

The Cena-DTA is patented in Japan. 